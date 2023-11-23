@extends('layouts.layout-sekretariat2')

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
                        <div class="card">
                            <div class="card-header">
                                <h4>Profile Dosen</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-1 " >
                                        <img class="rounded-circle img-fluid" src="assets_index/assets/img/about/1.jpg" alt="..."  style="width: 80%"/>
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
                                <a href="{{ route('sekretariat2-search') }}" class="btn btn-success"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data SK {{ $data->nama }}</h4>
                            </div>
                            <div class="card-body table-responsive">
                                {{-- <a href=<?php echo url('sekretariat2-tambah-sk') ?> class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Tambah Data</a> --}}

                                <a href="{{ route('sekretariat2-tambah-sk', ['NIP' => $data->NIP]) }}" class="btn btn-success mb-3"> <i class="fas fa-plus"></i> Tambah Data SK</a>
                                <a href="{{ url('print/' . $data->NIP) }}" class="btn btn-success mb-3" target="_blank" >Generate PDF</a>

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
                                            <th class="text-center"style="width:auto">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($test as $record)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td class="text-center">{{ $record->sks }}</td>
                                            <td class="text-center">{{ $record->sk }}</td>
                                            <td class="text-center">{{ $record->jenis_sk }}</td>
                                            <td class="text-center">{{ $record->keterangan_sk }}</td>
                                            <td class="text-center">{{ $record->start_date ? Carbon\Carbon::parse($record->start_date)->translatedFormat('d F Y', 'id') : '' }}</td>
                                            <td class="text-center">{{ $record->end_date ? Carbon\Carbon::parse($record->end_date)->translatedFormat('d F Y', 'id') : ''}}</td>
                                            <td class="text-center">{{ $record->start_sk }}</td>
                                            <td class="text-center">{{ $record->end_sk}}</td>
                                            <td>
                                                {{-- <form action="{{ route('sekretariat2-dosen-details-delete', ['NIP' => $record->NIP]) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Hapus SK</button>
                                                </form> --}}
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" data-action="{{ route('sekretariat2-dosen-details-delete', ['NIP' => $record->NIP]) }}">
                                                    Hapus SK
                                                </button>
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

<!-- Script  jQuery untuk penghapusan dengan mmodal -->
<script>
    $('#confirmDeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var action = button.data('action');
        var modal = $(this);

        modal.find('#deleteForm').attr('action', action);
    });
</script>
@endsection
