

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