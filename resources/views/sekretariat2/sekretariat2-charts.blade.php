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
                                <h4>Graphic SK Dosen</h4>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="col">
                                    <div class="row d-flex justify-content-center">   

                                        <!-- CANVAS AND ID HERE -->
                                        <canvas id="barChart" width="400" height="300"></canvas>
                                        <canvas id="lineChart" width="400" height="300"></canvas>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                    // Fetch data for the bar chart from the server using AJAX
                                                    fetch('/chart/bar-data')
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            var ctxBar = document.getElementById('barChart').getContext('2d');
                                                            var barChart = new Chart(ctxBar, {
                                                                type: 'bar',
                                                                data: {
                                                                    labels: Object.keys(data),
                                                                    datasets: [{
                                                                        label: 'Bar Chart Title',
                                                                        data: Object.values(data),
                                                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                                                        borderColor: 'rgba(75, 192, 192, 1)',
                                                                        borderWidth: 1
                                                                    }]
                                                                },
                                                                options: {
                                                                    responsive: false, // Set to true to allow resizing
                                                                    maintainAspectRatio: false, // Set to false to allow chart to size dynamically
                                                                    scales: {
                                                                        x: {
                                                                            // Adjust x-axis options as needed
                                                                        },
                                                                        y: {
                                                                            // Adjust y-axis options as needed
                                                                        }
                                                                    }
                                                                }
                                                            });
                                                        });

                                                    // Fetch data for the line chart from the server using AJAX
                                                    fetch('/chart/line-data')
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            var ctxLine = document.getElementById('lineChart').getContext('2d');
                                                            var lineChart = new Chart(ctxLine, {
                                                                type: 'line',
                                                                data: {
                                                                    labels: Object.keys(data),
                                                                    datasets: [{
                                                                        label: 'Line Chart Title',
                                                                        data: Object.values(data),
                                                                        fill: false,
                                                                        borderColor: 'rgba(255, 99, 132, 1)',
                                                                        borderWidth: 2
                                                                    }]
                                                                },
                                                                options: {
                                                                    responsive: false, // Set to true to allow resizing
                                                                    maintainAspectRatio: false, // Set to false to allow chart to size dynamically
                                                                    scales: {
                                                                        x: {
                                                                            // Adjust x-axis options as needed
                                                                        },
                                                                        y: {
                                                                            // Adjust y-axis options as needed
                                                                        }
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
