// js/weather.js
let weatherChart = null;
let weatherData = null;

let currentDataset = "temp"; 
let currentType = "line";        

//user customisation settings 
let uiColour = "#0ea5e9";
let uiFont = "Arial";
let uiFontSize = 12;
let uiLineWidth = 2;
let uiChartHeight = 420;

//loading weather data from local JSON file 
async function loadWeatherData() {
  const res = await fetch("data/weather.json?v=" + Date.now(), { cache: "no-store" });
  if (!res.ok) throw new Error("Failed to load data/weather.json");
  return res.json();
}

//selecting dataset from the loaded JSON
function getDatasetConfig(kind) {
  if (!weatherData) return { label: "", data: [] };
  if (kind === "humidity") return { label: "Humidity (%)", data: weatherData.humidity };
  return { label: "Temperature (°C)", data: weatherData.temperature };
}

//creating chart from chosen dataset 
function buildChart() {
  const canvas = document.getElementById("weatherChart");
  if (!canvas) throw new Error("Canvas #weatherChart not found");

  const ctx = canvas.getContext("2d");
  const ds = getDatasetConfig(currentDataset);

  //colours for graph 
  const TICK = "#f9fafb";
  const GRID = "rgba(249,250,251,0.12)";

  weatherChart = new Chart(ctx, {
    type: currentType,
    data: {
      labels: weatherData.time,
      datasets: [
        {
          label: ds.label,
          data: ds.data,
          borderColor: uiColour,
          backgroundColor: uiColour,
          borderWidth: uiLineWidth,
          tension: 0.3,
          pointRadius: 3
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,

      //animation when first loading 
      animation: {
        duration: 1000,easing: "easeOutQuart"
      },

      plugins: {
        tooltip: {
          enabled: true,
          titleColor: TICK,
          bodyColor: TICK,
          backgroundColor: "rgba(2,6,23,0.95)",
          borderColor: "rgba(148,163,184,0.35)",
          borderWidth: 1
        },
        legend: {
          display: true,
          labels: {
            color: TICK,
            font: { family: uiFont, size: uiFontSize }
          }
        }
      },

      //axis names and styling 
      scales: {
        x: {
          title: {
            display: true,
            text: "Time of Day",
            color: TICK,
            font: { family: uiFont, size: uiFontSize }
          },
          ticks: {
            color: TICK,
            font: { family: uiFont, size: uiFontSize }
          },
          grid: { color: GRID },
          border: { color: TICK }
        },
        y: {

          //humidy starts at 0 
          beginAtZero: currentDataset === "humidity",
          title: {
            display: true,
            text: ds.label,
            color: TICK,
            font: { family: uiFont, size: uiFontSize }
          },
          ticks: {
            color: TICK,
            font: { family: uiFont, size: uiFontSize }
          },
          grid: { color: GRID },
          border: { color: TICK }
        }
      }
    }
  });
}

//recreating the chart 
function rebuildChart() {
  if (weatherChart) weatherChart.destroy();
  buildChart();
}

//dataset and t
function setDataset(kind) {
  currentDataset = kind;
  rebuildChart();
}
window.showTemp = () => setDataset("temp");
window.showHumidity = () => setDataset("humidity");


//user customisation on height 
function setChartHeight(px) {
  const wrapper = document.querySelector(".weather-chart-wrapper");
  if (wrapper) wrapper.style.height = px + "px";
  if (weatherChart) weatherChart.resize();
}

//dropdowns and sliders for chart to customise  
function wireControls() {
  const datasetSelect = document.getElementById("datasetSelect");
  const typeSelect = document.getElementById("typeSelect");
  const colourPick = document.getElementById("colourPick");
  const fontSelect = document.getElementById("fontSelect");
  const fontSize = document.getElementById("fontSize");
  const fontSizeVal = document.getElementById("fontSizeVal");
  const lineWidth = document.getElementById("lineWidth");
  const lineWidthVal = document.getElementById("lineWidthVal");
  const chartHeight = document.getElementById("chartHeight");
  const chartHeightVal = document.getElementById("chartHeightVal");

  if (datasetSelect) {
    datasetSelect.value = currentDataset;
    datasetSelect.addEventListener("change", () => {
      currentDataset = datasetSelect.value;
      rebuildChart();
    });
  }

  if (typeSelect) {
    typeSelect.value = currentType;
    typeSelect.addEventListener("change", () => {
      currentType = typeSelect.value;
      rebuildChart();
    });
  }

  if (colourPick) {
    colourPick.value = uiColour;
    colourPick.addEventListener("input", () => {
      uiColour = colourPick.value;
      if (!weatherChart) return;

      weatherChart.data.datasets[0].borderColor = uiColour;
      weatherChart.data.datasets[0].backgroundColor = uiColour;
      weatherChart.update();
    });
  }

  if (fontSelect) {
    fontSelect.value = uiFont;
    fontSelect.addEventListener("change", () => {
      uiFont = fontSelect.value;
      rebuildChart();
    });
  }

  if (fontSize && fontSizeVal) {
    fontSize.value = String(uiFontSize);
    fontSizeVal.textContent = uiFontSize + "px";
    fontSize.addEventListener("input", () => {
      uiFontSize = parseInt(fontSize.value, 10);
      fontSizeVal.textContent = uiFontSize + "px";
      rebuildChart();
    });
  }

  if (lineWidth && lineWidthVal) {
    lineWidth.value = String(uiLineWidth);
    lineWidthVal.textContent = String(uiLineWidth);
    lineWidth.addEventListener("input", () => {
      uiLineWidth = parseInt(lineWidth.value, 10);
      lineWidthVal.textContent = String(uiLineWidth);
      rebuildChart();
    });
  }

  if (chartHeight && chartHeightVal) {
    chartHeight.value = String(uiChartHeight);
    chartHeightVal.textContent = uiChartHeight + "px";
    setChartHeight(uiChartHeight);
    chartHeight.addEventListener("input", () => {
      uiChartHeight = parseInt(chartHeight.value, 10);
      chartHeightVal.textContent = uiChartHeight + "px";
      setChartHeight(uiChartHeight);
    });
  }
}

//load data and display chart when page loads 
document.addEventListener("DOMContentLoaded", async () => {
  try {
    weatherData = await loadWeatherData();
    buildChart();
    wireControls();
  } catch (err) {
    console.error(err);
  }
});
