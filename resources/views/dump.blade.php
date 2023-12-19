<?

<form class="needs-validation" action="{{ route('tambah') }}" method="POST" enctype="multipart/form-data" novalidate>
    {{ csrf_field() }}
    <div class="card-header row">
        <h3 class="section-title col-8">Tambah SK Dosen</h2>
    </div>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }} <br />
            @endforeach
        </div>
    @endif
    <div class="card-body">
        <div class="form-group">
            <div class="form-col">
                <h3 class="section-title"></h3>
                <div class="form-row">
                    @for($i = 1; $i <= 3; $i++)
                        <div class="form-group col-md-6">
                            <label for="inputJudul">NIP</label><br>
                            <select class="form-select nip-dropdown" name="sets[{{ $i }}][NIP]" id="nip_dropdown{{ $i }}" data-index="{{ $i }}" required>
                                <option value="" selected disabled>Select NIP</option>
                                @foreach($nipOptions as $nip)
                                    <option>{{ $nip }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nama">Nama Dosen</label>
                            <input class="form-control" type="text" name="sets[{{ $i }}][nama]" id="nama_field{{ $i }}" readonly>
                            <div class="invalid-feedback">Isi Nama Dosen</div>
                        </div>
                    @endfor
                </div>

                <!-- Other form fields go here -->

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {!! Form::submit('Simpan',['class'=>'btn btn-primary mb-5 mt-3'])!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>














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