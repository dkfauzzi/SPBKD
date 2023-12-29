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
                                <form class="needs-validation" action="{{ route('sekretariat2-store-undangan') }}" method="POST" enctype="multipart/form-data" novalidate>

                                    {{ csrf_field() }}
                                    <div class="card-header row">
                                        <h3 class="section-title col-8">Undangan / Rekognisi</h3>
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
                                                        <select class="form-select nip-field" id="nip_0" name="NIP[]">
                                                            <option value="">Pilih NIP</option>
                                                            @foreach ($nipOptions as $nipOption)
                                                                <option value="{{ $nipOption->NIP }}">{{ $nipOption->NIP }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6 nama-container" id="namaField">
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

                                                    {{-- <div class="form-group col-md-6">
                                                        <label for="inputJudul">Kegiatan SK Dosen</label><br>
                                                        <textarea class="form-control" type="text" name="sk[]" placeholder="Jenis SK" required></textarea>
                                                        <div class="invalid-feedback">Isi Kegiatan SK.</div>
                                                    </div> --}}

                                                    <div class="form-group col-md-6">
                                                        <label for="inputJudul">Kegiatan SK</label><br>
                                                        <select class="form-select" aria-label="Default select example" name="sk[]">
                                                            <option value="Membimbing Unit Kegiatan Mahasiswa">Membimbing Unit Kegiatan Mahasiswa</option>
                                                            <option value="Pembimbing Kelompok Kompetisi Mahasiswa">Pembimbing Kelompok Kompetisi Mahasiswa</option>
                                                            <option value="Pimpinan Organisasi Sosial di lingkungan Telkom University sebagai Ketua/Wakil Ketua">Pimpinan Organisasi Sosial di lingkungan Telkom University sebagai Ketua/Wakil Ketua</option>
                                                            <option value="Jabatan Non Struktural Internal">Jabatan Non Struktural Internal</option>
                                                            <option value="Jabatan Non Struktural Ekxternal">Jabatan Non Struktural Ekxternal</option>
                                                            <option value="Pelaksanaan Tugas Penunjang Almamater">Pelaksanaan Tugas Penunjang Almamater</option>
                                                            <option value="Kegiatan MBKM">Kegiatan MBKM</option>
                                                            <option value="Mengikuti Pelatihan yang linear dengan Disiplin Ilmu">Mengikuti Pelatihan yang linear dengan Disiplin Ilmu</option>
                                                            <option value="Lainya">Lainya</option>
                                                        </select>
                                                    </div>
{{-- 
                                                    <div class="form-group col-md-6">
                                                        <label for="inputJudul">Jumlah SKS</label><br>
                                                        <input class="form-control" type="text" name="sks[]" placeholder="Jumlah SKS" required>
                                                        <div class="invalid-feedback">Isi Jumlah SKS.</div>
                                                    </div> --}}

                                                    <div class="form-group col-md-6">
                                                        <label for="inputJUdul">Jumlah SKS</label>

                                                        <div class="form-row">
                                                            <button class="btn btn-primary fas fa-minus " type="button" onclick="decrement()"></button>
                                                            <input class="form-control" style="width: 10%" type="text" name="sks[]" id="value" value="0" >
                                                            <button class="btn btn-secondary fas fa-plus" type="button" onclick="increment()"></button>
                                                        </div>
                                                        

                                                        {{-- <label for="incrementedValue">Incremented/Decremented Value:</label>
                                                        <input type="number" name="incrementedValue" id="incrementedValue" value="0" readonly>

                                                        <button type="button" onclick="incrementValue()">Increment</button>
                                                        <button type="button" onclick="decrementValue()">Decrement</button> --}}

                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputJudul">Jenis SK</label><br>
                                                        <select class="form-select" aria-label="Default select example" name="jenis_sk[]">
                                                            <option value="Internal">Internal</option>
                                                            <option value="External">External</option>
                                                        </select>
                                                        <div class="invalid-feedback">Isi Jenis SK.</div>
                                                    </div>
                                                    {{-- <div class="form-group col-md-6">
                                                        <label for="inputJudul">Keterangan SK</label><br>
                                                        <textarea class="form-control" type="text" name="keterangan_sk[]" placeholder="Keterangan" required></textarea>
                                                        <div class="invalid-feedback">Keterangan SK</div>
                                                    </div> --}}
                                                </div>
                                
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="start_date">Tanggal Mulai SK</label><br>
                                                        <input class="form-control" type="date" name="start_date[]" placeholder="Tanggal Mulai" required>
                                                        <div class="invalid-feedback">Isi Tanggal Mulai SK.</div>
                                                    </div>
                                                
                                                    {{-- <div class="form-group col-md-6">
                                                        <label for="inputJudul">Tanggal Berakhir SK</label><br>
                                                        <input class="form-control" type="date" name="end_date[]" placeholder="Tanggal Berakhir" required>
                                                        <div class="invalid-feedback">Isi Tanggal Berakhir SK.</div>
                                                    </div> --}}
                                                    
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
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

<!-- ... (your existing HTML code) ... -->

@push('scripts')
<script>
    $(document).ready(function () {
        // Counter for unique field names
        let counter = 1;

        $('#addFieldsBtn').click(function () {
            // Clone the NIP and Nama fields
            let newNIPField = $('#nipField').clone(true, true);
            let newNamaField = $('#namaField').clone(true, true);

            // Update attributes to make them unique
            newNIPField.find('select').attr({
                'id': 'nip_' + counter,
                'name': 'NIP[]',  // Ensure NIP is treated as an array
                'readonly': false
            });

            newNamaField.find('input').attr({
                'id': 'nama_' + counter,
                'name': 'nama[]', // Ensure nama is treated as an array
                'readonly': true
            });

            // Create a new row and append both cloned fields to it
            let newRow = $('<div class="form-row"></div>').append(
                $('<div class="form-group col-md-6"></div>').append(newNIPField.html())
            ).append(
                $('<div class="form-group col-md-6"></div>').append(newNamaField.html())
            );

            // Insert the new row above the "Add More Fields" button within the specific form-row with class 'button'
            $('.form-row.button').before(newRow);

            // Inside the click event handler
            console.log('Counter:', counter);
            console.log('NIP ID:', 'nip_' + counter);
            console.log('Nama ID:', 'nama_' + counter);

            // Increment the counter for the next set of fields
            counter++;
        });

        // Additional logic for populating Nama based on selected NIP
        $(document).on('change', 'select[id^="nip_"]', function () {
            // Get the selected NIP
            let selectedNIP = $(this).val();

            // Find the index of the current row
            let rowIndex = $(this).closest('.form-row').index();

            // Select the corresponding Nama input based on the row index
            let namaInput = $('input[name^="nama[]"]').eq(rowIndex);

            // Make an AJAX request to get the corresponding nama
            $.ajax({
                url: '{{ url('/getNama') }}/' + selectedNIP,
                type: 'GET',
                success: function (response) {
                    // Update the nama field with the fetched nama
                    namaInput.val(response.nama);
                },
                error: function () {
                    // Handle errors if needed
                }
            });
        });

        // Increment button logic
        $(document).on('click', 'button.increment', function () {
            let inputField = $(this).siblings('input');
            inputField.val(parseFloat(inputField.val()) + 1);
        });

        // Decrement button logic
        $(document).on('click', 'button.decrement', function () {
            let inputField = $(this).siblings('input');
            if (parseFloat(inputField.val()) > 0) {
                inputField.val(parseFloat(inputField.val()) - 1);
            }
        });

        $(document).on('click','button.increment',function(){
            let inputField = $(this).siblings('input');

        });
        function incrementValue() {
        let incrementedValueInput = document.getElementById('incrementedValue');
        incrementedValueInput.value = parseInt(incrementedValueInput.value) + 1;
        }

        function decrementValue() {
            let incrementedValueInput = document.getElementById('incrementedValue');
            if (parseInt(incrementedValueInput.value) > 0) {
                incrementedValueInput.value = parseInt(incrementedValueInput.value) - 1;
            }
        }
    // });

</script>
@endpush
