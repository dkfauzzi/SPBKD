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
                                                {{ link_to(route('sekretariat2-dosen-details', ['NIP' => $total['NIP']]), '', ['class' => ' fa fa-eye btn btn-success', 'style'=>'font-size: 20px;']) }}

                                                {{ link_to(route('sekretariat2-dosen-edit', ['NIP' => $total['NIP']]), '', ['class' => 'fa fa-pencil btn btn-warning', 'style'=>'font-size: 20px;']) }}

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
{{-- <div class="modal fade" id="addSKModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form class="needs-validation" action="{{ route('sekretariat2-search') }}" method="POST" enctype="multipart/form-data" novalidate>
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
                        <div class="form-group">
                            <div class="form-col">
                                <h3 class="section-title"></h3>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputJudul">NIP</label><br>
                                        <select class="form-select nipSelect" name="NIP" required>
                                            <option value="" selected disabled>Select NIP</option>
                                            @foreach($nipOptions as $nip)
                                                <option value="{{ $nip }}">{{ $nip }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nama_dosen">Nama Dosen</label>
                                        <input class="form-control" type="text" name="nama" readonly>
                                        <div class="invalid-feedback">Isi Nama Dosen</div>
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
                                        {!! Form::submit('Simpan',['class'=>'btn btn-primary mb-5 mt-3'])!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@endsection


{{-- @push('scripts')
    <script>
        $('#addSKModal').on('show.bs.modal', function (event) {
            var modal = $(this);
            var form = modal.find('form');
            form.attr('action', "{{ route('sekretariat2-search') }}");

            // Assuming you have a button or some mechanism to dynamically add sets
            $('#addSetButton').on('click', function () {
                // Clone the template set and append it to the form
                var templateSet = $('#templateSet').clone();
                templateSet.removeAttr('id');
                form.append(templateSet);
            });

            // Fetch NIP options on modal show
            function fetchNIPOptions() {
    var form = $('#addSKModal form');
    var nipSelect = form.find('.nipSelect');
    nipSelect.empty(); // Clear existing options

    // Make an AJAX request to fetch NIP options
    $.ajax({
        url: "{{ route('get.nip.options') }}",
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Populate the dropdown with fetched NIP options
            $.each(response.nipOptions, function(index, value) {
                nipSelect.append('<option value="' + value + '">' + value + '</option>');
            });
        },
        error: function(error) {
            console.error('Error fetching NIP options:', error);
        }
    });
}

            // Add change event listener to dynamically update Nama Dosen
            form.on('change', '.nipSelect', function () {
                var selectedNIP = $(this).val();
                var namaDosenInput = $(this).closest('.form-col').find('.form-group input[name="nama_dosen"]');

                // Make an AJAX request to fetch the corresponding nama based on NIP
                $.ajax({
                    url: "{{ route('get.nama.by.nip') }}", // Update this route to your actual route
                    method: 'POST',
                    data: { nip: selectedNIP },
                    success: function(response) {
                        // Update the nama_dosen input
                        namaDosenInput.val(response.nama);
                    },
                    error: function(error) {
                        console.error('Error fetching Nama Dosen:', error);
                    }
                });
            });

            // Function to fetch NIP options and populate the dropdown
            function fetchNIPOptions() {
                var nipSelect = form.find('.nipSelect');
                nipSelect.empty(); // Clear existing options

                // Make an AJAX request to fetch NIP options
                $.ajax({
                    url: "{{ route('get.nip.options') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Populate the dropdown with fetched NIP options
                        $.each(response.nipOptions, function(index, value) {
                            nipSelect.append('<option value="' + value + '">' + value + '</option>');
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching NIP options:', error);
                    }
                });
            }
        });
    </script>
@endpush


 --}}





