<?

document.addEventListener("DOMContentLoaded", function () {
    // Fetch data for all charts from the server using AJAX
    fetch('/chart/data-sk-semester')
        .then(response => response.json())
        .then(data => {
            // Use the data to create the 'prodi' chart
            var ctxProdi = document.getElementById('prodi_SK').getContext('2d');
            var prodiChart = new Chart(ctxProdi, {
                type: 'bar',
                data: {
                    labels: Object.keys(data.prodi_SK['Semester 1']), // Use 'Semester 1' or 'Semester 2' as needed
                    datasets: [{
                        label: 'SK Tiap Prodi Semester 1', // Change label accordingly
                        data: Object.values(data.prodi_SK['Semester 1']),
                        backgroundColor: 'rgba(0, 0, 255, 0.2)', // Blue background color
                        borderColor: 'rgba(0, 0, 255, 1)', // Blue border color
                        borderWidth: 1
                    },
                    {
                        label: 'SK Tiap Prodi Semester 2', // Change label accordingly
                        data: Object.values(data.prodi_SK['Semester 2']),
                        backgroundColor: 'rgba(255, 0, 0, 0.2)', // Red background color
                        borderColor: 'rgba(255, 0, 0, 1)', // Red border color
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                    scales: {
                        x: {},
                        y: {}
                    },
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            display: 'auto', // Display the label
                            color: 'black', // Label color
                            font: {
                                weight: 'bold'
                            },
                            formatter: function(value, context) {
                                return value; // Display the value of the bar as the label
                            }
                        }
                    }
                }
            });

            // Add other charts as needed

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});
















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