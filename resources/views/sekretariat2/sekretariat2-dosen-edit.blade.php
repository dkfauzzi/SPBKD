@extends('layouts.layout-sekretariat2')

@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>

        @include('navbar')

        @include('sidebar.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="card card-primary">
                <form class="needs-validation" action="{{ route('sekretariat2-dosen-details', ['NIP' => $data->NIP]) }}" method="POST" enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="card-header row">
                        <h3 class="section-title col-8">Edit SK Dosen</h2>
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
                                                    <h3 class="section-title"></h3>
                                                    <div class="form-row">

                                                        {{-- <div class="form-group col-md-6">
                                                            <label for="inputDraft">Alamat Perusahaan<span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" name="alamat_perusahaan" value="{{$kp->alamat_perusahaan}}" placeholder="alamat Perusahaan" required>
                                                            <div class="invalid-feedback">
                                                                Isi Alamat perusahaan Kerja Praktik.
                                                            </div>
                                                        </div> --}}

                                                        <div class="form-group col-md-6">
                                                            <label for="inputJudul">NIP<span style="color: red;">*</span></label>
                                                            <input class="form-control" type="text" value="{{$data->NIP}}" name="NIP" readonly>
                                                            <div class="invalid-feedback">
                                                                Isi NIP
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="inputJudul">Nama Dosen</label><br>
                                                            <input class="form-control" type="text" value="{{$data->nama}}" readonly>
                                                            <div class="invalid-feedback">
                                                                Isi NIP
                                                            </div>
                                                        </div>

                                                        {{-- <div class="form-group">
                                                            <label for="username">NIP</label>
                                                            <input  type="text" class="form-control" name="NIP" tabindex="1" required autofocus>
                                                            <div class="invalid-feedback">
                                                                Isi NIP Dosen
                                                            </div>
                                                        </div>
                    
                                                        <div class="form-group">
                                                            <label for="username">Nama</label>
                                                            <input type="text" class="form-control" name="nama" tabindex="1" required autofocus>
                                                            <div class="invalid-feedback">
                                                                Isi Nama Dosen
                                                            </div>
                                                        </div> --}}
                    
                                                        <div class="form-group col-md-6">
                                                            <label for="username">JAD</label>
                                                            <select class="form-select" aria-label="Default select example" name="JAD">
                                                                <option value="Lektor">Lektor</option>
                                                                <option value="Asisten Ahli">Asisten Ahli</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Isi JAD Dosen
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label for="username">Program Studi</label>
                                                            <select class="form-select" aria-label="Default select example" name="Prodi">
                                                                <option value="S1 Teknik Industri">S1 Teknik Industri</option>
                                                                <option value="S2 Teknik Industri">S2 Teknik Industri</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Isi Prodi Dosen
                                                            </div>
                                                        </div>
                    
                                                        <div class="form-group col-md-6">
                                                            <label for="">Kelompok Keahlian</label>
                                                            <select class="form-select" aria-label="Default select example" name="KK">
                                                                <option value="CYBERNET">CYBERNET</option>
                                                                <option value="EINS">EINS</option>
                                                                <option value="PROMASYS">PROMASYS</option>
                                                                <option value="ENGINEERING MANAGEMENT">ENGINEERING MANAGEMENT</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Isi Kelompok Keahlian Dosen
                                                            </div>
                                                        </div>
                    
                                                        <div class="form-group col-md-6">
                                                            <label for="username">Role Pada Website</label>
                                                            <select class="form-select" aria-label="Default select example" name="level">
                                                                <option value="dekan">Dekan</option>
                                                                <option value="wd1">Wakil Dekan 1</option>
                                                                <option value="wd2">Wakil Dekan 2</option>
                                                                <option value="kaprodi">Ketua Program Studi</option>
                                                                <option value="ketuaKK">Ketua Kelompok Keahlian</option>
                                                                <option value="dosen">Dosen</option>
                                                                <option value="sekretariat">Sekretariat</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Isi Role Dosen
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group col-md-6">
                                                            <label for="username">Email</label>
                                                            <input type="text" class="form-control" value="{{$data->email}}" name="email" tabindex="1" required autofocus>
                                                            <div class="invalid-feedback">
                                                                Isi Email Dosen
                                                            </div>
                                                        </div>
                    
                                                        <div class="form-group col-md-6">
                                                            <div class="d-block">
                                                                <label for="password" class="control-label">Password</label>
                                                            </div>
                                                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required autofocus>
                                                            <div class="invalid-feedback">
                                                                Isi Passwordd Dosen
                                                            </div>
                                                        </div>
{{--                                                         
                                                        <div class="row-group col-md-6">
                                                            <div class="col-xs-8"></div>
                                                            <div class="col-xs-4">
                                                                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                                            </div>
                                                        </div> --}}

                                                    <div class="form-row col-md-6">
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