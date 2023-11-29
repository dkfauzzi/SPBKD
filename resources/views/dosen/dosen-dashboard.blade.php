@extends('layouts.layout-dosen')

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
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Data Dosen (ROLE DOSEN HERE)</h4>
                                <h4>Data Dosen</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <a href=<?php echo url('dosen-tambah-sk') ?>
                                    class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data</a>
                                <table class="table table-bordered" id="table1" style="width: 100%">
                                    <thead style="border-color:black">
                                        <tr >
                                            <th class="text-center" rowspan="2" style=" width:10px;">No</th>
                                            <th class="text-center" rowspan="2" style="width:90px;">SK</th>
                                            <th class="text-center" rowspan="2" style="width:90px; ">SKS</th>
                                            <th class="text-center"colspan="4" style="">2023</th>
                                        </tr>

                                        <tr >
                                            <th class="text-center">TW 1</th>
                                            <th class="text-center">TW 2</th>
                                            <th class="text-center">TW 3</th>
                                            <th class="text-center">TW 4</th>

                                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0?>
                                        @foreach ($data as $sk)
                                        <tr>
                                            <td>{{1+$no++}}</td>
                                            <td>{{$sk->sk}}</td>
                                            <td>{{$sk->sks}}</td>
                                            {{-- <td class="text-center">{{$sk->q1_start_indonesian}} - {{$sk->q1_end_indonesian}}</td> --}}
                                            <td class="text-center">
                                                {{$sk->q1_start ? Carbon\Carbon::parse($sk->q1_start)->translatedFormat('d F Y') : ''}} 
                                                - 
                                                {{$sk->q1_end ? Carbon\Carbon::parse($sk->q1_end)->translatedFormat('d F Y') : ''}}
                                            </td>
                                            <td class="text-center">
                                                {{$sk->q2_start ? Carbon\Carbon::parse($sk->q2_start)->translatedFormat('d F Y', 'id') : ''}} 
                                                - 
                                                {{$sk->q2_end ? Carbon\Carbon::parse($sk->q2_end)->translatedFormat('d F Y','id') : ''}}
                                            </td>
                                            <td class="text-center">
                                                {{$sk->q3_start ? Carbon\Carbon::parse($sk->q3_start)->translatedFormat('d F Y', 'id') : ''}} 
                                                - 
                                                {{$sk->q3_end ? Carbon\Carbon::parse($sk->q3_end)->translatedFormat('d F Y','id') : ''}}
                                            </td>
                                            <td class="text-center">
                                                {{$sk->q4_start ? Carbon\Carbon::parse($sk->q4_start)->translatedFormat('d F Y', 'id') : ''}} 
                                                - 
                                                {{$sk->q4_end ? Carbon\Carbon::parse($sk->q4_end)->translatedFormat('d F Y','id') : ''}}
                                            </td>

                                            {{-- Other format  --}}

                                            {{-- <td class="text-center">{{$sk->q2_start_indonesian}} - {{$sk->q2_end_indonesian}}</td>
                                            <td class="text-center">{{$sk->q3_start_indonesian}} - {{$sk->q3_end_indonesian}}</td>
                                            <td class="text-center">{{$sk->q4_start_indonesian}} - {{$sk->q4_end_indonesian}} </td> --}}
                                            {{-- <td class="text-center">{{$sk->q4_start}}</td>

                                        
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
