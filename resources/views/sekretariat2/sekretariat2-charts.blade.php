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
            <div class="row">
                {{-- <div class="col">
                    <div class="card border border-2">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-start" style="margin-left: 20px;">
                                <h6>Grafik SK Program Studi</h6>

                                <canvas id="prodi_SK1" width="300" height="300"></canvas>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Fetch data for all charts from the server using AJAX
                                        fetch('/chart/data-sk')
                                            .then(response => response.json())
                                            .then(data => {
                                            
                                                // Use the data to create the 'prodi' chart
                                                var ctxProdi = document.getElementById('prodi_SK1').getContext('2d');
                                                var prodiChart = new Chart(ctxProdi, {
                                                    type: 'bar',
                                                    data: {
                                                        labels: Object.keys(data.prodi_SK),
                                                        datasets: [{
                                                            label: 'SK Tiap ProgramStudi',
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
                                            });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border border-2">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-center">
                                <h6>Grafik SK Kelompok Keahlian</h6>

                                <canvas id="kk_SK" width="300" height="300"></canvas>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Fetch data for all charts from the server using AJAX
                                        fetch('/chart/data-sk')
                                            .then(response => response.json())
                                            .then(data => {

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
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="col">
                    <div class="card border border-2 justify-content-center ">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-center" style="margin-left: px;">
                                <h6>Grafik SK Dosen</h6>

                                <canvas id="dosen_SK" width="300" height="300"></canvas>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Fetch data for all charts from the server using AJAX
                                        fetch('/chart/data-sk')
                                            .then(response => response.json())
                                            .then(data => {
                                                

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

                <div class="col ">
                    <div class="card border border-2">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-center" style="margin-left: px;">
                                <h6>Grafik SKS Dosen</h6>

                                <canvas id="dosen_SKS" width="400" height="300"></canvas>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Fetch data for all charts from the server using AJAX
                                        fetch('/chart/data-sks')
                                            .then(response => response.json())
                                            .then(data => {
                                                

                                            var ctxProdi = document.getElementById('dosen_SKS').getContext('2d');
                                            var prodiChart = new Chart(ctxProdi, {
                                                type: 'bar',
                                                data: {
                                                    labels: Object.keys(data.dosen_sks),
                                                    datasets: [{
                                                        label: 'SKS Tiap Dosen',
                                                        data: Object.values(data.dosen_sks),
                                                        backgroundColor: 'rgba(255, 0, 0, 0.2)', 
                                                            borderColor: 'rgba(255, 0, 0, 1)',
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
        


        {{-- <div class="main-content">
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
                                        <canvas id="prodi_SKS" width="400" height="300"></canvas>
                                        <canvas id="kk_SKS" width="400" height="300"></canvas>
                                        <canvas id="dosen_SKS" width="400" height="300"></canvas>


                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                fetch('/chart/data-sks')
                                                    .then(response => response.json())
                                                    .then(data => {
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
        </div> --}}


        <div class="main-content">
            <div class="row ">
                {{-- <div class="col">
                    <div class="card border border-2">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-start" style="margin-left: 20px;">
                                <h6>Grafik SKS Program Studi</h6>

                                <canvas id="prodi_SKS" width="400" height="300"></canvas>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        fetch('/chart/data-sks')
                                        .then(response => response.json())
                                        .then(data => {
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
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border border-2">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-center">
                                <h6>Grafik SKS Kelompok Keahlian</h6>

                                <canvas id="kk_SKS" width="400" height="300"></canvas>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Fetch data for all charts from the server using AJAX
                                        fetch('/chart/data-sks')
                                            .then(response => response.json())
                                            .then(data => {

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
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="col ">
                    <div class="card border border-2">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-start" style="margin-left: px;">
                                <h6>Grafik SKS Dosen</h6>

                                <canvas id="dosen_SKS" width="400" height="300"></canvas>
                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        // Fetch data for all charts from the server using AJAX
                                        fetch('/chart/data-sks')
                                            .then(response => response.json())
                                            .then(data => {
                                                

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
                </div> --}}
            </div>
        </div>
    

        <div class="main-content">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card border border-2">
                            <div class="card-header">
                                <h4>Grafik Data Jenis SK </h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    <div class="row d-flex justify-content-center">   
                                     
                                        <canvas id="prodi_SK_semester" width="400" height="300"></canvas>
                                        <canvas id="kk_SK_semester" width="400" height="300"></canvas>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                fetch('/chart/data-sk-pie-chart')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        var canvasElement = document.getElementById('prodi_SK_semester');
                                        
                                                        if (!canvasElement) {
                                                            console.error('Canvas element not found.');
                                                            return;
                                                        }
                                        
                                                        var ctxPieChart = canvasElement.getContext('2d');
                                                        var skData = data.sk_data;
                                        
                                                        var pieChart = new Chart(ctxPieChart, {
                                                            type: 'pie',
                                                            data: {
                                                                labels: Object.keys(skData),
                                                                datasets: [{
                                                                    data: Object.values(skData),
                                                                    backgroundColor: getRandomColors(Object.keys(skData).length),
                                                                    borderWidth: 1
                                                                }]
                                                            },
                                                            options: {
                                                                responsive: false,
                                                                maintainAspectRatio: false,
                                                                plugins: {
                                                                    datalabels: {
                                                                        color: 'white',
                                                                        backgroundColor: function(context) {
                                                                            return context.dataset.backgroundColor;
                                                                        },
                                                                        borderRadius: 5,
                                                                        padding: {
                                                                            top: 5,
                                                                            bottom: 5
                                                                        },
                                                                        formatter: (value, context) => {
                                                                            var dataset = context.chart.data.datasets[context.datasetIndex];
                                                                            var total = dataset.data.reduce((acc, data) => acc + data, 0);
                                                                            var percentage = ((value / total) * 100).toFixed(2);
                                                                            return percentage + '%';
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        });
                                        
                                                    })
                                                    .catch(error => {
                                                        console.error('Error fetching data:', error);
                                                    });
                                            });
                                        
                                            // Function to generate random colors
                                            function getRandomColors(count) {
                                                var colors = [];
                                                for (var i = 0; i < count; i++) {
                                                    colors.push('#' + Math.floor(Math.random()*16777215).toString(16));
                                                }
                                                return colors;
                                            }
                                        </script>
                                        
                                        
                                        
                                        
                                        
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function () {
                                                fetch('/chart/data-sk-kk-semester')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        var canvasElement = document.getElementById('kk_SK_semester');
                                        
                                                        if (!canvasElement) {
                                                            console.error('Canvas element not found.');
                                                            return;
                                                        }
                                        
                                                        var ctxProdi = canvasElement.getContext('2d');
                                                        var datasets = [];
                                        
                                                        // Check if kk_SK is defined in data.chartData
                                                        if (data.kk_SK) {
                                                            // Loop through each jenis_SK dynamically
                                                            for (var jenisSK in data.kk_SK) {
                                                                var yearData = data.kk_SK[jenisSK];
                                        
                                                                datasets.push({
                                                                    label: 'SK ' + jenisSK,
                                                                    data: Object.values(yearData),
                                                                    backgroundColor: getRandomColor(),
                                                                    borderColor: getRandomColor(),
                                                                    borderWidth: 1
                                                                });
                                                            }
                                        
                                                            var prodiChart = new Chart(ctxProdi, {
                                                                type: 'bar',
                                                                data: {
                                                                    labels: Object.keys(data.kk_SK[Object.keys(data.kk_SK)[0]]), // Use either "Internal" or "External" as a reference
                                                                    datasets: datasets,
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
                                                        } else {
                                                            console.error('Missing or undefined kk_SK in data.chartData.');
                                                        }
                                        
                                                    })
                                                    .catch(error => {
                                                        console.error('Error fetching data:', error);
                                                    });
                                            });
                                        
                                            // Function to generate random colors
                                            function getRandomColor() {
                                                var letters = '0123456789ABCDEF';
                                                var color = '#';
                                                for (var i = 0; i < 6; i++) {
                                                    color += letters[Math.floor(Math.random() * 16)];
                                                }
                                                return color;
                                            }
                                        </script>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="main-content">
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
                                        <canvas id="prodi_SKS_semester" width="700" height="300"></canvas>
                                        <canvas id="kk_SKS_semester" width="400" height="300"></canvas>

                                        <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            fetch('/chart/data-sks-Prodi-semester')
                                                .then(response => response.json())
                                                .then(data => {
                                                    var ctxProdi = document.getElementById('prodi_SKS_semester').getContext('2d');
                                                    var prodiChart = new Chart(ctxProdi, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: Object.keys(data.prodi_SK['Semester 1']), 
                                                            datasets: [{
                                                                label: 'SKS Prodi Semester 1', 
                                                                data: Object.values(data.prodi_SK['Semester 1']),
                                                                backgroundColor: 'rgba(0, 0, 255, 0.2)', 
                                                                    borderColor: 'rgba(0, 0, 255, 1)', 
                                                                borderWidth: 1
                                                            },
                                                            {
                                                                label: 'SKS Prodi Semester 2', 
                                                                data: Object.values(data.prodi_SK['Semester 2']),
                                                                backgroundColor: 'rgba(255, 0, 0, 0.2)', 
                                                                    borderColor: 'rgba(255, 0, 0, 1)', 
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
                                                fetch('/chart/data-sks-kk-semester')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        var ctxProdi = document.getElementById('kk_SKS_semester').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.kk_SK['Semester 1']), 
                                                                datasets: [{
                                                                    label: 'SKS Kelompok Kehalian Semester 1', 
                                                                    data: Object.values(data.kk_SK['Semester 1']),
                                                                    backgroundColor: 'rgba(0, 0, 255, 0.2)', 
                                                                    borderColor: 'rgba(0, 0, 255, 1)', 
                                                                    borderWidth: 1
                                                                },
                                                                {
                                                                    label: 'SKS Kelompok Kehalian Semester 2', 
                                                                    data: Object.values(data.kk_SK['Semester 2']),
                                                                    backgroundColor: 'rgba(255, 0, 0, 0.2)', 
                                                                    borderColor: 'rgba(255, 0, 0, 1)',
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
        </div> --}}
    </div>
</div>



@endsection
