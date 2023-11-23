<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuarterDate;
use Illuminate\Support\Facades\DB;


class ChartController extends Controller
{
    public function index()
    {
        return view('sekretariat2.sekretariat2-charts');
    }

    public function getData()
    {
        // Replace 'YourModel' with the actual model you are using
        $data = QuarterDate::all();
        $data = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP') // Adjust the join condition accordingly
        ->select('users.nama', 'test_sk_dosen.sks')
        ->get();

        $formattedData = $data->pluck('sks', 'nama');

        return response()->json($formattedData);
    }
}
