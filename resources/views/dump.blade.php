<?

public function index()
{
    // Fetch all users and their related SK information
    $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk')
        ->get();

    // Hitung jumlah SK with specific NIP (per-dosen)
    $totalSKS = $data->groupBy('NIP')->map(function ($group) {
        return [
            'NIP' => $group->first()->NIP,
            'nama' => $group->first()->nama,
            'JAD' => $group->first()->JAD,
            'Prodi' => $group->first()->Prodi,
            'KK' => $group->first()->KK,
            'email' => $group->first()->email,
            'total_sk' => $group->count(), // Count of rows with the same 'NIP'
            'total_sks' => $group->sum('sks'),
        ];
    });

    return view('sekretariat2.sekretariat2-search', compact('data', 'totalSKS'));
}

public function index()
{
    // Fetch all users and their related SK information
    $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk')
        ->get();

    // Count the number of rows for each unique NIP in the test_sk_dosen table
    $countNIPRows = $data->groupBy('NIP')->map(function ($group) {
        return [
            'NIP' => $group->first()->NIP,
            'count_rows' => $group->count(), // Count of rows with the same 'NIP' in test_sk_dosen
        ];
    });

    // Hitung jumlah SK with specific NIP (per-dosen)
    $totalSKS = $data->groupBy('NIP')->map(function ($group) {
        return [
            'NIP' => $group->first()->NIP,
            'nama' => $group->first()->nama,
            'JAD' => $group->first()->JAD,
            'Prodi' => $group->first()->Prodi,
            'KK' => $group->first()->KK,
            'email' => $group->first()->email,
            'total_sk' => $group->count(), // Count of rows with the same 'NIP'
            'total_sks' => $group->sum('sks'),
        ];
    });

    return view('sekretariat2.sekretariat2-search', compact('data', 'totalSKS', 'countNIPRows'));
}

// Prepare $countNIPRows to include all NIPs with count initialized to 0
$countNIPRows = TestSkDosen::select('NIP')
    ->selectRaw('COUNT(*) as count_rows')
    ->groupBy('NIP')
    ->pluck('count_rows', 'NIP')
    ->toArray();
