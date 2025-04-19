import ApexCharts from "apexcharts";

const chart05 = () => {
    if (!document.getElementById('reports-page')) return;

    const datosGrafico = JSON.parse(document.getElementById('datosGrafico').value);
    const usuarioSelect = document.getElementById('usuarioSelect');
    let chart = null;

    const actualizarGrafico = (usuarioId) => {
        const options = {
            series: [{
                name: 'Total Cobrado',
                data: datosGrafico.datos[usuarioId]
            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                }
            },
            colors: ['#3C50E0'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: datosGrafico.meses,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    formatter: function(val) {
                        return 'S/. ' + val.toFixed(2);
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return 'S/. ' + val.toFixed(2);
                    }
                }
            },
            grid: {
                strokeDashArray: 4
            }
        };

        if (chart) {
            chart.updateOptions(options);
        } else {
            chart = new ApexCharts(document.querySelector("#chartFive"), options);
            chart.render();
        }
    };

    if (usuarioSelect) {
        usuarioSelect.addEventListener('change', (e) => {
            actualizarGrafico(e.target.value);
        });
        
        // Inicializar con el primer usuario
        actualizarGrafico(usuarioSelect.value);
    }
};

export default chart05; 