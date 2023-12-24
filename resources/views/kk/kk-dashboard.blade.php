@extends('layouts.layout-prodi')

@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">

        @include('navbar')

        @include('sidebar.sidebar-dosen')

        <!-- Main Content -->
        <div class="main-content" style="padding-top:80px">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Profile Kelompok Keahlian</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-1 " >
                                        <img class="rounded-circle img-fluid" src="assets_index/assets/img/about/1.jpg" alt="..."  style="width: 80%"/>
                                    </div>
                                    <div class="col">   
                                        <table style="width: 20%">
                                            <tr>
                                                <td> <h6>Nama<span style="display: inline-block; margin-left: 7px;"></span>:</h6> </td>
                                                <td>{{$userDosen->nama}}</td>
                                            </tr>
                                            <tr>
                                                <td><h6>NIP<span style="display: inline-block; margin-left: 23px;"></span>:</h6> </td>
                                                <td>{{$userDosen->NIP}}</td>
                                            </tr>
                                            <tr>
                                                <td><h6>Prodi<span style="display: inline-block; margin-left: 12px;"></span>:</h6> </td>
                                                <td>{{$userDosen->Prodi}}</td>
                                            </tr>
                                            <tr>
                                                <td><h6>JAD<span style="display: inline-block; margin-left: 22px;"></span>: </h6></td>
                                                <td>{{$userDosen->JAD}}</td>
                                            </tr>
                                            <tr>
                                                <td><h6>KK<span style="display: inline-block; margin-left: 31px;"></span>:</h6> </td>
                                                <td>{{$userDosen->KK}}</td>
                                            </tr>
                                          </table>
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
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Data SK {{$userDosen->nama}}</h4>
                            </div>
                            <div class="card-body table-responsive">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($dataDosen as $record)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-center">{{ $record->sk }}</td>
                                            <td class="text-center">{{ $record->sks }}</td>
                                            <td class="text-center">{{ $record->jenis_sk }}</td>
                                            <td class="text-center">{{ $record->keterangan_sk }}</td>
                                            <td class="text-center">{{ $record->start_date ? Carbon\Carbon::parse($record->start_date)->translatedFormat('d F Y', 'id') : '' }}</td>
                                            <td class="text-center">{{ $record->end_date ? Carbon\Carbon::parse($record->end_date)->translatedFormat('d F Y', 'id') : ''}}</td>
                                            <td class="text-center">{{ $record->start_sk }}</td>
                                            <td class="text-center">{{ $record->end_sk}}</td>
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
