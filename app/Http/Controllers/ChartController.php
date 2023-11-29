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
        $data = QuarterDate::all();

        // Hitung SK Tiap Prodi
        $skProdi = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.Prodi')
        ->get();
        $chartSKProdi = $skProdi->pluck('count', 'Prodi');
        $chartTotalSKProdi = $skProdi->pluck('total_sks', 'Prodi');

        // Hitung SK Tiap Kelompok Keahlian
        $skKK = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.KK', DB::raw('COUNT(*) as count'))
        ->groupBy('users.KK')
        ->get();
        $chartSKSKK = $skKK->pluck('count', 'KK');

        // // Hitung SK Tiap Dosen
        // $dosenSK = DB::table('test_sk_dosen')
        // ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        // ->select('users.nama', 'test_sk_dosen.sks')
        // ->get();
        // $formattedSksData = $dosenSK->pluck('sks', 'nama');

        // Hitung SKS Tiap Dosen
        $semuaDosen = User::pluck('nama')->toArray();
        $skDosen = DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP') // LEFT JOIN agar dosen yang SKS nya 0 ikut terhitung
            ->select('users.nama', DB::raw('COUNT(test_sk_dosen.sk) as count'))
            ->groupBy('users.nama')
            ->get();
        $chartSKDosen = $skDosen->pluck('count', 'nama')->toArray();

        // LOOP agar dosen yang SKS nya 0 ikut terhitung
        foreach ($semuaDosen as $nama) {
            if (!array_key_exists($nama, $chartSKDosen)) {
                $chartSKDosen[$nama] = 0;
            }
        }

        return response()->json([
            'prodi_SK' => $chartSKProdi,
            'kk_SK' => $chartSKSKK,
            'dosen_SK' => $chartSKDosen,


        ]);

    }

    public function getDataSKS()
    {
        $data = QuarterDate::all();

        // Hitung SKS Tiap Prodi
        $sksProdi = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.Prodi', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.Prodi')
        ->get();
        $chartSKSProdi = $sksProdi->pluck('count', 'Prodi');
        $chartTotalSKSProdi = $sksProdi->pluck('total_sks', 'Prodi');

        // Hitung SKS Tiap Kelompok Keahlian
        $sksKK = DB::table('test_sk_dosen')
        ->join('users', 'test_sk_dosen.NIP', '=', 'users.NIP')
        ->select('users.KK', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.KK')
        ->get();
        $chartSKSKK = $sksKK->pluck('total_sks','KK');

        // Hitung SKS Tiap Dosen
        $semuaDosen = User::pluck('nama')->toArray();
        $sksDosen = DB::table('users')
            ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP') // LEFT JOIN agar dosen yang SKS nya 0 ikut terhitung
            ->select('users.nama', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
            ->groupBy('users.nama')
            ->get();
        $chartSKSDosen = $sksDosen->pluck('total_sks', 'nama')->toArray();

        // LOOP agar dosen yang SKS nya 0 ikut terhitung
        foreach ($semuaDosen as $nama) {
            if (!array_key_exists($nama, $chartSKSDosen)) {
                $chartSKSDosen[$nama] = 0;
            }
        }

        return response()->json([
            'prodi_sks' => $chartTotalSKSProdi,
            'kk_sks' => $chartSKSKK,
            'dosen_sks' => $chartSKSDosen,
        ]);

    }
}
