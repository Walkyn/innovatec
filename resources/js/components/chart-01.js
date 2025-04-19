import ApexCharts from "apexcharts";

// ===== chartOne
const chart01 = () => {
  // Configuración base del gráfico
  const chartOneOptions = {
    series: [
      {
        name: "Clientes Cobrados",
        data: [],
      },
      {
        name: "Total Cobros",
        data: [],
      },
    ],
    legend: {
      show: false,
      position: "top",
      horizontalAlign: "left",
    },
    colors: ["#3C50E0", "#80CAEE"],
    chart: {
      fontFamily: "Satoshi, sans-serif",
      height: 335,
      type: "area",
      dropShadow: {
        enabled: true,
        color: "#623CEA14",
        top: 10,
        blur: 4,
        left: 0,
        opacity: 0.1,
      },
      toolbar: {
        show: false,
      },
    },
    responsive: [
      {
        breakpoint: 1024,
        options: {
          chart: {
            height: 300,
          },
        },
      },
      {
        breakpoint: 1366,
        options: {
          chart: {
            height: 350,
          },
        },
      },
    ],
    stroke: {
      width: [2, 2],
      curve: "smooth",
    },
    markers: {
      size: 4,
      colors: "#fff",
      strokeColors: ["#3C50E0", "#80CAEE"],
      strokeWidth: 3,
      strokeOpacity: 0.9,
      strokeDashArray: 0,
      fillOpacity: 1,
      discrete: [],
      hover: {
        size: undefined,
        sizeOffset: 5,
      },
    },
    grid: {
      xaxis: {
        lines: {
          show: true,
        },
      },
      yaxis: {
        lines: {
          show: true,
        },
      },
    },
    dataLabels: {
      enabled: false,
    },
    xaxis: {
      type: "category",
      categories: [],
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        rotate: 0,
        style: {
          fontSize: '12px',
          fontFamily: 'Satoshi, sans-serif',
        },
        trim: false,
      }
    },
    yaxis: [{
      title: {
        text: "",
      },
      min: 0,
      forceNiceScale: true
    }, {
      opposite: true,
      title: {
        text: "",
      },
      min: 0,
      forceNiceScale: true,
      labels: {
        formatter: function(value) {
          return 'S/. ' + value.toFixed(2);
        }
      }
    }],
    tooltip: {
      shared: true,
      intersect: false,
      y: {
        formatter: function (y, { seriesIndex }) {
          if (seriesIndex === 0) {
            return y + " clientes";
          }
          return "S/. " + y.toFixed(2);
        }
      }
    }
  };

  let chart = null;

  // Función para cargar y actualizar datos
  async function actualizarDatos(periodo = 'dia') {
    try {
      const response = await fetch(`/obtener-datos-periodo?periodo=${periodo}`);
      const data = await response.json();

      // Actualizar contadores superiores
      document.querySelector('.clientes-cobrados').textContent = `${data.clientesCobrados} clientes`;
      document.querySelector('.total-cobrado').textContent = `S/. ${data.totalCobrado}`;

      // Actualizar datos del gráfico
      chart.updateOptions({
        xaxis: {
          categories: data.grafico.fechas
        }
      });

      chart.updateSeries([
        {
          name: "Clientes Cobrados",
          data: data.grafico.clientes
        },
        {
          name: "Total Cobros",
          data: data.grafico.cobros
        }
      ]);
    } catch (error) {
      console.error('Error al cargar datos:', error);
    }
  }

  // Inicializar gráfico y eventos
  const chartSelector = document.querySelector("#chartOne");
  if (chartSelector) {
    // Crear instancia del gráfico
    chart = new ApexCharts(chartSelector, chartOneOptions);
    chart.render();

    // Configurar eventos de los botones
    document.querySelectorAll('.periodo-btn').forEach(button => {
      button.addEventListener('click', function() {
        // Actualizar clases de los botones
        document.querySelectorAll('.periodo-btn').forEach(btn => {
          btn.classList.remove('bg-white', 'shadow-card', 'dark:bg-boxdark');
        });
        this.classList.add('bg-white', 'shadow-card', 'dark:bg-boxdark');
        
        // Cargar datos del período seleccionado
        actualizarDatos(this.getAttribute('data-periodo'));
      });
    });

    // Cargar datos iniciales
    actualizarDatos('dia');
  }
};

export default chart01;
