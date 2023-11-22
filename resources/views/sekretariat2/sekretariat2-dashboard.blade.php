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
                                        <h6>Nama: M Yasser Yusuf</h6>
                                        <h6>NIP : 123456789</h6>
                                        <h6>JAD : Assisten Ahli </h6>
                                        <h6>Kelompok Keahlian : PROMASYS</h6>
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
                                <h4>(THIS IS ROLE SEKRETARIAT 2222)</h4>
                                <h4>Data Dosen</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <a href=<?php echo url('sekretariat2-tambah-sk') ?>
                                    class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data</a>

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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0?>
                                        @foreach ($data as $sk)
                                        <tr>    
                                            <td>{{1+$no++}}</td>
                                            <td class="text-center">{{$sk->sk}}</td>
                                            <td class="text-center">{{$sk->sks}}</td>
                                            {{-- <td>tEST</td> --}}
                                            {{-- <td class="text-center">{{$sk->q1_start_indonesian}} TEST {{$sk->q1_end_indonesian}}</td> --}}
                                            <td class="text-center">
                                                {{$sk->jenis_sk}}
                                            </td>
                                            <td class="text-center">
                                                {{$sk->keterangan_sk}}
                                            </td>
                                            <td class="text-center">
                                                {{$sk->start_date ? Carbon\Carbon::parse($sk->start_date)->translatedFormat('d F Y', 'id') : ''}}
                                            <td class="text-center">
                                                {{$sk->end_date ? Carbon\Carbon::parse($sk->end_date)->translatedFormat('d F Y', 'id') : ''}}
                                                {{-- {{$sk->q2_start ? Carbon\Carbon::parse($sk->q2_start)->translatedFormat('d F Y', 'id') : ''}}  --}}

                                            </td>
                                            <td class="text-center">
                                                {{$sk->start_sk}}
                                            </td>
                                            <td class="text-center">
                                                {{$sk->end_sk}}
                                            </td>
                                            {{-- <td>{{link_to('print'.$sk,'Download',['class'=>'btn btn-success', 'target'=>'_blank'])}}</td> --}}
                                            
                                            {{-- //Tombol Action --}}
                                            {{-- <td>
                                                {{link_to('dashboard-koordinator-edit-kp/'.$kp->id,'Edit',['class'=>'btn btn-warning'])}}
                                            </td>
                                            <td>
                                                {!! 
                                                Form::open(['url'=>'dashboard-koordinator-kp/'.$kp->id,'method'=>'delete'])!!}
                                                {!! Form::submit('Delete',['class'=>'btn
                                                btn-danger','onclick'=>'return confirm("Are you sure?")'])!!}
                                                {!! Form::close()!!}
                                            </td> --}}
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
