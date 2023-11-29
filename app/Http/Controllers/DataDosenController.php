<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekretariat;
use App\Models\SK_Dosen;
use App\Models\QuarterDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;





class DataDosenController extends Controller
{
    public function index()
    {
        // Fetch all users and their related SK information
        $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk')
        ->get();

        $countNIPRows = QuarterDate::select('NIP')
        ->selectRaw('COUNT(*) as count_rows')
        ->groupBy('NIP')
        ->pluck('count_rows', 'NIP')
        ->toArray();

        // Hitung jumlah SK with specific NIP (per-dosen)
        $totalSKS = $data->groupBy('NIP')->map(function ($group) {
            return [
                'NIP' => $group->first()->NIP,
                'nama' => $group->first()->nama,
                'JAD' => $group->first()->JAD,
                'Prodi' => $group->first()->Prodi,
                'KK' => $group->first()->KK,
                'email' => $group->first()->email,
                'total_sk' => $group->count(), // Count of rows with the same 'NIP'
                'total_sks' => $group->sum('sks'),
            ];
        });

        return view('sekretariat2.sekretariat2-search', compact('data','totalSKS','countNIPRows'));
    }

    public function create($NIP)
    {
        // Fetch the user
        $user = User::where('NIP', $NIP)->first();

        return view('sekretariat2.sekretariat2-tambah-sk', compact('user','NIP'));

        // return redirect()->route('sekretariat2-tambah-sk', ['NIP' => $NIP])
        // ->with('success', 'New data added successfully');
    }

    public function store(Request $request){

        // set data yang di store
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'sk'  => 'required',
            'sks'  => 'required',
            'jenis_sk'  => 'required',
            'keterangan_sk' => 'required',
            'NIP' => 'required',
        ]);

        $nip = $data['NIP'];

        $start_date = \Carbon\Carbon::parse($data['start_date']);
        $end_date = \Carbon\Carbon::parse($data['end_date']);

        // Set mulainya bulan dan tanggal TW. Contoh 1(1,1) = TW1 (bulan januari, tanngal 1)
        $quarterStarts = [
            1 => \Carbon\Carbon::createFromDate($start_date->year, 1, 1),
            2 => \Carbon\Carbon::createFromDate($start_date->year, 4, 1),
            3 => \Carbon\Carbon::createFromDate($start_date->year, 7, 1),
            4 => \Carbon\Carbon::createFromDate($start_date->year, 10, 1),
        ];

        // Set berakhirnya bulan dan tanggal TW. Contoh 1(3,31) = TW1(bulan maret, tanngal 31)
        $quarterEnds = [
            1 => \Carbon\Carbon::createFromDate($start_date->year, 3, 31),
            2 => \Carbon\Carbon::createFromDate($start_date->year, 6, 30),
            3 => \Carbon\Carbon::createFromDate($start_date->year, 9, 30),
            4 => \Carbon\Carbon::createFromDate($start_date->year, 12, 31),
        ];

        //Untuk tanggal
        $quartersData['NIP'] = $nip;

        //Untuk SK dan SKS dll.
        $quartersData['start_date'] = $data['start_date'];
        $quartersData['end_date'] = $data['end_date'];
        $quartersData['sks'] = $data['sks'];
        $quartersData['sk'] = $data['sk'];
        $quartersData['jenis_sk'] = $data['jenis_sk'];
        $quartersData['keterangan_sk'] = $data['keterangan_sk'];
        // $quartersData['NIP'] = $data['NIP'];



        //Loop untuk penentuan restriction tiap kolom Triwulan (tw1,tw2,tw3,tw4)
        for ($quarter = 1; $quarter <= 4; $quarter++) {
            $qStart = $quarterStarts[$quarter];
            $qEnd = $quarterEnds[$quarter];

            if ($end_date < $qStart || $start_date > $qEnd) {
                // Jika tanggal berada diluar TW, leave the columns empty
                $quartersData["q{$quarter}_start"] = null;
                $quartersData["q{$quarter}_end"] = null;
            } else {
                //Jika tanggal berada di dalam TW, insert into column
                $quartersData["q{$quarter}_start"] = max($start_date, $qStart);
                $quartersData["q{$quarter}_end"] = min($end_date, $qEnd);
            }
        }

        // $quartersData['start_sk'] = $start_date->format('Y-Q');
        $quartersData['start_sk'] = $start_date->year . '-Q' . ceil($start_date->month / 3);
        $quartersData['end_sk'] = $end_date->year . '-Q' . ceil($end_date->month / 3);


        QuarterDate::create($quartersData);

        // return redirect('sekretariat2-dosen-details');  
        return redirect()->route('sekretariat2-dosen-details', ['NIP' => $request->input('NIP')]);


    }


    public function delete($NIP)
    {
        $data = QuarterDate::where('NIP', $NIP)->firstOrFail();

        // Delete the record
        $data->delete();

        return redirect()->back()->with('success', 'Record deleted successfully');
    }

    public function edit($NIP){

        $data = User::where('NIP', $NIP)->first();

        // $test = QuarterDate::where('NIP', $NIP)->get(); 

        // return redirect()->route('sekretariat2-dosen-edit', compact('data'));
        // return redirect()->route('sekretariat2-dosen-edit', ['NIP' => $data->NIP]);
        
        return view('sekretariat2.sekretariat2-dosen-edit', compact('data'));


    }

    public function update($NIP, Request $request)
    {
         // Validate the form data
        $data = $request->validate([
            'NIP' => 'required',
            'nama' => 'required',
            'JAD' => 'required',
            'Prodi' => 'required',
            'KK' => 'required',
            'email' => 'required',
        ]);

        // Find the user by NIP and update the data
        $user = User::where('NIP', $NIP)->first();
        $user->update($data);

        // Redirect or perform any other action as needed
        return redirect()->route('sekretariat2-search')->with('success', 'User updated successfully');

    }



    public function detailDosen($NIP)
    {
        
        // cari dosen dengan NIP
        $data = User::where('NIP', $NIP)->first();

        // ambil data SK dengan NIP yang di pilih
        $test = QuarterDate::where('NIP', $NIP)->get(); 

        return view('sekretariat2.sekretariat2-dosen-details', compact('data','test'));
    }


    public function pdf($NIP){

        
        // Fetch the QuarterDate model for the given NIP
        $quarterDate = QuarterDate::where('NIP', $NIP)->get();

        // Load the PDF view with the fetched data
        $pdf = PDF::loadView('sekretariat2.print', compact('quarterDate'));
        
        return $pdf->stream(); // Stream the PDF to the browser
        // return $pdf->download('filename.pdf'); // Download the PDF
       
    }
}
