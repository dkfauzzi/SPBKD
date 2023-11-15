<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sekretariat;
use App\Models\SK_Dosen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


class SekretariatController extends Controller
{
    public function index()
    {
        $data = SK_Dosen::select([
            'sk','sks',
            'q1_start','q1_end',
            'q2_start','q2_end',
            'q3_start','q3_end',
            'q4_start','q4_end'])->get();

        return view('sekretariat.sekretariat-dashboard', compact('data'));

    }

    public function create()
    {
       
        $data['sk_dosen'] = SK_Dosen::all();
        return view('sekretariat.sekretariat-tambah-sk', $data);
    }

    public function store(Request $request){
        
        $data = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'sk'  => 'required',
            'sks'  => 'required',
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
         $quartersData['sks'] = $data['sks'];
         $quartersData['sk'] = $data['sk'];

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

        SK_Dosen::create($quartersData);

        return redirect('sekretariat-dashboard');

    }
}