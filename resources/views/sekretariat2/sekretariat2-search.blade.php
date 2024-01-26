@extends('layouts.layout-sekretariat2')

@section('content')

<div id="app">
    <div class="main-wrapper main-wrapper-1">

        @include('navbar')

        @include('sidebar.sidebar')

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
                                <a href=<?php echo url('sekretariat2-tambah-sk') ?>
                                    class="btn btn-success">
                                    <i class="fas fa-plus"></i> Tambah Data SK
                                </a>
                                <a href=<?php echo url('sekretariat2-tambah-undangan') ?>
                                    class="btn btn-success">
                                    <i class="fas fa-plus"></i> Undangan / Rekognisi
                                </a>
                                <table class="table table-bordered" id="table1">
                                    <thead style="border-color:black">
                                        <tr >
                                            <th class="text-center" style=" width:10px;">No</th>
                                            <th class="text-center" style="width:auto;">Nama</th>
                                            <th class="text-center"style="width:auto; ">NIP</th>
                                            <th class="text-center"style="width:180px">Kelompok Keahlian</th>
                                            <th class="text-center"style="width:180px">Prodi</th>
                                            <th class="text-center"style="width:auto">JAD</th>
                                            <th class="text-center" style="width:auto;">SK</th>
                                            <th class="text-center" style="width:auto;">SKS</th>
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
                                            <td class="text-center">{{ $countRows }}</td>
                                            <td class="text-center">{{ $total['total_sks'] + $total['total_sks_undangan'] }}</td>



                                            <td class="text-center">
                                                {{ link_to(route('sekretariat2-dosen-details', ['NIP' => $total['NIP']]), '', ['class' => ' fa fa-eye btn btn-success', 'style'=>'font-size: 20px;']) }}

                                                {{ link_to(route('sekretariat2-dosen-edit', ['NIP' => $total['NIP']]), '', ['class' => 'fa fa-pencil btn btn-warning', 'style'=>'font-size: 20px;']) }}

                                                {{-- <form data-action="{{ route('sekretariat2-search-delete', ['NIP' => $total['NIP']]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="fa fa-trash btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" style="font-size: 20px;"></button>
                                                </form> --}}

                                                <button type="button" class="fa fa-trash btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" data-action="{{ route('sekretariat2-search-delete', ['NIP' => $total['NIP']]) }}" style="font-size: 20px;" >
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
                                <h3 class="header-nav">Data Sekretariat</h3>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="table1">
                                    <thead style="border-color:black">
                                        <tr >
                                            <th class="text-center" style=" width:10px;">No</th>
                                            <th class="text-center" style="width:auto;">Nama</th>
                                            <th class="text-center"style="width:auto; ">NIP</th>
                                            {{-- <th class="text-center"style="width:180px">Kelompok Keahlian</th>
                                            <th class="text-center"style="width:180px">Prodi</th>
                                            <th class="text-center"style="width:auto">JAD</th>
                                            <th class="text-center" style="width:auto;">SK</th>
                                            <th class="text-center" style="width:auto;">SKS</th> --}}
                                            <th class="text-center" style="width:auto">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0?>
                                        @foreach ($sekretariat as $total)
                                        {{-- @php
                                            // Check if the current NIP exists in $countNIPRows
                                            $countRows = isset($countNIPRows[$total['NIP']]) ? $countNIPRows[$total['NIP']] : 0;
                                        @endphp --}}
                                        <tr>   
                                            <td class="text-center">{{1+$no++}}</td>
                                            <td class="text-center">{{ $total->nama }}</td>
                                            <td class="text-center">{{ $total->NIP }}</td>
                                            {{-- <td class="text-center">{{ $total['KK'] }}</td>
                                            <td class="text-center">{{ $total['Prodi'] }}</td>
                                            <td class="text-center">{{ $total['JAD'] }}</td>
                                            <td class="text-center">{{ $countRows }}</td>
                                            <td class="text-center">{{ $total['total_sks'] + $total['total_sks_undangan'] }}</td> --}}



                                            <td class="text-center">
                                                {{ link_to(route('sekretariat2-dosen-details', ['NIP' => $total['NIP']]), '', ['class' => ' fa fa-eye btn btn-success', 'style'=>'font-size: 20px;']) }}

                                                {{ link_to(route('sekretariat2-dosen-edit', ['NIP' => $total['NIP']]), '', ['class' => 'fa fa-pencil btn btn-warning', 'style'=>'font-size: 20px;']) }}

                                                {{-- <form data-action="{{ route('sekretariat2-search-delete', ['NIP' => $total['NIP']]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="fa fa-trash btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" style="font-size: 20px;"></button>
                                                </form> --}}

                                                <button type="button" class="fa fa-trash btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal" data-action="{{ route('sekretariat2-search-delete', ['NIP' => $total['NIP']]) }}" style="font-size: 20px;" >
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


<!-- Modal Tambah Data-->
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
                Apakah Anda yakin ingin menghapus Data ini?
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
@endsection


@push('scripts')
    <script>
          $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var action = button.data('action');
            var modal = $(this);

            modal.find('#deleteForm').attr('action', action);
        });
    </script>
@endpush








