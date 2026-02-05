<?php
require_once __DIR__ . '/includes/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Visualiser – Weather System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSS stylesheet-->
    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime(__DIR__ . '/css/style.css'); ?>">

    <!--chart librbary for graph-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!--forecaste data-->
    <script src="js/weatherforecast.js"></script>

    <!--page's styling-->
    <style>
        .viz-controls {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        .viz-controls label {
            display: block;
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 0.35rem;
        }
        .viz-controls select,
        .viz-controls input {
            width: 100%;
            background: #ffffffff;
            color: #000000ff;
            border: 1px solid #1f2937;
            border-radius: 12px;
            padding: 0.6rem 0.7rem;
        }
        .viz-form {
            margin-top: 1.25rem;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
            align-items: end;
        }
        @media (max-width: 900px) {
            .viz-controls, .viz-form { grid-template-columns: 1fr; }
        }
    </style>

</head>
<body>


<?php require_once __DIR__ . '/includes/header.php'; ?>

<main class="weather-page">

    <section class="weather-hero">
        <h1 class="weather-title">Weather System</h1>
        <p class="weather-subtitle">
            This is a 5-day forecast visualisation for Stoke-on-Trent and London using Chart.js.
        </p>
        <p><strong>Only admins can update values</strong>. </p>
    </section>

    <section class="weather-card">
        <div class="viz-controls">
            <div>
                <label for="citySelect">Choose a city</label>
                <select id="citySelect">
                    <option value="both">Stoke + London</option>
                    <option value="stoke">Stoke only</option>
                    <option value="london">London only</option>
                </select>
            </div>

            <div>
                <label for="metricSelect">Choose a forecast type</label>
                <select id="metricSelect">
                    <option value="temp">Temperature (°C)</option>
                    <option value="humidity">Humidity (%)</option>
                </select>
            </div>

            <div>
                <label for="colourPicker">Choose a colour</label>
                <input type="color" id="colourPicker" value="#ef4444">
            </div>

            <div>
                <label for="chartSize">Choose a chart size</label>
                <select id="chartSize">
                    <option value="320">Small</option>
                    <option value="420" selected>Medium</option>
                    <option value="560">Large</option>
                </select>
            </div>

        </div>

        <!--chart canvas-->
        <div class="weather-chart-wrapper" id="chartWrapper" style="height:420px;">
            <canvas id="forecastChart"></canvas>
        </div>

        <h3 style="margin-top: 1.25rem;">Add / Update a Forecast Value</h3>

        <!--non-admin users can view but cannot edit-->
        <?php if (!is_admin()): ?>
            <p style="opacity:0.9;margin-top:0.5rem;">
                You can view the forecast, but you must
                <a href="login.php?next=<?php echo urlencode('addweather.php'); ?>">log in as admin</a>
                to update values.
            </p>
        <?php endif; ?>

        <!--admin editing forms-->
        <form id="editForm" class="viz-form">
            <div>
                <label for="timeSelect">Forecast time</label>
                <select id="timeSelect"></select>
            </div>
            <div>
                <label for="editCity">City</label>
                <select id="editCity">
                    <option value="stoke">Stoke</option>
                    <option value="london">London</option>
                </select>
            </div>
            <div>
                <label for="editValue">New value</label>
                <!--input forms disabled if user is not admin-->
                <input type="number" id="editValue" step="0.1" required <?php echo is_admin() ? '' : 'disabled'; ?>>
            </div>
            <div>
                <button type="submit" class="btn btn-primary" style="width:100%;">
                    Update Chart
                </button>
            </div>
        </form>
    </section>
</main>


<footer>
    <p>@portfolio_webtech</p>
</footer>


<script>
  window.IS_ADMIN = <?php echo is_admin() ? 'true' : 'false'; ?>;
  window.LOGIN_URL = "login.php?next=" + encodeURIComponent("addweather.php");
</script>

<script src="js/addweather.js?v=<?php echo filemtime(__DIR__ . '/js/addweather.js'); ?>"></script>
<script src="js/main.js"></script>
</body>
</html>
