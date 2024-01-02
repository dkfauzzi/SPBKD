<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initial selected year
        var selectedYear = 2024; // Replace with your default or selected year

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
        }

        // Initial fetch with default or selected year
        fetchData(selectedYear);

        // Populate the dropdown with available years
        var yearDropdown = document.getElementById('yearDropdown');
        var currentYear = new Date().getFullYear();
        for (var year = currentYear; year >= currentYear - 5; year--) {
            var option = document.createElement('option');
            option.value = year;
            option.text = year;
            yearDropdown.add(option);
        }

        // Event listener for dropdown change
        yearDropdown.addEventListener('change', function() {
            selectedYear = parseInt(this.value);
            fetchData(selectedYear);
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