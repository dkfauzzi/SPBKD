@extends('layouts.layout-dekan')

@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">

        @include('navbar')

        @include('sidebar.sidebar-dekan')

        <!-- Main Content -->
        <div class="main-content">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Profile Dosen</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-1 " >
                                        <img src="" alt="">
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
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>(ROLE DEKAN HERE)</h4>
                                <h4>Data Dosen</h4>
                            </div>
                            <div class="card-body table-responsive">
                                {{-- <a href=<?php echo url('dashboard-koordinator-tambah-kp') ?>
                                    class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data</a> --}}
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

                                    {{-- <tbody>
                                        <tr>
                                            <td style="text-align: right;">1</td>
                                            <td style="text-align: left;">SK Wadek</td>
                                            <td style="text-align: center; background-color:" colspan="4">Juni 2023 - Juni 2024 / 2 SKS</td>
                                            <td style="text-align: center; display: none">Apr 2023</td>
                                            <td style="text-align: center; display: none">Jul 2023</td>
                                            <td style="text-align: center; display: none">Nov 2023</td>
                                        </tr>
                                         <tr>
                                            <td style="text-align: right;">2</td>
                                            <td style="text-align: left;">SK Ketua PKS</td>
                                            <td style="text-align: center; background-color:" colspan="2">Januari 2023-Juni 2023 / 1 SKS</td>
                                            <td style="text-align: center; display: none">-</td>
                                            <td style="text-align: center;">-</td>
                                            <td style="text-align: center; ">-</td>
                                        </tr>
                                         <tr>
                                            <td style="text-align: right;">3</td>
                                            <td style="text-align: left;">SK TPAK UNI</td>
                                            <td style="text-align: center; background-color:" colspan="4">Januari 2023 - Desember 2024 / 1 SKS</td>
                                            <td style="text-align: center; display: none"></td>
                                            <td style="text-align: center; display: none"></td>
                                            <td style="text-align: center; display: none"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">4</td>
                                            <td style="text-align: left;">Pembimbing Tugas Akhir</td>
                                            <td style="text-align: center; ">-</td>
                                            <td style="text-align: center; ">-</td>
                                            <td style="text-align: center; background-color: " colspan="2">September 2023 - Januari 2023 / 0,5 SKS</td>
                                            <td style="text-align: center; display: none">-</td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">5</td>
                                            <td style="text-align: left;">Pembimbing KP</td>
                                            <td style="text-align: center;">-</td>
                                            <td style="text-align: center;">-</td>
                                            <td style="text-align: center;">-</td>
                                            <td style="text-align: center;">-</td>
                                        </tr>
                                    </tbody> --}}

                                    <tbody>
                                        <?php $no = 0?>
                                        @foreach ($sk_dosen as $sk)
                                        <tr>
                                            <td>{{1+$no++}}</td>
                                            <td>{{$sk->sk}}</td>
                                            <td class="text-center">{{$sk->sks}}</td>
                                            <td class="text-center" >{{$sk->tw1}}</td>
                                            <td class="text-center">{{$sk->tw2}}</td>
                                            <td class="text-center">{{$sk->tw3}}</td>
                                            <td class="text-center">{{$sk->tw4}}</td>
                                            {{-- <td>{{$kp->bidang_perusahaan}}</td>
                                            <td>{{$kp->pembimbing_perusahaan}}</td>
                                            <td>{{$kp->mulai_kp}}</td>
                                            <td>{{$kp->selesai_kp}}</td>
                                            <td>{{$kp->updated_at}}</td> --}}
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
