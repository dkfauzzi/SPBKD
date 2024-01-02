<?


public function data_SKS()
{
    $data = QuarterDate::all();

    // Hitung SKS Tiap Prodi
    $semuaProdi = User::pluck('Prodi')->toArray();
    $sksProdi = DB::table('users')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.Prodi', 'users.jenis_sk', DB::raw('COUNT(*) as count, SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.Prodi', 'users.jenis_sk')
        ->get();
    $chartSKSProdi = $sksProdi->pluck('total_sks', 'Prodi')->toArray();

    // Hitung SKS Tiap Jenis SK
    $jenisSKS = $sksProdi->pluck('total_sks', 'jenis_sk')->toArray();

    // Hitung SKS Tiap Kelompok Keahlian
    $semuaKK = User::pluck('KK')->toArray();
    $sksKK = DB::table('users')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.KK', DB::raw('SUM(test_sk_dosen.sks) as total_sks'))
        ->groupBy('users.KK')
        ->get();
    $chartSKSKK = $sksKK->pluck('total_sks', 'KK')->toArray();

    // Hitung SKS Tiap Dosen
    $semuaDosen = User::pluck('nama')->toArray();
    $sksDosen = DB::table('users')
        ->leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
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
        'prodi_sks' => $chartSKSProdi,
        'jenis_sk_sks' => $jenisSKS,
        'kk_sks' => $chartSKSKK,
        'dosen_sks' => $chartSKSDosen,
    ]);
}
