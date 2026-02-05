//js/addweather.js
let chart;

//forecasts as JSON to convert into JS objects
const stokeForecast = JSON.parse(forecast_stoke);
const londonForecast = JSON.parse(forecast_london);

//labels for the chart's X-axis, forecast and time 
const labels = stokeForecast.list.map(item => item.dt_txt);

//stores the values in arrays to edit in browser 
let stokeTemp = stokeForecast.list.map(item => item.main.temp);
let londonTemp = londonForecast.list.map(item => item.main.temp);
let stokeHum  = stokeForecast.list.map(item => item.main.humidity);
let londonHum = londonForecast.list.map(item => item.main.humidity);

//display 
let currentCity = "both";
let currentMetric = "temp";  

//returning correct data from the chosen city or measurement 
function getSeries(city, metric) {
  if (metric === "temp") return city === "stoke" ? stokeTemp : londonTemp;
  return city === "stoke" ? stokeHum : londonHum;
}

//building dataset 
function buildDatasets() {
  const colour = document.getElementById("colourPicker").value;
  const datasets = [];
  if (currentCity === "stoke" || currentCity === "both") {
    datasets.push({
      label: currentMetric === "temp" ? "Temperature for Stoke (°C)" : "Humidity for Stoke (%)",
      data: getSeries("stoke", currentMetric),
      borderColor: colour,
      backgroundColor: colour,
      tension: 0.3,
      pointRadius: 3
    });
  }
  if (currentCity === "london" || currentCity === "both") {
    datasets.push({
      label: currentMetric === "temp" ? "Temperature for London (°C)" : "Humidity for London (%)",
      data: getSeries("london", currentMetric),
      borderColor: "#3b82f6",
      backgroundColor: "#3b82f6",
      tension: 0.3,
      pointRadius: 3
    });
  }
  return datasets;

}


//using chart.js for axis settings
function buildScalesConfig() {
  const xTitle = "Date (YYYY-MM-DD) and Time (24h)";
  const yTitle = currentMetric === "temp" ? "Temperature (°C)" : "Humidity (%)";
  const isV2 = (window.Chart && typeof Chart.version === "string" && Chart.version.startsWith("2."));
  if (isV2) {
    return {
      xAxes: [{
        scaleLabel: { display: true, labelString: xTitle, fontColor: "#f9fafb" },
        ticks: { fontColor: "#f9fafb", maxRotation: 60, minRotation: 45 },
        gridLines: { color: "rgba(249,250,251,0.12)", drawBorder: true, zeroLineColor: "#f9fafb" }
      }],
      yAxes: [{
        scaleLabel: { display: true, labelString: yTitle, fontColor: "#f9fafb" },
        ticks: { fontColor: "#f9fafb", beginAtZero: (currentMetric === "humidity") },
        gridLines: { color: "rgba(249,250,251,0.12)", drawBorder: true, zeroLineColor: "#f9fafb" }
      }]
    };
  }
  return {
    x: {
      title: { display: true, text: xTitle, color: "#f9fafb", font: { size: 12 } },
      ticks: { color: "#f9fafb", maxRotation: 60, minRotation: 45 },
      grid: { color: "rgba(249,250,251,0.12)" },
      border: { display: true, color: "#f9fafb" }
    },
    y: {
      beginAtZero: currentMetric === "humidity",
      title: { display: true, text: yTitle, color: "#f9fafb", font: { size: 12 } },
      ticks: { color: "#f9fafb" },
      grid: { color: "rgba(249,250,251,0.12)" },
      border: { display: true, color: "#f9fafb" }
    }
  };
}

//creating chart 
function createChart() {
  const canvas = document.getElementById("forecastChart");
  if (!canvas) return;
  chart = new Chart(canvas.getContext("2d"), {
    type: "line",
    data: { labels, datasets: buildDatasets() },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        tooltip: { enabled: true },
        legend: { display: true, labels: { color: "#f9fafb" } }
      },
      scales: buildScalesConfig()
    }
  });
}

//recreating chart based on options 
function refreshChart() {
  if (!chart) return;
  chart.data.datasets = buildDatasets();
  chart.options.scales = buildScalesConfig();
  chart.update();
}

//user changing chart heigh 
function setChartHeight() {
  const h = document.getElementById("chartSize").value;
  document.getElementById("chartWrapper").style.height = h + "px";
  if (chart) chart.resize();
}

//dropdown menu filled with forecast times  
function populateTimeDropdown() {
  const sel = document.getElementById("timeSelect");
  if (!sel) return;
  sel.innerHTML = "";
  labels.forEach((t, i) => {
    const opt = document.createElement("option");
    opt.value = String(i);
    opt.textContent = t;
    sel.appendChild(opt);
  });
}


//loading the saved edits 
async function applyOverrides() {
  try {
    const res = await fetch("data/forecast_overrides.json", { cache: "no-store" });
    if (!res.ok) return;
    const overrides = await res.json();
    if (!overrides || typeof overrides !== "object") return;
    for (const city of ["stoke", "london"]) {
      for (const metric of ["temp", "humidity"]) {
        const byIdx = overrides?.[city]?.[metric];
        if (!byIdx || typeof byIdx !== "object") continue;
        for (const idxStr of Object.keys(byIdx)) {
          const idx = parseInt(idxStr, 10);
          const rec = byIdx[idxStr];
          if (!Number.isInteger(idx) || !rec) continue;
          const v = Number(rec.value);
          if (Number.isNaN(v)) continue;
          if (metric === "temp") {
            if (city === "stoke") stokeTemp[idx] = v;
            else londonTemp[idx] = v;
          } else {
            if (city === "stoke") stokeHum[idx] = v;
            else londonHum[idx] = v;
          }
        }
      }
    }
  } catch {
  }
}


//edited value to be saved 
async function persistUpdate(idx, time, city, metric, value) {
  const body = new URLSearchParams({
    idx: String(idx),
    time,
    city,
    metric,
    value: String(value)
  });

  const res = await fetch("update_forecast.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body
  });
  if (res.status === 401 || res.status === 403) {

    //if not logged in, go to login page 
    window.location.href = window.LOGIN_URL || "login.php?next=" + encodeURIComponent("addweather.php");
    return false;
  }
  const json = await res.json().catch(() => null);
  if (!res.ok || !json || !json.ok) {
    alert((json && json.error) ? json.error : "Update failed.");
    return false;
  }
  return true;
}


document.addEventListener("DOMContentLoaded", async () => {
  populateTimeDropdown();
  await applyOverrides();   // load persisted admin changes (if any)
  createChart();
  setChartHeight();

  //updating chart when user changes the view settings 
  document.getElementById("citySelect")?.addEventListener("change", (e) => {
    currentCity = e.target.value;
    refreshChart();
  });
  document.getElementById("metricSelect")?.addEventListener("change", (e) => {
    currentMetric = e.target.value;
    refreshChart();
  });
  document.getElementById("colourPicker")?.addEventListener("input", refreshChart);
  document.getElementById("chartSize")?.addEventListener("change", setChartHeight);

  //admin update 
  document.getElementById("editForm")?.addEventListener("submit", async (e) => {
    e.preventDefault();
    if (!window.IS_ADMIN) {
      window.location.href = window.LOGIN_URL || "login.php?next=" + encodeURIComponent("addweather.php");
      return;
    }
    const idx = parseInt(document.getElementById("timeSelect").value, 10);
    const city = document.getElementById("editCity").value;
    const value = parseFloat(document.getElementById("editValue").value);
    const metric = currentMetric; // update whichever metric is currently selected
    const time = labels[idx];
    if (!Number.isInteger(idx) || Number.isNaN(value) || !time) return;

  
    //updating chart quick in the browser 
    if (metric === "temp") {
      if (city === "stoke") stokeTemp[idx] = value;
      else londonTemp[idx] = value;
    } else {
      if (city === "stoke") stokeHum[idx] = value;
      else londonHum[idx] = value;
    }
    refreshChart();

    //saving change on server-side 
    await persistUpdate(idx, time, city, metric, value);
  });
});

