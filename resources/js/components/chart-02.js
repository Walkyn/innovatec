import ApexCharts from "apexcharts";

// ===== chartTwo
const chart02 = () => {
  const chartTwoOptions = {
    series: [
      {
        name: "Clientes Cobrados",
        data: window.datosGrafico?.total_clientes || [0, 0, 0, 0, 0, 0, 0],
      },
      {
        name: "Monto Total (S/.)",
        data: window.datosGrafico?.montos || [0, 0, 0, 0, 0, 0, 0],
      },
    ],
    colors: ["#3056D3", "#80CAEE"],
    chart: {
      type: "bar",
      height: 335,
      stacked: true,
      toolbar: {
        show: false,
      },
      zoom: {
        enabled: false,
      },
    },

    responsive: [
      {
        breakpoint: 1536,
        options: {
          plotOptions: {
            bar: {
              borderRadius: 0,
              columnWidth: "25%",
            },
          },
        },
      },
    ],
    plotOptions: {
      bar: {
        horizontal: false,
        borderRadius: 0,
        columnWidth: "25%",
        borderRadiusApplication: "end",
        borderRadiusWhenStacked: "last",
      },
    },
    dataLabels: {
      enabled: true,
      formatter: function (val, opts) {
        const seriesName = opts.w.config.series[opts.seriesIndex].name;
        if (seriesName === "Clientes Cobrados") {
          return val + " cli.";
        }
        return '';
      },
    },
    tooltip: {
      shared: true,
      intersect: false,
      y: {
        formatter: function (val, { seriesIndex, dataPointIndex, w }) {
          if (seriesIndex === 0) {
            return val + " clientes";
          }
          return "S/. " + val;
        }
      }
    },
    xaxis: {
      categories: window.datosGrafico?.fechas || ["Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
    },
    legend: {
      position: "top",
      horizontalAlign: "left",
      fontFamily: "Satoshi",
      fontWeight: 500,
      fontSize: "14px",

      markers: {
        radius: 99,
      },
    },
    fill: {
      opacity: 1,
    },
  };

  const chartSelector = document.querySelectorAll("#chartTwo");

  if (chartSelector.length) {
    const chartTwo = new ApexCharts(
      document.querySelector("#chartTwo"),
      chartTwoOptions
    );
    chartTwo.render();
  }
};

export default chart02;
