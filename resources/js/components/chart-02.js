import ApexCharts from "apexcharts";

// ===== chartTwo
const chart02 = () => {
  if (!document.getElementById('reports-page')) return;

  const periodSelect = document.getElementById('periodSelect');
  const rutaObtenerDatos = document.getElementById('rutaObtenerDatos')?.value;

  if (!periodSelect || !rutaObtenerDatos) return;

  let chart = null;

  const actualizarGrafico = async (periodo) => {
    try {
      const response = await fetch(`${rutaObtenerDatos}?periodo=${periodo}`);
      const data = await response.json();

      const options = {
        series: [
          {
            name: "Total Cobrado",
            type: 'column',
            data: data.series[0].data
          },
          {
            name: "Clientes Cobrados",
            type: 'line',
            data: data.series[1].data
          }
        ],
        chart: {
          height: 350,
          type: 'line',
          toolbar: {
            show: false,
          }
        },
        colors: ['#3C50E0', '#80CAEE'],
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "55%",
            borderRadius: 2,
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          width: [0, 4],
          curve: 'smooth'
        },
        xaxis: {
          categories: data.labels,
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
          labels: {
            style: {
              fontSize: '12px'
            }
          }
        },
        yaxis: [
          {
            title: {
              text: ""
            },
            labels: {
              formatter: function(val) {
                return 'S/. ' + val.toFixed(2);
              }
            }
          },
          {
            opposite: true,
            title: {
              text: ""
            },
            labels: {
              formatter: function(val) {
                return Math.round(val);
              }
            }
          }
        ],
        tooltip: {
          y: {
            formatter: function(val, { seriesIndex }) {
              if (seriesIndex === 0) {
                return 'S/. ' + val.toFixed(2);
              }
              return val + ' clientes';
            }
          }
        },
        legend: {
          show: true,
          position: 'bottom',
          markers: {
            width: 8,
            height: 8,
            radius: 100
          }
        }
      };

      if (chart) {
        chart.updateOptions(options);
      } else {
        chart = new ApexCharts(document.querySelector("#chartTwo"), options);
        chart.render();
      }
    } catch (error) {
      console.error('Error al actualizar el gráfico:', error);
    }
  };

  periodSelect.addEventListener('change', (e) => {
    actualizarGrafico(e.target.value);
  });
  
  // Inicializar con el período seleccionado
  actualizarGrafico(periodSelect.value);
};

export default chart02;
