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
                                <h4>Grafik DATA SK</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    <div class="row d-flex justify-content-center">   

                                        <!-- CANVAS AND ID HERE -->
                                        <canvas id="barChart" width="400" height="300"></canvas>
                                        <canvas id="lineChart" width="400" height="300"></canvas>
                                        <canvas id="prodiChart" width="400" height="300"></canvas>
                                        <canvas id="prodiSKS" width="400" height="300"></canvas>
                                        <canvas id="kkChart" width="400" height="300"></canvas>
                                        <canvas id="kkSKSChart" width="400" height="300"></canvas>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                // Fetch data for all charts from the server using AJAX
                                                fetch('/chart/data-sk')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        // Use the data to create the 'bar' chart
                                                        var ctxBar = document.getElementById('barChart').getContext('2d');
                                                        var barChart = new Chart(ctxBar, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.bar),
                                                                datasets: [{
                                                                    label: 'Bar Chart Title',
                                                                    data: Object.values(data.bar),
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

                                                        // Use the data to create the 'line' chart
                                                        var ctxLine = document.getElementById('lineChart').getContext('2d');
                                                        var lineChart = new Chart(ctxLine, {
                                                            type: 'line',
                                                            data: {
                                                                labels: Object.keys(data.line),
                                                                datasets: [{
                                                                    label: 'Line Chart Title',
                                                                    data: Object.values(data.line),
                                                                    fill: false,
                                                                    borderColor: 'rgba(255, 99, 132, 1)',
                                                                    borderWidth: 2
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
                                                        var ctxProdi = document.getElementById('prodiChart').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.prodi),
                                                                datasets: [{
                                                                    label: 'Prodi Chart Title',
                                                                    data: Object.values(data.prodi),
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
                                                        var ctxProdi = document.getElementById('kkChart').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.kk),
                                                                datasets: [{
                                                                    label: 'SK KK',
                                                                    data: Object.values(data.kk),
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
                                                         var ctxProdi = document.getElementById('kkSKSChart').getContext('2d');
                                                        var prodiChart = new Chart(ctxProdi, {
                                                            type: 'bar',
                                                            data: {
                                                                labels: Object.keys(data.kk_sks),
                                                                datasets: [{
                                                                    label: 'SKS KK',
                                                                    data: Object.values(data.kk_sks),
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
                        <div class="card">
                            <div class="card-header">
                                <h4>Grafik DATA SKS</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    <div class="row d-flex justify-content-center">   

                                        <!-- CANVAS AND ID HERE -->
                                        <canvas id="barChart" width="400" height="300"></canvas>
                                        <canvas id="lineChart" width="400" height="300"></canvas>
                                        <canvas id="prodiChart" width="400" height="300"></canvas>
                                        <canvas id="prodiSKS" width="400" height="300"></canvas>
                                        <canvas id="kkChart" width="400" height="300"></canvas>
                                        <canvas id="kkSKSChart" width="400" height="300"></canvas>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                // Fetch data for all charts from the server using AJAX
                                                fetch('/chart/data-sks')
                                                    .then(response => response.json())
                                                    .then(data => {
                                                
                                                        // Use the data to create the 'prodi' chart
                                                    var ctxProdi = document.getElementById('prodiSKS').getContext('2d');
                                                    var prodiChart = new Chart(ctxProdi, {
                                                        type: 'bar',
                                                        data: {
                                                            labels: Object.keys(data.total_sks),
                                                            datasets: [{
                                                                label: 'SKS Prodi',
                                                                data: Object.values(data.total_sks),
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
