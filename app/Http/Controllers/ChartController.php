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

    public function getDataSK()
    {
        // Replace 'YourModel' with the actual model you are using
        $data = QuarterDate::all();

        // $data = DB::table('test_sk_dosen')
        // ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP') // Adjust the join condition accordingly
        // ->select('users.nama', 'test_sk_dosen.sks')
        // ->get();
        // $formattedData = $data->pluck('sks', 'nama');
        // return response()->json($formattedData);


        $sksData = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.nama', 'test_sk_dosen.sks')
        ->get();
        $formattedSksData = $sksData->pluck('sks', 'nama');

        $lineData = DB::table('test_sk_dosen')
            ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
            ->select('users.nama', 'test_sk_dosen.sks') // Adjust as needed
            ->get();
        $formattedLineData = $lineData->pluck('sks', 'nama');

        // $prodiData = DB::table('test_sk_dosen')
        //     ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        //     ->select('users.Prodi', DB::raw('COUNT(*) as count'))
        //     ->groupBy('users.Prodi')
        //     ->get();
        // $formattedProdiData = $prodiData->pluck('count', 'Prodi');

        $prodiData = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.Prodi')
        ->get();
        $formattedProdiData = $prodiData->pluck('count', 'Prodi');
        $formattedTotalSksData = $prodiData->pluck('total_sks', 'Prodi');




        $kkData = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.KK', DB::raw('COUNT(*) as count'))
        ->groupBy('users.KK')
        ->get();
        $formattedKKData = $kkData->pluck('count', 'KK');

        $kkSKS = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.KK', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.KK')
        ->get();
        $formattedKKSKSData = $kkSKS->pluck('total_sks','KK');

        return response()->json([
            'bar' => $formattedSksData,
            'line' => $formattedLineData,
            'prodi' => $formattedProdiData,
            'total_sks' => $formattedTotalSksData,
            'kk' => $formattedKKData,
            'kk_sks' => $formattedKKSKSData,

        ]);

    }

    public function getDataSKS()
    {
        $data = QuarterDate::all();

        // Hitung SKS Tiap Prodi
        $prodiSKS = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.Prodi')
        ->get();
        $formattedProdiData = $prodiSKS->pluck('count', 'Prodi');
        $formattedTotalSksData = $prodiSKS->pluck('total_sks', 'Prodi');

        // Hitung SKS Tiap Kelompok Keahlian
        $kkSKS = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.KK', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.KK')
        ->get();
        $formattedKKSKSData = $kkSKS->pluck('total_sks','KK');

        // Hitung SKS Tiap Dosen
        $semuaDosen = User::pluck('nama')->toArray();
        $dosenSKS = DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP') // LEFT JOIN agar dosen yang SKS nya 0 ikut terhitung
            ->select('users.nama', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
            ->groupBy('users.nama')
            ->get();

        $chartDosenSKS = $dosenSKS->pluck('total_sks', 'nama')->toArray();

        // Ensure that all 'nama' values are present, setting 'total_sks' to 0 if not
        foreach ($semuaDosen as $nama) {
            if (!array_key_exists($nama, $chartDosenSKS)) {
                $chartDosenSKS[$nama] = 0;
            }
        }



        return response()->json([
            'prodi_sks' => $formattedTotalSksData,
            'kk_sks' => $formattedKKSKSData,
            'dosen_sks' => $chartDosenSKS,
        ]);

    }
}
