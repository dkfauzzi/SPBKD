<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekretariat;
use App\Models\SK_Dosen;
use App\Models\QuarterDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DataDosenController extends Controller
{
    public function index()
    {
        $data = User::select([
        'nama',
        'JAD',
        'NIP',
        'Prodi',
        'KK',
        'email'])->get();

        return view('sekretariat2.sekretariat2-search', compact('data'));

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

        // $quartersData = [
        //     'start_date' => $start_date,
        //     'end_date' => $end_date,
        //     'sk' => $data['sk'],
        //     'sks' => $data['sks'],
        // ];

        // // Loop for quarter starts and ends
        // for ($quarter = 1; $quarter <= 4; $quarter++) {
        // $quartersData["q{$quarter}_start"] = $quarterStarts[$quarter];
        // $quartersData["q{$quarter}_end"] = $quarterEnds[$quarter];
        // }

        //Untuk tanggal
        $quartersData = [];

         //Untuk SK dan SKS
         $quartersData['start_date'] = $data['start_date'];
         $quartersData['end_date'] = $data['end_date'];
         $quartersData['sks'] = $data['sks'];
         $quartersData['sk'] = $data['sk'];
         $quartersData['jenis_sk'] = $data['jenis_sk'];

        //Loop untuk penentuan restriction tiap kolom Triwulan (tw1,tw2,tw3,tw4)
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
        $quartersData['start_sk'] = $start_date->year . '-Q' . ceil($start_date->month / 3);
        $quartersData['end_sk'] = $end_date->year . '-Q' . ceil($end_date->month / 3);


        QuarterDate::create($quartersData);

        return redirect('sekretariat2-dashboard');  

    }
}