<div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <div id="recruitStatusChart"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    type: 'pie',
                    height: 350
                },
                series: @json($data), // Los datos de la serie (cantidad de reclutas por estado)
                labels: @json($labels), // Las etiquetas (nombres de los estados)
                colors: ['#4b286d', '#66cc00', '#8968a0', '#ad96bd', '#c8b9d3'], // Colores personalizados
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 300
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#recruitStatusChart"), options);
            chart.render();
        });
    </script>
</div>
