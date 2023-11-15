@extends('layouts.layout-dosen')

@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>

        @include('navbar')

        @include('sidebar.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="card card-primary">
                <form class="needs-validation" action="dosen-dashboard" method="POST" enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}
                    <div class="card-header row">
                        <h3 class="section-title col-8">Tambah SK Dosen *TEST*</h2>
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
                                                   
                                                </div>
                                               

                                               <div class="form-col">
                                                    <h3 class="section-title">Triwulan 1 (Januari - Mei)</h3>
                                                    <div class="form-row">

                                                            <h1>Create Quarter Date</h1>

                                                            {{-- <form method="POST" action="dosen-dashboard">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="full_date">Full Date</label>
                                                                    <input type="date" name="full_date" id="full_date" class="form-control">
                                                                </div>
                                                                <button type="submit" class="btn btn-success">Create</button>
                                                            </form> --}}

                                                            <form class="needs-validation" action="sekretariat-dashboard" method="POST" enctype="multipart/form-data" novalidate>
                                                                {{ csrf_field() }}
                                                        
                                                                {{-- <form method="POST" action="dosen-dashboard">
                                                                @csrf --}}
                                                                <label for="start_date">Start Date:</label>
                                                                <input type="date" name="start_date" id="start_date" required>
                                                                <br>
                                                        
                                                                <label for="end_date">End Date:</label>
                                                                <input type="date" name="end_date" id="end_date" required>
                                                                <br>

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
                                                        
                                                                <button type="submit">Submit</button>
                                                            </form>
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
                </form>
            </div>
            {{-- @include('footer') --}}
        </div>
        {!! Form::close()!!}
    </div>
</div>
@endsection