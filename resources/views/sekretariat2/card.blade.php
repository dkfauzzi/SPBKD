@extends('layouts.layout-sekretariat2')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        /* Add a custom class to style the anchor tags */
        .custom-card-link {
            text-decoration: none; /* Remove underline */
            color: inherit; /* Inherit color from parent */
            cursor: pointer; /* Show pointer cursor on hover */
        }
    </style>

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
                                        <h4>Profile Dosen</h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <div class="container">
                                            <div class="row">
                                                @foreach($data as $card)
                                                    <div class="col-md-4">
                                                        <a href="{{ route('sekretariat2.show', $card) }}" class="custom-card-link">
                                                            <div class="card border border-2">
                                                                <div class="card-body">
                                                                    <div class=" " >
                                                                        <img src="" alt="">
                                                                        <img class="rounded-circle img-fluid center" src="assets_index/assets/img/about/1.jpg" alt="NP{E}"  style="width: 20%"/>
                                                                    </div>
                                                                    <p class="card-text">{{ $card->nama }}</p>
                                                                    <p class="card-text">{{ $card->JAD }}</p>
                                                                    <p class="card-text">{{ $card->Prodi }}</p>
                                                                    <p class="card-text">{{ $card->KK }}</p>
                                                                    <p class="card-text">{{ $card->NIP }}</p>
                                                                    <p class="card-text">{{ $card->start_date }}</p>
                                                                    <p class="card-text">{{ $card->end_date }}</p>
                                                                    <p class="card-text">{{ $card->start_sk }}</p>
                                                                    <p class="card-text">{{ $card->end_sk }}</p>
                                                                </div>
                                                                
                                                                {{-- <div class="card-body">
                                                                    <p class="card-text">{{ $card->sks }}</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text">{{ $card->jenis_sk }}</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text">{{ $card->keterangan_sk }}</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text">{{ $card->start_date }}</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text">{{ $card->end_date }}</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text">{{ $card->start_sk }}</p>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="card-text">{{ $card->end_sk }}</p>
                                                                </div> --}}
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-12">
                                <div class="card border border-2">
                                    <div class="card-header">
                                        <h4>(THIS IS ROLE SEKRETARIAT 2222)</h4>
                                        <h4>Data Dosen</h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <a href=<?php echo url('sekretariat2-tambah-sk') ?>
                                            class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data</a>
        
                                            <a href="/print" class="btn btn-primary">Export PDF</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
        
            </div>
        
        </div>

@endsection
