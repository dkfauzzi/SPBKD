<?

public function report($year = null)
{
    // Use the provided year to filter the data
    $data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
        ->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date');

    if ($year) {
        $data = $data->whereYear('test_sk_dosen.start_date', $year);
    }

    $data = $data->get();

    // The rest of your existing code for grouping and calculations...

    $pdf = PDF::loadView('sekretariat2.print-report', compact('dosenData', 'prodiData', 'kkData', 'year'));

    return $pdf->stream();
}

















=========================
public function report() {

$data = User::leftJoin('test_sk_dosen', 'users.NIP', '=', 'test_sk_dosen.NIP')
->select('users.*', 'test_sk_dosen.sks', 'test_sk_dosen.sk', 'test_sk_dosen.start_date')
->get();

// ========PRODI========
$groupedDataProdi = $data->groupBy('Prodi')->map(function ($group) {
    return $group->groupBy(function ($item) {
        $startDate = Carbon::parse($item->start_date);
        return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
    });
});

    
$prodiData = collect();

$groupedDataProdi->each(function ($groups, $Prodi) use ($prodiData) {
    $semester1Data = $groups->get('semester1', collect());
    $semester2Data = $groups->get('semester2', collect());

    $prodiData->push([
        'Prodi' => $Prodi,
        'semester1_sks' => $semester1Data->sum('sks'), // Total SKS for semester 1
        'semester2_sks' => $semester2Data->sum('sks'), // Total SKS for semester 2
        'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), // Total SKS for both semesters
        'semester1_sk' => $semester1Data->count(), // Count of SK for semester 1
        'semester2_sk' => $semester2Data->count(), // Count of SK for semester 2
        'total_sk' => $semester1Data->count() + $semester2Data->count(), // Total SK for both semesters
    ]);
});

// ========KELOMPOK KEAHLIAH========
$groupedDataKK = $data->groupBy('KK')->map(function ($group) {
    return $group->groupBy(function ($item) {
        $startDate = Carbon::parse($item->start_date);
        return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
    });
});

$kkData = collect();

$groupedDataKK->each(function ($groups, $KK) use ($kkData) {
    $semester1Data = $groups->get('semester1', collect());
    $semester2Data = $groups->get('semester2', collect());

    $kkData->push([
        'KK' => $KK,
        'semester1_sks' => $semester1Data->sum('sks'), // Total SKS for semester 1
        'semester2_sks' => $semester2Data->sum('sks'), // Total SKS for semester 2
        'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), // Total SKS for both semesters
        'semester1_sk' => $semester1Data->count(), // Count of SK for semester 1
        'semester2_sk' => $semester2Data->count(), // Count of SK for semester 2
        'total_sk' => $semester1Data->count() + $semester2Data->count(), // Total SK for both semesters
    ]);
});

// ========DOSEN========
$groupedDataDosen = $data->groupBy('NIP')->map(function ($group) {
    return $group->groupBy(function ($item) {
        $startDate = Carbon::parse($item->start_date);
        return ($startDate->month >= 1 && $startDate->month <= 6) ? 'semester1' : 'semester2';
    });
});

// Prepare data for the table
$dosenData = collect();

$groupedDataDosen->each(function ($groups, $NIP) use ($dosenData) {
    $semester1Data = $groups->get('semester1', collect());
    $semester2Data = $groups->get('semester2', collect());

    $dosenData->push([
        'NIP' => $NIP,
        'nama' => $groups->first()->first()->nama ?? '',
        'semester1_sks' => $semester1Data->sum('sks'), // Total SKS for semester 1
        'semester2_sks' => $semester2Data->sum('sks'), // Total SKS for semester 2
        'total_sks' => $semester1Data->sum('sks') + $semester2Data->sum('sks'), // Total SKS for both semesters
        'semester1_sk' => $semester1Data->count(), // Count of SK for semester 1
        'semester2_sk' => $semester2Data->count(), // Count of SK for semester 2
        'total_sk' => $semester1Data->count() + $semester2Data->count(), // Total SK for both semesters
    ]);
});


$pdf = PDF::loadView('sekretariat2.print-report', compact('dosenData','prodiData','kkData'));

return $pdf->stream();

}