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
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Profile Dosen</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-1 " >
                                        @if(is_object($data) && $data->image_path)
                                            <img class="rounded-circle img-fluid" src="{{ asset('storage/' . $data->image_path) }}" alt="User Image">
                                        @else
                                            <img class="rounded-circle img-fluid" src="{{ asset('profile_image/avatar-1.png') }}" alt="Default Image">
                                        @endif
                                    </div>
                                    <div class="col">   
                                        <h6>Nama: {{ $data->nama }}</h6>
                                        <h6>NIP : {{ $data->NIP }}</h6>
                                        <h6>Prodi : {{ $data->Prodi }}</h6>
                                        <h6>JAD : {{ $data->JAD }} </h6>
                                        <h6>Kelompok Keahlian : {{ $data->KK }}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('dekan-search') }}" class="btn btn-success"><i class="fas fa-arrow-left"></i> Kembali</a>
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
                                <h4>Data SK {{ $data->nama }}</h4>
                            </div>
                            <div class="card-body table-responsive">
                                
                                {{-- <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#addSKModal">
                                    <i class="fas fa-plus"></i>   Tambah Data SK {{ $data->nama }}
                                </button> --}}
                                
                                {{-- <a href="{{ url('print/' . $data->NIP) }}" class="btn btn-success mb-3" target="_blank" >Generate PDF</a> --}}

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
                                            {{-- <th class="text-center"style="width:auto">Hapus</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($test as $record)
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
                                            {{-- <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" data-action="{{ route('dekan-dosen-details-delete', ['NIP' => $record->NIP]) }}">
                                                    Hapus SK
                                                </button>
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

<!-- Konfiirmasi penghapusan dengan modal -->
<div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus Data SK ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="post" action="">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data-->
<div class="modal fade" id="addSKModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form class="needs-validation" action="{{ route('dekan-dosen-details', ['NIP' => $data ->NIP]) }}" method="POST" enctype="multipart/form-data" novalidate>
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
                                                <h3 class="section-title"></h3>
                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="inputJudul">NIP</label><br>
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
                                                        <label for="inputJudul">Jenis SK </label><br>
                                                        <select class="form-select" aria-label="Default select example" name="jenis_sk">
                                                        <option value="Internal">Internal</option>
                                                        <option value="External">External</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Isi Jumlah SKS.
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputJudul">Keterangan SK</label><br>
                                                        <textarea class="form-control" type="text" name="keterangan_sk" id="keterangan_sk" placeholder="Keterangan" required></textarea>
                                                        <div class="invalid-feedback">
                                                            Keterangan SK
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">

                                                    
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
        </div>
    </div>
</div>

@endsection

<!-- Script  jQuery untuk penghapusan dengan mmodal -->
@push('scripts')
    <script>
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var action = button.data('action');
            var modal = $(this);

            modal.find('#deleteForm').attr('action', action);
        });
        $('#addSKModal').on('show.bs.modal', function (event) {
            var modal = $(this);
            modal.find('form').attr('action', "{{ route('dekan-dosen-details', ['NIP' => $data->NIP]) }}");
        });
    </script>
@endpush

