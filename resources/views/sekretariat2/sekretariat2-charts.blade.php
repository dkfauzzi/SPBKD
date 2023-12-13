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
                            <div class="card-header">
                                <h4>Download Report</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    @foreach($distinctYears as $year)
                                        <a href="{{ url('print-report/' . $year) }}" class="btn btn-success mb-3" target="_blank">Tahun '{{ $year }}'</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="main-content">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Grafik DATA SK</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    <div class="row d-flex justify-content-center">   
                                        <!-- CANVAS AND ID HERE -->
                                        {{-- <canvas id="lineChart" width="400" height="300"></canvas> --}}
                                        <canvas id="prodi_SK" width="300" height="300"></canvas>
                                        <canvas id="kk_SK" width="300" height="300"></canvas>
                                        <canvas id="dosen_SK" width="300" height="300"></canvas>


                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                // Fetch data for all charts from the server using AJAX
                                                fetch('/chart/data-sk')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                       
                                                        // Use the data to create the 'prodi' chart
                                                        var ctxProdi = document.getElementById('prodi_SK').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.prodi_SK),
                                                                datasets: [{
                                                                    label: 'SK Tiap Kelompok Keahlian',
                                                                    data: Object.values(data.prodi_SK),
                                                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                                    borderColor: 'rgba(255, 99, 132, 1)',
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });

                                                        // Use the data to create the 'prodi' chart
                                                        var ctxProdi = document.getElementById('kk_SK').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.kk_SK),
                                                                datasets: [{
                                                                    label: 'SK Tiap Kelompok Keahlian',
                                                                    data: Object.values(data.kk_SK),
                                                                    backgroundColor: 'rgba(0, 128, 0, 0.2)',
                                                                    borderColor: 'rgba(0, 128, 0, 1)',
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });

                                                         // Use the data to create the 'bar' chart
                                                         var ctxBar = document.getElementById('dosen_SK').getContext('2d');
                                                        var barChart = new Chart(ctxBar, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.dosen_SK),
                                                                datasets: [{
                                                                    label: 'SK Tiap Dosen',
                                                                    data: Object.values(data.dosen_SK),
                                                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });







                                                    });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>



        <div class="main-content">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Grafik DATA SKS</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    <div class="row d-flex justify-content-center">   
                                        <!-- CANVAS AND ID HERE -->
                                        <canvas id="prodi_SKS" width="400" height="300"></canvas>
                                        <canvas id="kk_SKS" width="400" height="300"></canvas>
                                        <canvas id="dosen_SKS" width="400" height="300"></canvas>


                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                // Fetch data for all charts from the server using AJAX
                                                fetch('/chart/data-sks')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        // Use the data to create the 'prodi' chart
                                                        var ctxProdi = document.getElementById('prodi_SKS').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.prodi_sks),
                                                                datasets: [{
                                                                    label: 'SKS Tiap Prodi',
                                                                    data: Object.values(data.prodi_sks),
                                                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                                                    borderColor: 'rgba(255, 99, 132, 1)',
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });

                                                        // Use the data to create the 'prodi' chart
                                                        var ctxProdi = document.getElementById('kk_SKS').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.kk_sks),
                                                                datasets: [{
                                                                    label: 'SKS Tiap Kelompok Keahlian',
                                                                    data: Object.values(data.kk_sks),
                                                                    backgroundColor: 'rgba(0, 128, 0, 0.2)',
                                                                    borderColor: 'rgba(0, 128, 0, 1)',
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });


                                                        // Use the data to create the 'prodi' chart
                                                        var ctxProdi = document.getElementById('dosen_SKS').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.dosen_sks),
                                                                datasets: [{
                                                                    label: 'SKS Tiap Dosen',
                                                                    data: Object.values(data.dosen_sks),
                                                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                                    borderColor: 'rgba(75, 192, 192, 1)',
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });





                                                    });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Grafik DATA SK Per Semester</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    <div class="row d-flex justify-content-center">   
                                        <!-- CANVAS AND ID HERE -->
                                        {{-- <canvas id="lineChart" width="400" height="300"></canvas> --}}
                                        <canvas id="prodi_SK_semester" width="400" height="300"></canvas>
                                        <canvas id="kk_SK_semester" width="400" height="300"></canvas>
                                        {{-- <canvas id="dosen_SK_semester" width="300" height="300"></canvas> --}}

                                        <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            // Fetch data for all charts from the server using AJAX
                                            fetch('/chart/data-sk-prodi-semester')
                                                .then(response => response.json())
                                                .then(data => {
                                                    // Use the data to create the 'prodi' chart
                                                    var ctxProdi = document.getElementById('prodi_SK_semester').getContext('2d');
                                                    var prodiChart = new Chart(ctxProdi, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: Object.keys(data.prodi_SK['Semester 1']), // Use 'Semester 1' or 'Semester 2' as needed
                                                            datasets: [{
                                                                label: 'SKProdi Semester 1', // Change label accordingly
                                                                data: Object.values(data.prodi_SK['Semester 1']),
                                                                backgroundColor: 'rgba(0, 0, 255, 0.2)', // Blue background color
                                                                    borderColor: 'rgba(0, 0, 255, 1)', // Blue border color
                                                                borderWidth: 1
                                                            },
                                                            {
                                                                label: 'SK Prodi Semester 2', // Change label accordingly
                                                                data: Object.values(data.prodi_SK['Semester 2']),
                                                                backgroundColor: 'rgba(255, 0, 0, 0.2)', // Red background color
                                                                    borderColor: 'rgba(255, 0, 0, 1)', // Red border color
                                                                borderWidth: 1
                                                            }]
                                                        },
                                                        options: {
                                                            responsive: false,
                                                            maintainAspectRatio: false,
                                                            scales: {
                                                                x: {},
                                                                y: {}
                                                            }
                                                        }
                                                    });

                                                })
                                                .catch(error => {
                                                    console.error('Error fetching data:', error);
                                                });
                                        });
                                        </script>
                                         <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                // Fetch data for all charts from the server using AJAX
                                                fetch('/chart/data-sk-kk-semester')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        // Use the data to create the 'prodi' chart
                                                        var ctxProdi = document.getElementById('kk_SK_semester').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.kk_SK['Semester 1']), // Use 'Semester 1' or 'Semester 2' as needed
                                                                datasets: [{
                                                                    label: 'SK Kelompok Kehalian Semester 1', // Change label accordingly
                                                                    data: Object.values(data.kk_SK['Semester 1']),
                                                                    backgroundColor: 'rgba(0, 0, 255, 0.2)', // Blue background color
                                                                    borderColor: 'rgba(0, 0, 255, 1)', // Blue border color
                                                                    borderWidth: 1
                                                                },
                                                                {
                                                                    label: 'SK Kelompok Kehalian Semester 2', // Change label accordingly
                                                                    data: Object.values(data.kk_SK['Semester 2']),
                                                                    backgroundColor: 'rgba(255, 0, 0, 0.2)', // Red background color
                                                                    borderColor: 'rgba(255, 0, 0, 1)', // Red border color
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });
    
                                                    })
                                                    .catch(error => {
                                                        console.error('Error fetching data:', error);
                                                    });
                                            });
                                            </script>
                                        
                                              
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Grafik DATA SKS Per Semester</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    <div class="row d-flex justify-content-center">   
                                        <!-- CANVAS AND ID HERE -->
                                        {{-- <canvas id="lineChart" width="400" height="300"></canvas> --}}
                                        <canvas id="prodi_SKS_semester" width="700" height="300"></canvas>
                                        <canvas id="kk_SKS_semester" width="400" height="300"></canvas>
                                        {{-- <canvas id="dosen_SK_semester" width="300" height="300"></canvas> --}}

                                        <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            // Fetch data for all charts from the server using AJAX
                                            fetch('/chart/data-sks-Prodi-semester')
                                                .then(response => response.json())
                                                .then(data => {
                                                    // Use the data to create the 'prodi' chart
                                                    var ctxProdi = document.getElementById('prodi_SKS_semester').getContext('2d');
                                                    var prodiChart = new Chart(ctxProdi, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: Object.keys(data.prodi_SK['Semester 1']), // Use 'Semester 1' or 'Semester 2' as needed
                                                            datasets: [{
                                                                label: 'SKS Prodi Semester 1', // Change label accordingly
                                                                data: Object.values(data.prodi_SK['Semester 1']),
                                                                backgroundColor: 'rgba(0, 0, 255, 0.2)', // Blue background color
                                                                    borderColor: 'rgba(0, 0, 255, 1)', // Blue border color
                                                                borderWidth: 1
                                                            },
                                                            {
                                                                label: 'SKS Prodi Semester 2', // Change label accordingly
                                                                data: Object.values(data.prodi_SK['Semester 2']),
                                                                backgroundColor: 'rgba(255, 0, 0, 0.2)', // Red background color
                                                                    borderColor: 'rgba(255, 0, 0, 1)', // Red border color
                                                                borderWidth: 1
                                                            }]
                                                        },
                                                        options: {
                                                            responsive: false,
                                                            maintainAspectRatio: false,
                                                            scales: {
                                                                x: {},
                                                                y: {}
                                                            },
                                                        }
                                                    });

                                                })
                                                .catch(error => {
                                                    console.error('Error fetching data:', error);
                                                });
                                        });
                                        </script>
                                         <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                // Fetch data for all charts from the server using AJAX
                                                fetch('/chart/data-sks-kk-semester')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        // Use the data to create the 'prodi' chart
                                                        var ctxProdi = document.getElementById('kk_SKS_semester').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.kk_SK['Semester 1']), // Use 'Semester 1' or 'Semester 2' as needed
                                                                datasets: [{
                                                                    label: 'SKS Kelompok Kehalian Semester 1', // Change label accordingly
                                                                    data: Object.values(data.kk_SK['Semester 1']),
                                                                    backgroundColor: 'rgba(0, 0, 255, 0.2)', // Blue background color
                                                                    borderColor: 'rgba(0, 0, 255, 1)', // Blue border color
                                                                    borderWidth: 1
                                                                },
                                                                {
                                                                    label: 'SKS Kelompok Kehalian Semester 2', // Change label accordingly
                                                                    data: Object.values(data.kk_SK['Semester 2']),
                                                                    backgroundColor: 'rgba(255, 0, 0, 0.2)', // Red background color
                                                                    borderColor: 'rgba(255, 0, 0, 1)', // Red border color
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                scales: {
                                                                    x: {},
                                                                    y: {}
                                                                }
                                                            }
                                                        });
    
                                                    })
                                                    .catch(error => {
                                                        console.error('Error fetching data:', error);
                                                    });
                                            });
                                            </script>
                                        
                                              
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



@endsection
