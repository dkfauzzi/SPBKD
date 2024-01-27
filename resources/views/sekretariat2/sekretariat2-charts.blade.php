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
                                <div class="col">
                                    <h4>Download Report</h4>
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="yearReport" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Pilih Tahun
                                        </button>
                                        <div class="dropdown-menu custom-dropdown" aria-labelledby="yearReport">
                                            @foreach($distinctYears as $year)
                                                <a class="dropdown-item" href="{{ url('print-report/' . $year) }}" target="_blank">Tahun {{ $year }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <h4>Download Excel</h4>
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button" id="yearExcel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Pilih Tahun
                                        </button>
                                        <div class="dropdown-menu custom-dropdown" aria-labelledby="yearExcel">
                                            @foreach($distinctYears as $year)
                                                <a class="dropdown-item" href="{{ url('export-excel/' . $year) }}">Tahun {{ $year }} (Excel)</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="main-content">
            <div class="row">
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
        
        <div class="main-content">
            <div class="row ">
                <div class="col">
                    <div class="card border border-2">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-center">
                            <h6>Grafik Kegiatan SK Per tahun</h6>

                            <div>
                                <label for="yearDropdown">Pilih Tahun:</label>
                                <select id="yearDropdown"></select>
                            </div>
                        
                        <canvas id="prodi_SK_semester" width="400" height="300"></canvas>

                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                // Set the initial selected year to the current year
                                var selectedYear = new Date().getFullYear();
                        
                                // Function to fetch data based on the selected year
                                function fetchData(year) {
                                    fetch('/chart/data-sk-pie-chart/' + year)
                                        .then(response => response.json())
                                        .then(data => {
                                            // Update the chart with the new data
                                            updateChart(data.sk_data);
                                        })
                                        .catch(error => {
                                            console.error('Error fetching data:', error);
                                        });
                                }
                        
                                // Function to update the chart with new data
                                function updateChart(skData) {
                                    var canvasElement = document.getElementById('prodi_SK_semester');
                        
                                    if (!canvasElement) {
                                        console.error('Canvas element not found.');
                                        return;
                                    }
                        
                                    var ctxPieChart = canvasElement.getContext('2d');
                        
                                    // Destroy the existing chart instance to prevent conflicts
                                    if (window.pieChartInstance) {
                                        window.pieChartInstance.destroy();
                                    }
                        
                                    window.pieChartInstance = new Chart(ctxPieChart, {
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
                                                    backgroundColor: function (context) {
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
                                }
                        
                                var yearDropdown = document.getElementById('yearDropdown');
                                var distinctYears = {!! json_encode($distinctYears) !!};
                        
                                distinctYears.forEach(function (year) {
                                    var option = document.createElement('option');
                                    option.value = year;
                                    option.text = year;
                                    yearDropdown.add(option);
                                });
                        
                                // Set the default selected year to the current year
                                yearDropdown.value = selectedYear;
                        
                                // Call fetchData on initial page load with the default selected year
                                fetchData(selectedYear);
                        
                                // Event listener for dropdown change
                                yearDropdown.addEventListener('change', function () {
                                    selectedYear = parseInt(this.value);
                                    fetchData(selectedYear);
                                });
                            });
                        
                            // Function to generate random colors
                            function getRandomColors(count) {
                                var colors = [];
                                for (var i = 0; i < count; i++) {
                                    colors.push('#' + Math.floor(Math.random() * 16777215).toString(16));
                                }
                                return colors;
                            }
                        </script>
                    </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card border border-2">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-center">
                                <h6>Grafik Jenis sk (internal/external) perTahun</h6>
                                <canvas id="kk_SK_semester" width="400" height="300"></canvas>
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

        <div class="main-content">
            <div class="row ">
                <div class="col">
                    <div class="card border border-2">
                        <div class="card-body table-responsive">
                            <div class="row d-flex justify-content-center">
                                <h6>Jumlah SK Per Kuartal</h6>

                                <div>
                                    <label for="pilihTahun">Pilih Tahun:</label>
                                    <select id="pilihTahun"></select>
                                </div>
                            
                                <canvas id="quarterlyLineChart" width="400" height="300"></canvas>

                                <script defer>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        // Fetch distinct years from backend (replace with your actual array)
                                        var distinctYears = {!! json_encode($distinctYears) !!};

                                        // Set the initial selected year to the current year
                                        var selectedYear = new Date().getFullYear();

                                        // Function to fetch data based on the selected year
                                        function fetchData(year) {
                                            fetch('/chart/data-sk-quarterly-line-chart/' + year)
                                                .then(response => response.json())
                                                .then(data => {
                                                    // Update the chart with the new data
                                                    updateChart(data.quarterlyChartData);
                                                })
                                                .catch(error => {
                                                    console.error('Error fetching data:', error);
                                                });
                                        }

                                        // Function to update the chart with new data
                                        function updateChart(quarterlyChartData) {
                                            var years = Object.keys(quarterlyChartData);
                                            var quarterlyCounts = Object.values(quarterlyChartData);

                                            // Sort the years in ascending order
                                            years.sort();

                                            var ctxLineChart = document.getElementById('quarterlyLineChart').getContext('2d');

                                            // Destroy the existing chart instance to prevent conflicts
                                            if (window.lineChartInstance) {
                                                window.lineChartInstance.destroy();
                                            }

                                            window.lineChartInstance = new Chart(ctxLineChart, {
                                                type: 'line',
                                                data: {
                                                    labels: years,
                                                    datasets: [{
                                                        label: 'Jumlah SK Per Kuartal',
                                                        data: quarterlyCounts,
                                                        borderColor: 'rgba(0, 123, 255, 1)',
                                                        borderWidth: 2,
                                                        fill: false
                                                    }]
                                                },
                                                options: {
                                                    responsive: false,
                                                    maintainAspectRatio: false,
                                                    scales: {
                                                        x: {
                                                            type: 'category',
                                                            labels: years,
                                                            beginAtZero: true,
                                                        },
                                                        y: {
                                                            beginAtZero: true,
                                                            stepSize: 3,  // Set the desired step size
                                                            max: Math.max(...quarterlyCounts) + 3, // Adjust the maximum based on data
                                                            ticks: {
                                                                precision: 0
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        }

                                        // Initial fetch with default or selected year
                                        fetchData(selectedYear);

                                        // Populate the dropdown with available years
                                        var pilihTahun = document.getElementById('pilihTahun');
                                        distinctYears.forEach(function (year) {
                                            var option = document.createElement('option');
                                            option.value = year;
                                            option.text = year;
                                            pilihTahun.add(option);
                                        });

                                        // Set the default selected year to the current year
                                        pilihTahun.value = selectedYear;

                                        // Event listener for dropdown change
                                        pilihTahun.addEventListener('change', function () {
                                            selectedYear = parseInt(this.value);
                                            fetchData(selectedYear);
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
                                <h6>Tabel Dosen</h6>
                                <table class="table table-bordered" id="table2">
                                    <thead style="border-color:black">
                                        <tr >
                                            <th class="text-center" style=" width:10px;">No</th>
                                            <th class="text-center" style="width:auto;">Nama</th>
                                            <th class="text-center" style="width:auto;">SK</th>
                                            <th class="text-center" style="width:auto;">SKS</th>
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
                                            <td class="text-center">{{ $countRows }}</td>
                                            {{-- <td class="text-center">{{ $total['total_sks'] }}</td> --}}
                                            <td class="text-center">{{ $total['total_sks'] + $total['total_sks_undangan'] }}</td>
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



@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#yearReport').on('click', function(e) {
            // Prevent the default action of the button
            e.preventDefault();

            // Toggle the dropdown menu
            $(this).toggleClass('show');

            // Get the dropdown menu associated with the button
            var dropdownMenu = $(this).next('.dropdown-menu');

            // Toggle the visibility of the dropdown menu
            dropdownMenu.toggleClass('show');
        });

        $('#yearExcel').on('click', function(e) {
            // Prevent the default action of the button
            e.preventDefault();

            // Toggle the dropdown menu
            $(this).toggleClass('show');

            // Get the dropdown menu associated with the button
            var dropdownMenu = $(this).next('.dropdown-menu');

            // Toggle the visibility of the dropdown menu
            dropdownMenu.toggleClass('show');
        });

        // Close the dropdown when clicking outside of it
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });

        /* Add this script after including jQuery and Bootstrap scripts */
        $(document).ready(function() {
            $('.dropdown').on('shown.bs.dropdown', function () {
                $(this).css('z-index', 100000);
            });
        });
    });
</script>
    
@endpush
