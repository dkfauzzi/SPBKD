<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekretariat;
use App\Models\SK_Dosen;
use App\Models\QuarterDate;
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
        $nipOptions = User::pluck('NIP')->toArray();
    
        return view('sekretariat2.sekretariat2-tambah-sk', compact('nipOptions'));
    }
    
    public function getNamaByNIP($NIP)
    {
        try {
            $nama = User::where('NIP', $NIP)->value('nama');
    
            if ($nama !== null) {
                return response()->json(['nama' => $nama]);
            } else {
                return response()->json(['error' => 'Nama not found for the given NIP.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    public function getNIPOptions()
    {
        $nipOptions = User::pluck('NIP')->unique(); 
    
        return response()->json(['nipOptions' => $nipOptions]);
    }
        
    

    public function store(Request $request)
    {
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
        $sets = $request->input('sets');
        dd($sets);

    
        foreach ($sets as $setData) {
            // Process each set of data similarly to what you did in your original store method
    
            $start_date = \Carbon\Carbon::parse($setData['start_date']);
            $end_date = \Carbon\Carbon::parse($setData['end_date']);
    
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
        }
    
        return redirect()->route('tambah');
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
}

