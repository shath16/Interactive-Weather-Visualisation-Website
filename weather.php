<?php
require_once __DIR__ . '/includes/session.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stoke-on-Trent Weather Visualisation</title>

    <!--css styling-->
    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime(__DIR__ . '/css/style.css'); ?>">

    <!--icon library-->
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">

    <!--chart.js-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>


<?php require_once __DIR__ . '/includes/header.php'; ?>

<main class="weather-page">

    <!--hero area, intro-->
    <section class="weather-hero">
        <h1 class="weather-title">Stoke-on-Trent Weather Data</h1>
        <p class="weather-subtitle">
            This is an interactive visualisation of sample temperature and humidity data for a one day
            in Stoke-on-Trent using Chart.js.
        </p>
    </section>

    <!--main card-->
    <section class="weather-card">
        <div class="weather-text">
            <p>
                This chart presents <strong>sample data temperature and humidity</strong> for a day in Stoke-on-trent.
            </p>
            <p>
                This data is stored in <code>data/weather.json</code>. You can hover for tool tips + buttons to switch datasets.
            </p>
        </div>

        <!--chart area-->
        <div class="weather-chart-shell">
            <div class="weather-chart-wrapper" id="chartWrapper" style="height:420px;">
                <canvas id="weatherChart"></canvas>
            </div>
        </div>

        <!--buttons for switching datasets-->
        <div class="weather-buttons">
            <button type="button" class="btn btn-primary" onclick="showTemp()">Temperature</button>
            <button type="button" class="btn btn-primary" onclick="showHumidity()">Humidity</button>
        </div>

        <!--user customisation controls-->
        <div class="weather-customise">
            <div class="weather-customise-row">
                <label for="datasetSelect">Dataset</label>
                <select id="datasetSelect">
                    <option value="temp">Temperature</option>
                    <option value="humidity">Humidity</option>
                </select>

                <label for="typeSelect">Chart type</label>
                <select id="typeSelect">
                    <option value="line">Line</option>
                    <option value="bar">Bar</option>
                </select>

                <label for="colourPick">Colour</label>
                <input type="color" id="colourPick" value="#0ea5e9">
            </div>

            <div class="weather-customise-row">
                <label for="fontSelect">Font</label>
                <select id="fontSelect">
                    <option value="Arial">Arial</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Tahoma">Tahoma</option>
                    <option value="Georgia">Georgia</option>
                </select>

                <label for="fontSize">Font size</label>
                <input type="range" id="fontSize" min="10" max="18" value="12">
                <span id="fontSizeVal">12px</span>

                <label for="lineWidth">Line/Border width</label>
                <input type="range" id="lineWidth" min="1" max="6" value="2">
                <span id="lineWidthVal">2</span>
            </div>

            <div class="weather-customise-row">
                <label for="chartHeight">Chart height</label>
                <input type="range" id="chartHeight" min="260" max="520" value="420">
                <span id="chartHeightVal">420px</span>
            </div>
        </div>
    </section>
</main>

<footer>
    <p>@portfolio_webtech</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/weather.js?v=<?php echo filemtime(__DIR__ . '/js/weather.js'); ?>"></script>
<script src="js/main.js"></script>

</body>
</html>
