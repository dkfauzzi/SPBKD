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
                                                    
                                                    @for ($i = 1; $i <= $numberOfSets; $i++)

                                                    <div class="form-group col-md-6" data-index="{{ $i }}">
                                                        <label for="inputJudul">NIP</label><br>
                                                        <select class="form-select nip-dropdown" name="sets[{{ $i }}][NIP]"  id="nip_dropdown{{ $i }}" required>
                                                            <option value="" selected disabled>Select NIP</option>
                                                            @foreach($nipOptions as $nip)
                                                                <option>{{ $nip }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6" >
                                                        <label for="nama">Nama Dosen</label>
                                                        <input class="form-control" type="text" name="sets[{{ $i }}][nama]" id="nama_field{{ $i }}" readonly>
                                                        <div class="invalid-feedback">Isi Nama Dosen</div>
                                                    </div>

                                                    <div class="form-group col-md-6" data-index="{{ $i }}"> 
                                                        <label for="inputJudul">NIP</label><br>
                                                        <select class="form-select  nip-dropdown" name="sets[{{ $i }}][NIP]" id="nip_dropdown{{ $i }}"  required>
                                                            <option value="" selected disabled>Select NIP</option>
                                                            @foreach($nipOptions as $nip)
                                                                <option>{{ $nip }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="nama">Nama Dosen</label>
                                                        <input class="form-control" type="text" name="sets[{{ $i }}][nama]" id="nama_field{{ $i }}"  readonly>
                                                        <div class="invalid-feedback">Isi Nama Dosen</div>
                                                    </div>

                                                    <div class="form-group col-md-6" data-index="{{ $i }}">
                                                        <label for="inputJudul">NIP</label><br>
                                                        <select class="form-select nip-dropdown" name="sets[{{ $i }}][NIP]" id="nip_dropdown{{ $i }}" required>
                                                            <option value="" selected disabled>Select NIP</option>
                                                            @foreach($nipOptions as $nip)
                                                                <option>{{ $nip }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="nama">Nama Dosen</label>
                                                        <input class="form-control" type="text" name="sets[{{ $i }}][nama]" id="nama_field{{ $i }}" readonly>
                                                        <div class="invalid-feedback">Isi Nama Dosen</div>
                                                    </div>
                                                    
                                                    @endfor
                
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
                </div>
            </div>
        </div>

    </div>

</div>





@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Fetch NIP options on document ready
        fetchNIPOptions();

        // Function to fetch NIP options and populate the dropdown
        function fetchNIPOptions() {
            var nipSelect = $('.nip-dropdown');
            nipSelect.empty(); // Clear existing options

            // Make an AJAX request to fetch NIP options
            $.ajax({
                url: "{{ route('get.nip.options') }}",
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Populate the dropdowns with fetched NIP options
                    nipSelect.each(function () {
                        var currentSelect = $(this);
                        currentSelect.append('<option value="" selected disabled>Select NIP</option>');
                        $.each(response.nipOptions, function(index, value) {
                            currentSelect.append('<option value="' + value + '">' + value + '</option>');
                        });
                    });
                },
                error: function(error) {
                    console.error('Error fetching NIP options:', error);
                }
            });
        }

        // Add change event listener to dynamically update Nama Dosen for each set
        $('.nip-dropdown').on('change', function () {
            var selectedNIP = $(this).val();
            var currentIndex = $(this).closest('.form-group').data('index');
            var namaDosenInput = $('#nama_field' + currentIndex);

            // Make an AJAX request to fetch the corresponding nama based on NIP
            $.ajax({
                url: "{{ route('get.nama.by.nip', ['NIP' => '']) }}/" + selectedNIP,
                method: 'POST',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { NIP: selectedNIP },
                success: function(response) {
                    // Update the nama input for the current set
                    namaDosenInput.val(response.nama);
                },
                error: function(error) {
                    console.error('Error fetching Nama Dosen:', error);
                }
            });
        });
    });
</script>

@endpush










