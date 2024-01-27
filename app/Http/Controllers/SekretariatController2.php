<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekretariat;
use App\Models\SK_Dosen;
use App\Models\QuarterDate;
use App\Models\SK_Undangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class SekretariatController2 extends Controller
{
    public function index()
    {
        $data = QuarterDate::select([
            'sk','sks','jenis_sk','keterangan_sk',
            'start_date','end_date',
            'q1_start','q1_end',
            'q2_start','q2_end',
            'q3_start','q3_end',
            'q4_start','q4_end',
            'start_sk','end_sk'])->get();

        return view('sekretariat2.sekretariat2-dashboard', compact('data'));

    }

    public function create()
    {
        $nipOptions = User::select('NIP')->distinct()->get(); 

        $nipOptions = User::where('level', '<>', 'sekretariat2')
            ->select('NIP')->distinct()->get();
    
        return view('sekretariat2.sekretariat2-tambah-sk', ['nipOptions' => $nipOptions]);
    }
    
    

    public function getNama($nip)
    {
        $nama = User::where('NIP', $nip)->pluck('nama')->first();
    
        return response()->json(['nama' => $nama]);
    }
    
    public function store(Request $request)
    {
        // Set data to store
        $data = $request->validate([
            'start_date' => 'required|array',
            'start_date.*' => 'required|date',
            'end_date' => 'required|array',
            'end_date.*' => 'required|date',
            'sk' => 'required|array',
            'sk.*' => 'required',
            'sks' => 'required|array',
            'sks.*' => 'required',
            'jenis_sk' => 'required|array',
            'jenis_sk.*' => 'required',
            'keterangan_sk' => 'null|array',
            'keterangan_sk.*' => 'null',
            'NIP' => 'required|array',
            'NIP.*' => 'required',
            'nama' => 'required|array',
            'nama.*' => 'required',
            'bukti' => 'required|mimes:pdf,jpg,png,doc,docx|max:25000',
            'bukti.*' => 'required|mimes:pdf,jpg,png,doc,docx|max:25000',

        ]);

        // upload bukti
        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti');
            $namaBukti = time() . '_' . $bukti->getClientOriginalName();
            $bukti->storeAs('bukti_sk', $namaBukti, 'public');

            $data['bukti'] = $namaBukti;
        }
    
        // Initialize $quartersData outside the loop
        $quartersData = [];
    
        // Loop through the array of NIPs
        foreach ($data['NIP'] as $key => $nip) {
            // Set mulainya bulan dan tanggal TW. Contoh 1(1,1) = TW1 (bulan januari, tanngal 1)
            $quarterStarts = [
                1 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 1, 1),
                2 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 4, 1),
                3 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 7, 1),
                4 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 10, 1),
            ];
    
            // Set berakhirnya bulan dan tanggal TW. Contoh 1(3,31) = TW1(bulan maret, tanngal 31)
            $quarterEnds = [
                1 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 3, 31),
                2 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 6, 30),
                3 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 9, 30),
                4 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 12, 31),
            ];
            

            $entry = [
                'NIP' => $nip,
                'nama' => $data['nama'][$key],
                'sk' => $data['sk'][0], //starts from key 0 
                'sks' => $data['sks'][0], 
                'jenis_sk' => $data['jenis_sk'][0], 
                // 'bukti' => $data['bukti'][0], 
                // 'keterangan_sk' => $data['keterangan_sk'][0], 
                'start_date' => \Carbon\Carbon::parse($data['start_date'][0]),
                'end_date' => \Carbon\Carbon::parse($data['end_date'][0]),
            ];
        
            // Loop through quarters
            for ($quarter = 1; $quarter <= 4; $quarter++) {
                $qStart = $quarterStarts[$quarter];
                $qEnd = $quarterEnds[$quarter];
        
                if ($entry['end_date'] < $qStart || $entry['start_date'] > $qEnd) {
                    // If outside the quarter, leave the columns empty
                    $entry["q{$quarter}_start"] = null;
                    $entry["q{$quarter}_end"] = null;
                } else {
                    // If inside the quarter, insert into columns
                    $entry["q{$quarter}_start"] = max($entry['start_date'], $qStart);
                    $entry["q{$quarter}_end"] = min($entry['end_date'], $qEnd);
                }
            }
        
            // Set start and end SK dates
            $entry['start_sk'] = $entry['start_date']->year . '-Q' . ceil($entry['start_date']->month / 3);
            $entry['end_sk'] = $entry['end_date']->year . '-Q' . ceil($entry['end_date']->month / 3);
            

            // Add the entry to $quartersData array
            $quartersData[] = $entry;
            $quartersData[$key]['bukti'] = $data['bukti'];

        }
    
        // Loop through the prepared $quartersData array and create entries in the database
        foreach ($quartersData as $dataEntry) {
            // Create entry in the database
            QuarterDate::create($dataEntry);
        }
    
        return redirect()->route('sekretariat2-search');
    }

    public function delete($NIP)
    {
        $data = User::where('NIP', $NIP)->firstOrFail();

        // Delete the record
        $data->delete();

        return redirect()->back()->with('success', 'Record deleted successfully');
    }
    
    public function pdf($NIP){

        $data = QuarterDate::where('NIP', $NIP)->first()->toArray();

        $pdf = PDF::loadView('sekretariat2.print', $data, compact('data'));
        return $pdf->stream();
    }

    //Pindah ke halaman detail dosen

    public function DosenDetails($id)
    {
        $data = Users::find($id); 
        return view('sekretariat2.sekretariat-dosen-details', ['data' => $data]);


        $username = Auth::user()->username;
        $data['ta'] = TA::all()->where('username', '=', $username);
        $data['proposal'] = Proposal::all()->where('id_proposal', '=', "PTA$username");
        // $data['dosen'] = Dosen::all();
        return view('mahasiswa.dashboard-mahasiswa-proposal-ta', $data);
    }

    public function createUndangan()
    {
        $nipOptions = User::select('NIP')->distinct()->get(); 

        $nipOptions = User::where('level', '<>', 'sekretariat2')
            ->select('NIP')->distinct()->get();
    
        return view('sekretariat2.sekretariat2-tambah-undangan', ['nipOptions' => $nipOptions]);
    }
    
    public function getNamaUndangan($nip)
    {
        $nama = User::where('NIP', $nip)->pluck('nama')->first();
    
        return response()->json(['nama' => $nama]);
    }


    public function storeUndangan(Request $request)
    {
        // Set data to store
        $data = $request->validate([
            'start_date' => 'required|array',
            'start_date.*' => 'required|date',
            'sk' => 'required|array',
            'sk.*' => 'required',
            'sks' => 'required|array',
            'sks.*' => 'required',
            'jenis_sk' => 'required|array',
            'jenis_sk.*' => 'required',
            'NIP' => 'required|array',
            'NIP.*' => 'required',
            'nama' => 'required|array',
            'nama.*' => 'required',
            'bukti' => 'required|mimes:pdf,jpg,png,doc,docx|max:25000',
            'bukti.*' => 'required|mimes:pdf,jpg,png,doc,docx|max:25000',
        ]);

        // upload bukti
        if ($request->hasFile('bukti')) {
            $bukti = $request->file('bukti');
            $namaBukti = time() . '_' . $bukti->getClientOriginalName();
            $bukti->storeAs('bukti_sk', $namaBukti, 'public');

            $data['bukti'] = $namaBukti;
        }
    
        // Initialize $quartersData outside the loop
        $quartersData = [];
    
        // Loop through the array of NIPs
        foreach ($data['NIP'] as $key => $nip) {
            // Set mulainya bulan dan tanggal TW. Contoh 1(1,1) = TW1 (bulan januari, tanngal 1)
            $quarterStarts = [
                1 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 1, 1),
                2 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 4, 1),
                3 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 7, 1),
                4 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 10, 1),
            ];
    
            // Set berakhirnya bulan dan tanggal TW. Contoh 1(3,31) = TW1(bulan maret, tanngal 31)
            $quarterEnds = [
                1 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 3, 31),
                2 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 6, 30),
                3 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 9, 30),
                4 => \Carbon\Carbon::createFromDate(\Carbon\Carbon::parse($data['start_date'][0])->year, 12, 31),
            ];
    
            $entry = [
                'NIP' => $nip,
                'nama' => $data['nama'][$key],
                'sk' => $data['sk'][0], 
                'sks' => $data['sks'][0], 
                'jenis_sk' => $data['jenis_sk'][0], 
                'start_date' => \Carbon\Carbon::parse($data['start_date'][0]),
            ];
            // Set start and end SK dates
            $entry['start_sk'] = $entry['start_date']->year . '-Q' . ceil($entry['start_date']->month / 3);
    
            // Add the entry to $quartersData array
            $quartersData[] = $entry;
            $quartersData[$key]['bukti'] = $data['bukti'];

        }
    
        foreach ($quartersData as $dataEntry) {
            // Create entry in the database
            SK_Undangan::create($dataEntry);
        }
    
        return redirect()->route('sekretariat2-search');
    }


}

