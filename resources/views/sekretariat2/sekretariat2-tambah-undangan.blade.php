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

                                                <div class="form-row ">


                                                    <div class="form-group col-md-6">
                                                        <label>Kegiatan SK</label>
                                                        <input class="form-control nama-field" type="text" name="sk[]"  value="Menerima Undangan / Rekognisi" readonly>

                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputJudul">Jenis SK</label><br>
                                                        <select class="form-select" aria-label="Default select example" name="jenis_sk[]">
                                                            <option value="Internal">Internal</option>
                                                            <option value="External">External</option>
                                                        </select>
                                                        <div class="invalid-feedback">Isi Jenis SK.</div>
                                                    </div>
                                                </div>

                                                <div class="form-row justify-content-start col-md-6" >
                                                    <label for="inputJUdul">Jumlah SKS</label>
                                                    
                                                    <div class="d-flex flex-column align-items-center">
                                                        <button class="btn-primary btn-sm mb-2 fas fa-plus" type="button" onclick="increment()" id="incrementBtn" style="max-width: 50px;"></button>
                                                        <input class="form-control mb-2 text-center"  type="text" name="sks[]" id="value" value="0" style="max-width: 80px;" >
                                                        <button class="btn-primary mb-2 btn-sm fas fa-minus" type="button" onclick="decrement()" id="decrementBtn" style="max-width: 50px;"></button>
                                                    </div>

                                                </div>
                                
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="start_date">Tanggal Pelaksanaan</label><br>
                                                        <input class="form-control" type="date" name="start_date[]" placeholder="Tanggal Mulai" required>
                                                        <div class="invalid-feedback">Isi Tanggal Mulai SK.</div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        {!! Form::submit('Simpan',['class'=>'btn btn-success mb-5 mt-3'])!!}
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

        // // Custom addition and rounding function
        function addAndRound(value, increment) {
            return Math.round((value + increment) * 100) / 100;
        }

        // Increment button logic
        window.increment = function () {
            let inputField = $(this).siblings('input');
            let newValue = addAndRound(parseFloat(inputField.val()), 0.05);
            inputField.val(newValue.toFixed(3));
        }

        // Decrement button logic
        window.decrement = function () {
            let inputField = $(this).siblings('input');
            let newValue = addAndRound(parseFloat(inputField.val()), -0.05);
            if (newValue >= 0) {
                inputField.val(newValue.toFixed(3));
            }
        }

        // Bind the functions to the onclick events using jQuery
        $(document).on('click', '#decrementBtn', window.decrement);
        $(document).on('click', '#incrementBtn', window.increment);


            // // Custom addition and rounding function for integers
            // function addAndRoundInteger(value, increment) {
            //     return Math.round(value + increment);
            // }

            // // Custom addition and rounding function for decimals
            // function addAndRoundDecimal(value, increment) {
            //     return Math.round((value + increment) * 1000) / 1000;
            // }

            // // Increment button logic for integers
            // window.incrementInteger = function () {
            //     let inputField = $(this).siblings('input');
            //     let newValue = addAndRoundInteger(parseFloat(inputField.val()), 1);
            //     inputField.val(newValue);
            // }

            // // Decrement button logic for integers
            // window.decrementInteger = function () {
            //     let inputField = $(this).siblings('input');
            //     let newValue = addAndRoundInteger(parseFloat(inputField.val()), -1);
            //     if (newValue >= 0) {
            //         inputField.val(newValue);
            //     }
            // }

            // // Increment button logic for decimals
            // window.incrementDecimal = function () {
            //     let inputField = $(this).siblings('input');
            //     let newValue = addAndRoundDecimal(parseFloat(inputField.val()), 0.025);
            //     inputField.val(newValue.toFixed(3)); // Displaying three decimal places
            // }

            // // Decrement button logic for decimals
            // window.decrementDecimal = function () {
            //     let inputField = $(this).siblings('input');
            //     let newValue = addAndRoundDecimal(parseFloat(inputField.val()), -0.025);
            //     if (newValue >= 0) {
            //         inputField.val(newValue.toFixed(3)); // Displaying three decimal places
            //     }
            // }

            // // Bind the functions to the onclick events using jQuery
            // $(document).on('click', '#integerIncrementBtn', window.incrementInteger);
            // $(document).on('click', '#integerDecrementBtn', window.decrementInteger);
            // $(document).on('click', '#decimalIncrementBtn', window.incrementDecimal);
            // $(document).on('click', '#decimalDecrementBtn', window.decrementDecimal);

        });

</script>
@endpush
