import ApexCharts from "apexcharts";

// ===== chartThree
const chart03 = () => {
  // Solo ejecutar si estamos en la página de reportes
  if (!document.getElementById('reports-page')) return;

  const chartThreeOptions = {
    series: [
      parseFloat(document.getElementById('pagoEfectivo').value),
      parseFloat(document.getElementById('pagoDeposito').value),
      parseFloat(document.getElementById('totalEmitido').value),
      parseFloat(document.getElementById('totalAnulado').value)
    ],
    chart: {
      type: "donut",
      width: 380,
    },
    colors: ["#3C50E0", "#80CAEE", "#00E396", "#FF4560"],
    labels: ["Pagos Efectivo", "Pagos Depósito", "Total Emitido", "Total Anulado"],
    legend: {
      show: false,
      position: "bottom",
    },

    plotOptions: {
      pie: {
        donut: {
          size: "65%",
          background: "transparent",
        },
      },
    },

    dataLabels: {
      enabled: false,
    },
    responsive: [
      {
        breakpoint: 640,
        options: {
          chart: {
            width: 200,
          },
        },
      },
    ],
  };

  const chartThree = document.querySelector("#chartThree");
  if (chartThree) {
    const chartInstance = new ApexCharts(chartThree, chartThreeOptions);
    chartInstance.render();
  }
};

export default chart03;
