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
       
        $data['test_sk_dosen'] = QuarterDate::all();
        return view('sekretariat2.sekretariat2-tambah-sk', $data);
    }

    public function store(Request $request){
        
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'sk'  => 'required',
            'sks'  => 'required',
            'jenis_sk'  => 'required',
            'keterangan_sk' => 'required',
        ]);

        $start_date = \Carbon\Carbon::parse($data['start_date']);
        $end_date = \Carbon\Carbon::parse($data['end_date']);

        $quarterStarts = [
            1 => \Carbon\Carbon::createFromDate($start_date->year, 1, 1),
            2 => \Carbon\Carbon::createFromDate($start_date->year, 4, 1),
            3 => \Carbon\Carbon::createFromDate($start_date->year, 7, 1),
            4 => \Carbon\Carbon::createFromDate($start_date->year, 10, 1),
        ];

        $quarterEnds = [
            1 => \Carbon\Carbon::createFromDate($start_date->year, 3, 31),
            2 => \Carbon\Carbon::createFromDate($start_date->year, 6, 30),
            3 => \Carbon\Carbon::createFromDate($start_date->year, 9, 30),
            4 => \Carbon\Carbon::createFromDate($start_date->year, 12, 31),
        ];

        //Untuk tanggal
        $quartersData = [];

         //Untuk SK dan SKS
         $quartersData['start_date'] = $data['start_date'];
         $quartersData['end_date'] = $data['end_date'];
         $quartersData['sks'] = $data['sks'];
         $quartersData['sk'] = $data['sk'];
         $quartersData['jenis_sk'] = $data['jenis_sk'];
         $quartersData['keterangan_sk'] = $data['keterangan_sk'];

        //Loop untuk penentuan restriction tiap kolom Triwulan (tw1,tw2,tw3,tw4)
        // for ($quarter = 1; $quarter <= 4; $quarter++) {
        //     $qStart = $quarterStarts[$quarter];
        //     $qEnd = $quarterEnds[$quarter];

        //     if ($end_date < $qStart || $start_date > $qEnd) {
        //         // Dates are outside the quarter, leave the columns empty
        //         $quartersData["q{$quarter}_start"] = null;
        //         $quartersData["q{$quarter}_end"] = null;
        //     } else {
        //         // Dates are inside the quarter, set the columns accordingly
        //         $quartersData["q{$quarter}_start"] = max($start_date, $qStart);
        //         $quartersData["q{$quarter}_end"] = min($end_date, $qEnd);
        //     }
        // }

        for ($quarter = 1; $quarter <= 4; $quarter++) {
            $qStart = $quarterStarts[$quarter];
            $qEnd = $quarterEnds[$quarter];
    
            if ($end_date < $qStart || $start_date > $qEnd) {
                // Dates are outside the quarter, leave the columns empty
                $quartersData["q{$quarter}_start"] = null;
                $quartersData["q{$quarter}_end"] = null;
            } else {
                // Dates are inside the quarter, set the columns accordingly
                $quartersData["q{$quarter}_start"] = max($start_date, $qStart);
                $quartersData["q{$quarter}_end"] = min($end_date, $qEnd);
            }
        }
        

        // $quartersData['start_sk'] = $start_date->format('Y-Q');
        $quartersData['start_sk'] = $start_date->year . '-TW' . ceil($start_date->month / 3);
        $quartersData['end_sk'] = $end_date->year . '-TW' . ceil($end_date->month / 3);


        QuarterDate::create($quartersData);

        return redirect('sekretariat2-dashboard');  

    }

    public function pdf(){
        // $pdf = App::make('dompdf.wrapper');
        // // $pdf->loadHTML('<h1>Test</h1>');
        // $pdf = PDF::loadView('mahasiswa.mahasiswa-generate-form-001', $data);
        // return $pdf->stream();

        $data = QuarterDate::select([
            'sk','sks','jenis_sk','keterangan_sk',
            'start_date','end_date',
            'q1_start','q1_end',
            'q2_start','q2_end',
            'q3_start','q3_end',
            'q4_start','q4_end',
            'start_sk','end_sk'])->get()->toArray();

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

