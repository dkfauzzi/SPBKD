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
                        <div class="card border border-2">
                            <div class="card-body table-responsive">
                                <form class="needs-validation" action="{{ route('tambah') }}" method="POST" enctype="multipart/form-data" novalidate>

                                    {{ csrf_field() }}
                                    <div class="card-header row">
                                        <h3 class="section-title col-8">Tambah SK Dosen</h3>
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
                                                <div class="form-row">
                                                    <div class="form-group col-md-6" id="nipField">
                                                        <label for="NIP">NIP</label><br>
                                                        <input class="form-control nip-field" type="text" name="NIP[]" readonly>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6" id="namaField">
                                                        <label for="nama">Nama Dosen</label>
                                                        <input class="form-control nama-field" type="text" name="nama[]" readonly>
                                                        <div class="invalid-feedback">Isi Nama Dosen</div>
                                                    </div>
                                                </div>
                                        
                                                <div class="form-row button">
                                                    <div class="form-group col-md-6">
                                                        <button type="button" class="btn btn-outline-secondary" id="addFieldsBtn">Tambah Dosen</button>
                                                    </div>
                                                </div>

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
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            // Counter for unique field names
            let counter = 1;

            // Handle button click event
            $('#addFieldsBtn').click(function () {
                // Clone the NIP and Nama fields
                let newNIPField = $('#nipField').clone(true, true);
                let newNamaField = $('#namaField').clone(true, true);

                // Update attributes to make them unique
                newNIPField.find('input').attr({
                    'id': 'nip_' + counter,
                    'name': 'NIP[]',  // Use an array for multiple NIP fields
                    'readonly': false  // Allow editing in the cloned fields
                });

                newNamaField.find('input').attr({
                    'id': 'nama_' + counter,
                    'name': 'nama[]',  // Use an array for multiple nama fields
                    'readonly': false  // Allow editing in the cloned fields
                });

                // Create a new row and append both cloned fields to it
                let newRow = $('<div class="form-row"></div>').append(
                    $('<div class="form-group col-md-6"></div>').append(newNIPField.html())
                ).append(
                    $('<div class="form-group col-md-6"></div>').append(newNamaField.html())
                );

                // Insert the new row above the "Add More Fields" button within the specific form-row with class 'button'
                $('.form-row.button').before(newRow);

                // Increment the counter for the next set of fields
                counter++;
            });
        });
    </script>
@endpush    
