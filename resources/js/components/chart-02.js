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
      
      console.log('Datos recibidos:', data); // Para debug
      
      let categories = [];
      let seriesData = [];
      let clientesData = [];

      // Manejar diferentes formatos según el período
      if (periodo === 'semana_actual' || periodo === 'semana_anterior') {
        // Para datos semanales
        const fechasConDatos = data.datos.map(item => {
          const [year, month, day] = item.fecha.split('-');
          const fecha = new Date(year, month - 1, day);
          const dias = ['dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb'];
          return {
            label: dias[fecha.getDay()],
            total: parseFloat(item.total),
            clientes: parseInt(item.clientes)
          };
        });

        categories = fechasConDatos.map(item => item.label);
        seriesData = fechasConDatos.map(item => item.total);
        clientesData = fechasConDatos.map(item => item.clientes);
      } 
      else if (periodo === 'mes_actual') {
        // Para datos mensuales
        if (Array.isArray(data.datos)) {
          categories = data.datos.map(item => item.nombre); // Usamos el nombre del mes
          seriesData = data.datos.map(item => parseFloat(item.total) || 0);
          clientesData = data.datos.map(item => parseInt(item.clientes) || 0);
        } else {
          console.error('Formato de datos incorrecto para mes_actual:', data);
          return;
        }
      }
      else if (periodo === 'todos_años') {
        // Para datos anuales
        categories = data.labels;
        seriesData = data.datos.map(item => parseFloat(item.total) || 0);
        clientesData = data.datos.map(item => parseInt(item.clientes) || 0);
      }

      console.log('Categories:', categories); // Para debug
      console.log('Series Data:', seriesData); // Para debug
      console.log('Clientes Data:', clientesData); // Para debug

      const options = {
        series: [
          {
            name: "Total Cobrado",
            type: 'column',
            data: seriesData
          },
          {
            name: "Clientes Cobrados",
            type: 'line',
            data: clientesData
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
          categories: categories,
          type: 'category',
          labels: {
            style: {
              fontSize: '12px',
              textTransform: 'capitalize'
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
        chart.destroy();
      }
      chart = new ApexCharts(document.querySelector("#chartTwo"), options);
      chart.render();
      
    } catch (error) {
      console.error('Error al actualizar el gráfico:', error);
      console.log('Estado de los datos cuando ocurrió el error:', data); // Para debug
    }
  };

  periodSelect.addEventListener('change', (e) => {
    actualizarGrafico(e.target.value);
  });
  
  // Inicializar con el período seleccionado
  actualizarGrafico(periodSelect.value);
};

export default chart02;
