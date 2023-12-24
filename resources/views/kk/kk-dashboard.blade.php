@extends('layouts.layout-dosen')

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
                                <h4>Profile Dosen</h4>
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
                                                <td><h6>Email<span style="display: inline-block; margin-left: 23px;"></span>:</h6> </td>
                                                <td>{{$userDosen->email}}</td>
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
                            <div class="card-footer">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addSKModal">
                                    <i class="fa fa-pencil"></i>  Edit
                                </button>
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
                                {{-- <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addSKModal">
                                    <i class="fas fa-plus"></i>   Tambah Data SK
                                </button> --}}
                                
                                {{-- <a href="{{ url('print/' . $dosen->NIP) }}" class="btn btn-success mb-3" target="_blank" >Generate PDF</a> --}}

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

<div class="modal fade" id="addSKModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="{{ route('kk-update') }}" method="POST" enctype="multipart/form-data" novalidate>
                    {{ csrf_field() }}
                    <div class="card-header row"><h3 class="section-title col-8">Edit Data Diri</h2></div>
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }} <br />
                        @endforeach
                    </div>
                    @endif
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-col">
                                    <h3 class="section-title"></h3>
                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="username">NIP</label>
                                            <input type="text" class="form-control" name="NIP" value="{{ $userDosen->NIP}}" tabindex="1" required autofocus readonly>
                                            @error('NIP')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
    
                                        <div class="form-group col-md-6">
                                            <label for="username">Nama</label>
                                            <input type="text" class="form-control" name="nama" value="{{ $userDosen->nama}}"  tabindex="1" required autofocus>
                                            <div class="invalid-feedback">
                                                Isi Nama Dosen
                                            </div>
                                        </div>
    
    
                                        <div class="form-group col-md-6">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" name="email" value="{{ $userDosen->email}}" tabindex="1" required autofocus>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            {{-- {!! Form::submit('Save',['class'=>'btn btn-primary mb-5 mt-3'])!!} --}}
                                            <button class=" btn btn-primary mb-5 mt-3" type="submit">Update</button>
                                        </div>
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

@push('scripts')
    <script>
        $('#addSKModal').on('show.bs.modal', function (event) {
            var modal = $(this);
            modal.find('form').attr('action', "{{ route('kk-update') }}");
        });
    </script>
@endpush
