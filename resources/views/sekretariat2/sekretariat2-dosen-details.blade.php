@extends('layouts.layout-sekretariat2')

@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">

        @include('navbar')

        @include('sidebar.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Dosen</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-1 " >
                                        <img class="rounded-circle img-fluid" src="assets_index/assets/img/about/1.jpg" alt="..."  style="width: 80%"/>
                                    </div>
                                    <div class="col">   
                                        <h6>Nama: {{ $data->nama }}</h6>
                                        <h6>NIP : {{ $data->NIP }}</h6>
                                        <h6>Prodi : {{ $data->Prodi }}</h6>
                                        <h6>JAD : {{ $data->JAD }} </h6>
                                        <h6>Kelompok Keahlian : {{ $data->KK }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data SK {{ $data->nama }}</h4>
                            </div>
                            <div class="card-body table-responsive">
                                {{-- <a href=<?php echo url('sekretariat2-tambah-sk') ?> class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data</a> --}}

                                <a href="{{ route('sekretariat2-tambah-sk', ['NIP' => $data->NIP]) }}" class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data SK</a>

                                <a href="/print" class="btn btn-primary">Export PDF</a>
                                <table class="table table-bordered" id="table1">
                                    <thead style="border-color:black">
                                        <tr >
                                            <th class="text-center" style=" width:10px;">No</th>
                                            <th class="text-center" style="width:90px;">SK</th>
                                            <th class="text-center"style="width:90px; ">SKS</th>
                                            <th class="text-center"style="width:auto">Jenis SK</th>
                                            <th class="text-center"style="width:auto">Keterangan SK</th>
                                            <th class="text-center"style="width:auto">Tanggal Mulai</th>
                                            <th class="text-center"style="width:auto">Tanggal Berakhir</th>
                                            <th class="text-center" style="width:auto">Triwulan Dimulai</th>
                                            <th class="text-center"style="width:auto">Triwulan Berakhir</th>
                                            <th class="text-center"style="width:auto">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($test as $record)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-center">{{ $record->sks }}</td>
                                            <td class="text-center">{{ $record->sk }}</td>
                                            <td class="text-center">{{ $record->jenis_sk }}</td>
                                            <td class="text-center">{{ $record->keterangan_sk }}</td>
                                            <td class="text-center">{{ $record->start_date ? Carbon\Carbon::parse($record->start_date)->translatedFormat('d F Y', 'id') : '' }}</td>
                                            <td class="text-center">{{ $record->end_date ? Carbon\Carbon::parse($record->end_date)->translatedFormat('d F Y', 'id') : ''}}</td>
                                            <td class="text-center">{{ $record->start_sk }}</td>
                                            <td class="text-center">{{ $record->end_sk}}</td>
                                            <td>
                                                {{-- {{ link_to(route('sekretariat2-dosen-details', ['NIP' => $total['NIP']]), 'Hapus SK', ['class' => 'btn btn-success']) }} --}}
                                                {{ link_to('sekretariat2-dosen-details/'.$record['NIP'], 'Hapus SK', ['class' => 'btn btn-danger']) }}

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>



@endsection
