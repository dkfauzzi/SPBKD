@extends('layouts.layout-dekan')

@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">

        @include('navbar')

        @include('sidebar.sidebar-dekan')

        <!-- Main Content -->
        <div class="main-content" style="padding-top:80px">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                    </div>
                </div>
            </div> 
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card border border-2">
                            <div class="card-header">
                                <h3 class="header-nav">Cari Data Dosen</h3>
                            </div>
                            <div class="card-body table-responsive">
                                {{-- <a href=<?php echo url('sekretariat2-tambah-sk') ?>
                                    class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah Data SK
                                </a> --}}
                                <table class="table table-bordered" id="table1">
                                    <thead style="border-color:black">
                                        <tr >
                                            <th class="text-center" style=" width:10px;">No</th>
                                            <th class="text-center" style="width:auto;">Nama</th>
                                            <th class="text-center"style="width:auto; ">NIP</th>
                                            <th class="text-center"style="width:180px">Kelompok Keahlian</th>
                                            <th class="text-center"style="width:180px">Prodi</th>
                                            <th class="text-center"style="width:auto">JAD</th>
                                            <th class="text-center" style="width:auto;">SKS</th>
                                            <th class="text-center" style="width:auto;">Total SK</th>
                                            <th class="text-center" style="width:auto">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0?>
                                        @foreach ($totalSKS as $total)
                                        @php
                                            // Check if the current NIP exists in $countNIPRows
                                            $countRows = isset($countNIPRows[$total['NIP']]) ? $countNIPRows[$total['NIP']] : 0;
                                        @endphp
                                        <tr>   
                                            <td class="text-center">{{1+$no++}}</td>
                                            <td class="text-center">{{ $total['nama'] }}</td>
                                            <td class="text-center">{{ $total['NIP'] }}</td>
                                            <td class="text-center">{{ $total['KK'] }}</td>
                                            <td class="text-center">{{ $total['Prodi'] }}</td>
                                            <td class="text-center">{{ $total['JAD'] }}</td>
                                            <td class="text-center">{{ $total['total_sks'] }}</td>
                                            <td class="text-center">{{ $countRows }}</td>
                                            <td class="text-center">
                                                <!-- Pindah ke halaman detail sesuai'NIP' -->
                                                {{ link_to(route('dekan-dosen-details', ['NIP' => $total['NIP']]), '', ['class' => ' fa fa-eye btn btn-success', 'style'=>'font-size: 20px;']) }}

                                                {{-- {{ link_to(route('sekretariat2-dosen-edit', ['NIP' => $total['NIP']]), '', ['class' => 'fa fa-pencil btn btn-warning', 'style'=>'font-size: 20px;']) }} --}}

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






