<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuarterDate;
use App\Models\User;
use Carbon\Carbon;



class QuarterDateController extends Controller
{

    public function index()
    {
        // $data['mahasiswa'] = Mahasiswa::all();
        // $username = Auth::user()->username;
        // $data['user'] = User::where('username', '=', $username)->get();

        // $date = Carbon::now(); 
        // $date = $date->translatedFormat('d F Y', 'id');


        // $start_dateIndonesian = $data->translatedFormat('d F Y', 'id');
        // $end_dateIndonesian = $end_date->translatedFormat('d F Y', 'id');

        $data = QuarterDate::select([
        'sk','sks',
        'q1_start','q1_end',
        'q2_start','q2_end',
        'q3_start','q3_end',
        'q4_start','q4_end'])->get();

        // foreach ($data as $quartersDate) {

        //     // $q1StartDate = Carbon::parse($quartersDate->q1_start);
        //     $q1EndDate = Carbon::parse($quartersDate->q1_end);

        //     $q2StartDate = Carbon::parse($quartersDate->q2_start);
        //     $q2EndDate = Carbon::parse($quartersDate->q2_end);

        //     $q3StartDate = Carbon::parse($quartersDate->q3_start);
        //     $q3EndDate = Carbon::parse($quartersDate->q3_end);

        //     $q4StartDate = Carbon::parse($quartersDate->q4_start);
        //     $q4EndDate = Carbon::parse($quartersDate->q4_end);

        //     // $quartersDate->q1_start_indonesian = $q1StartDate->isNotEmpty() ? $q1StartDate->translatedFormat('d F Y', 'id') : null;
        //     // $quartersDate->q1_start_indonesian = $q1StartDate->isValid() ? $q1StartDate->translatedFormat('d F Y', 'id') : null;
        //     // $quartersDate->q1_start_indonesian = $q1StartDate->translatedFormat('d F Y', 'id');
        //     $quartersDate->q1_end_indonesian = $q1EndDate->translatedFormat('d F Y', 'id');

        //     $quartersDate->q2_start_indonesian = $q2StartDate->translatedFormat('d F Y', 'id');
        //     $quartersDate->q2_end_indonesian = $q2EndDate->translatedFormat('d F Y', 'id');

        //     $quartersDate->q3_start_indonesian = $q3StartDate->translatedFormat('d F Y', 'id');
        //     $quartersDate->q3_end_indonesian = $q3EndDate->translatedFormat('d F Y', 'id');

        //     $quartersDate->q4_start_indonesian = $q4StartDate->translatedFormat('d F Y');
        //     $quartersDate->q4_end_indonesian = $q4EndDate->translatedFormat('d F Y');

        //     $quartersDate->q1_start_indonesian ? Carbon\Carbon::parse($quartersDate->q1_start)->format('d F Y', 'id') : null;
        //     // $sk->q2_start ? Carbon\Carbon::parse($sk->q2_start)->format('d F Y') : '';


        //     // dd($quartersDate->q1_start_indonesian = Carbon::parse($quartersDate->q1_start)->translatedFormat('d F Y', 'id'));
        //     // dd($quartersDate->q1_end_indonesian = Carbon::parse($quartersDate->q1_end)->translatedFormat('d F Y', 'id'));

        //     // dd($quartersDate->q2_start_indonesian = Carbon::parse($quartersDate->q2_start)->translatedFormat('d F Y', 'id'));
        //     // dd($quartersDate->q2_end_indonesian = Carbon::parse($quartersDate->q2_end)->translatedFormat('d F Y', 'id'));

        //     // dd($quartersDate->q3_start_indonesian = Carbon::parse($quartersDate->q3_start)->translatedFormat('d F Y', 'id'));
        //     // dd($quartersDate->q3_end_indonesian = Carbon::parse($quartersDate->q3_end)->translatedFormat('d F Y', 'id'));
            
        //     // dd($quartersDate->q4_start_indonesian = Carbon::parse($quartersDate->q4_start)->translatedFormat('d F Y', 'id'));
        //     // dd($quartersDate->q4_end_indonesian = Carbon::parse($quartersDate->q4_end)->translatedFormat('d F Y', 'id'));

        // }

        // dd($data);

        return view('dosen.dosen-dashboard', compact('data'));


    }

    public function create()
    {
        $data['test_sk_dosen'] = QuarterDate::all();
        return view('dosen.dosen-tambah-sk', $data);
    }



    public function store(Request $request)
    {
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

        $quartersData = [];
        $quartersData['sks'] = $data['sks'];
        $quartersData['sk'] = $data['sk'];


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

        $input = $request->all();
        // $sks = $request->input('sks');


       
        QuarterDate::create($quartersData);

        return redirect('dosen-dashboard');
    }

    




    //========================================================


    // public function store(Request $request)
    // {
    //     $start_date = $request->input('start_date');
    //     $end_date = $request->input('end_date');

    //     // Determine which quarters the date range belongs to
    //     // You may need to customize this logic based on your needs.
    //     $quarter_1 = ($start_date >= '2023-01-01' && $end_date <= '2023-03-31') ? $start_date : null;
    //     $quarter_2 = ($start_date >= '2023-04-01' && $end_date <= '2023-06-30') ? $start_date : null;
    //     $quarter_3 = ($start_date >= '2023-07-01' && $end_date <= '2023-09-30') ? $start_date : null;
    //     $quarter_4 = ($start_date >= '2023-10-01' && $end_date <= '2023-12-31') ? $start_date : null;

    //     // Insert the data into the database table
    //     QuarterDate::create([
    //         'start_date' => $start_date,
    //         'end_date' => $end_date,
    //         'q1' => $quarter_1,
    //         'q2' => $quarter_2,
    //         'q3' => $quarter_3,
    //         'q4' => $quarter_4,
    //     ]);

    //     // Redirect or show a success message
    //     return redirect('dosen-dashboard')->with('success', 'Date range inserted successfully.');
    // }


    //=============================================================================

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date',
    //     ]);

    //     $start_date = Carbon::parse($data['start_date']);
    //     $end_date = Carbon::parse($data['end_date']);

    //     $quarters = [
    //         1 => ['q1_start', 'q1_end'],
    //         2 => ['q2_start', 'q2_end'],
    //         3 => ['q3_start', 'q3_end'],
    //         4 => ['q4_start', 'q4_end'],
    //     ];

    //     $quarter_data = [];

    //     foreach ($quarters as $quarter => $columns) {
    //         $quarter_start = Carbon::createFromDate($start_date->year, ($quarter - 1) * 3 + 1, 1)->startOfMonth();
    //         $quarter_end = $quarter_start->copy()->addMonths(3)->subDay();

    //         if ($quarter_start >= $start_date && $quarter_end <= $end_date) {
    //             $quarter_data[$columns[0]] = $quarter_start;
    //             $quarter_data[$columns[1]] = $quarter_end;
    //         } else {
    //             $quarter_data[$columns[0]] = null;
    //             $quarter_data[$columns[1]] = null;
    //         }
    //     }

    //     QuarterDate::create($quarter_data);

    //     return redirect('dosen-dashboard');
    // }


    //======================================================
    
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after_or_equal:start_date',
    //     ]);

    //     $quarters = $this->calculateQuarters($data['start_date'], $data['end_date']);

    //     QuarterDate::create(array_merge($data, $quarters));

    //     return view('dosen.dosen-dashboard', compact('quarters'));
    // }

    // private function calculateQuarters($start, $end)
    // {
    //     // Implement your logic to calculate the quarters and return the data.
    //     // You can use Carbon or native PHP functions to handle date calculations.

    //     $quarters = [];

    //     $start = Carbon::parse($start);
    //     $end = Carbon::parse($end);
    
    //     // Calculate the first day of the current year and the last day of the current year.
    //     $currentYear = Carbon::now()->year;
    //     $currentYearStart = Carbon::createFromDate($currentYear, 1, 1);
    //     $currentYearEnd = Carbon::createFromDate($currentYear, 12, 31);
    
    //     // Quarter 1: January 1 - March 31
    //     $quarters['q1_start'] = $start->max($currentYearStart);
    //     $quarters['q1_end'] = $quarters['q1_start']->copy()->endOfQuarter();
    
    //     // Quarter 2: April 1 - June 30
    //     $quarters['q2_start'] = $quarters['q1_end']->copy()->addDay();
    //     $quarters['q2_end'] = $quarters['q2_start']->copy()->endOfQuarter();
    
    //     // Quarter 3: July 1 - September 30
    //     $quarters['q3_start'] = $quarters['q2_end']->copy()->addDay();
    //     $quarters['q3_end'] = $quarters['q3_start']->copy()->endOfQuarter();
    
    //     // Quarter 4: October 1 - December 31
    //     $quarters['q4_start'] = $quarters['q3_end']->copy()->addDay();
    //     $quarters['q4_end'] = $end->min($currentYearEnd);
    
    //     return $quarters;
    // }

    //======================================

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'full_date' => 'required|date',
    //     ]);

    //     // Split the date into quarters and save to the database
    //     $date = $data['full_date'];
    //     $quarters = getQuarters($date);

    //     QuarterDate::create([
    //         'full_date' => $date,
    //         'q1_start' => $quarters['q1']['start'],
    //         'q1_end' => $quarters['q1']['end'],
    //         'q2_start' => $quarters['q2']['start'],
    //         'q2_end' => $quarters['q2']['end'],
    //         'q3_start' => $quarters['q3']['start'],
    //         'q3_end' => $quarters['q3']['end'],
    //         'q4_start' => $quarters['q4']['start'],
    //         'q4_end' => $quarters['q4']['end'],
    //     ]);

    //     return redirect('dosen-dashboard');
    // }

}

