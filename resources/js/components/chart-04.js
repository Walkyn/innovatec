import ApexCharts from "apexcharts";

// ===== chartFour
const chart04 = () => {
  // Solo ejecutar si estamos en la página de reportes
  if (!document.getElementById('reports-page')) return;

  // Obtener datos
  const datosCobrosDiarios = JSON.parse(document.getElementById('datosCobrosDiarios').value);
  const diasDelMes = parseInt(document.getElementById('diasDelMes').value);
  
  // Crear array de días del 1 al 30/31
  const dias = Array.from({length: diasDelMes}, (_, i) => (i + 1).toString());

  const chartFourOptions = {
    series: [
      {
        name: 'Total Cobrado',
        data: datosCobrosDiarios
      },
    ],
    colors: ["#3C50E0"],
    chart: {
      fontFamily: "Satoshi, sans-serif",
      type: "bar",
      height: 350,
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "55%",
        endingShape: "rounded",
        borderRadius: 2,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 4,
      colors: ["transparent"],
    },
    xaxis: {
      categories: dias,
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      }
    },
    yaxis: {
      labels: {
        formatter: function (value) {
          return 'S/. ' + value.toFixed(2);
        }
      }
    },
    grid: {
      yaxis: {
        lines: {
          show: false,
        },
      },
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return 'S/. ' + val.toFixed(2);
        },
      },
    },
  };

  const chartFour = document.querySelector("#chartFour");
  if (chartFour) {
    const chart = new ApexCharts(chartFour, chartFourOptions);
    chart.render();
  }
};

export default chart04;
