@extends('layouts.layout-sekretariat')

@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>

        @include('navbar')

        @include('sidebar.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="card card-primary">
                <form class="needs-validation" action="sekretariat-dashboard" method="POST" enctype="multipart/form-data" novalidate>
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
                        <!-- SAVED FOR ACCORDION -->
                        <div class="accordion-pendaftaran">
                            <div class="accordion-pendaftaran-item">
                                <div class="accordion-pendaftaran-item-body">
                                    <div class="accordion-pendaftaran-item-content">
                                        <div class="data-mahasiswa">
                                            <div class="form-group">
                                                <div class="form-row">
                                                
                                                <div class="form-col">
                                                    <h3 class="section-title">Triwulan 1 (Januari - Mei)</h3>
                                                    <div class="form-row">

                                                        <div class="form-group col-md-6">
                                                            <label for="inputJudul">Kegiatan SK Dosen</label><br>
                                                            <textarea class="form-control" type="text" name="sk" id="sk" placeholder="Jenis SK" required></textarea>
                                                            <div class="invalid-feedback">
                                                                Isi Kegiatan SK.
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="inputJudul">Jumlah SKS</label><br>
                                                            <textarea class="form-control" type="text" name="sks" id="sks" placeholder="Jumlah SKS" required></textarea>
                                                            <div class="invalid-feedback">
                                                                Isi Jumlah SKS.
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="start_date">Tanggal Mulai SK</label><br>
                                                            <input class="form-control" type="date" name="start_date" id="start_date" placeholder="Tanggal Mulai" required>
                                                            <div class="invalid-feedback">
                                                                Isi Tanggal Mulai SK.
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="inputJudul">Tanggal Berakhir SK</label><br>
                                                            <input class="form-control" type="date" name="end_date" id="end_date" placeholder="Tanggal Berakhir" required>
                                                            <div class="invalid-feedback">
                                                                Isi Tanggal Berakhir SK.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            {!! Form::submit('Save',['class'=>'btn btn-primary mb-5 mt-3'])!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- @include('footer') --}}
        </div>
        {!! Form::close()!!}
    </div>
</div>
@endsection