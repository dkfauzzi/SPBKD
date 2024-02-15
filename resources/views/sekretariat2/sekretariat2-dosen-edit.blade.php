    @extends('layouts.layout-sekretariat2')

@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">

        @include('navbar')

        @include('sidebar.sidebar')

        <!-- Main Content -->
        <div class="main-content" style="padding-top:80px">
            <div class="card border border-2">
                <form class="needs-validation" action="{{ route('sekretariat2-dosen-update', ['NIP' => $data->NIP]) }}" method="POST" enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="card-header row">
                        <h3 class="section-title col-8">Edit Data Dosen</h2>
                    </div>

                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} 
                            @endforeach
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-col">
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="inputJudul">NIP<span style="color: red;">*</span></label>
                                        <input class="form-control" type="text" value="{{$data->NIP}}" name="NIP" readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="inputJudul">Nama Dosen</label><br>
                                        <input class="form-control" type="text" value="{{$data->nama}}" name="nama">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="username">JAD</label>
                                        <select class="form-select" aria-label="Default select example" name="JAD">
                                            @foreach($jadValues as $jadValue)
                                                <option value="{{ $jadValue }}" {{ $data->JAD == $jadValue ? 'selected' : '' }}>{{ $jadValue }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="username">Program Studi</label>
                                        <select class="form-select" aria-label="Default select example" name="Prodi">
                                            @foreach($prodiValues as $prodiValue)
                                                <option value="{{ $prodiValue }}" {{ $data->Prodi == $prodiValue ? 'selected' : '' }}>{{ $prodiValue }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">Kelompok Keahlian</label>
                                        <select class="form-select" aria-label="Default select example" name="KK">
                                            @foreach($kkValues as $kkValue)
                                                <option value="{{ $kkValue }}" {{ $data->KK == $kkValue ? 'selected' : '' }}>{{ $kkValue }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="username">Role Pada Website</label>
                                        <select class="form-select" aria-label="Default select example" name="level">
                                            @foreach($allLevels as $levelValue)
                                                <option value="{{ $levelValue }}" {{ $data->level == $levelValue ? 'selected' : '' }}>
                                                    @switch($levelValue)
                                                        @case('dekan')
                                                            Dekan
                                                            @break
                                                        @case('wakildekan1')
                                                            Wakil Dekan 1
                                                            @break
                                                        @case('wakildekan2')
                                                            Wakil Dekan 2
                                                            @break
                                                        @case('dosen')
                                                            Dosen
                                                            @break
                                                        @case('kaprodi')
                                                            Ketua Program Studi
                                                            @break
                                                        @case('ketuaKK')
                                                            Ketua Kelompok Keahlian
                                                            @break
                                                        @case('sekretariat2')
                                                            Sekretariat
                                                            @break
                                                        @default
                                                            {{ $levelValue }}
                                                    @endswitch
                                                </option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                    
                                    
                                    
                                    
                                    {{-- <div class="form-group col-md-6">
                                        <label for="username">Email</label>
                                        <input type="text" class="form-control" value="{{$data->email}}" name="email" tabindex="1" required autofocus>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required autofocus>
                                    </div> --}}

                                    <div class="form-group col-md-6">
                                        {!! Form::submit('Save',['class'=>'btn btn-primary mb-5 mt-3'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection