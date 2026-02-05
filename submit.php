<?php
require_once __DIR__ . '/includes/session.php';
require_admin(); //only admins can access this page 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Weather Record – Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime(__DIR__ . '/css/style.css'); ?>">
</head>
<body>

<?php require_once __DIR__ . '/includes/header.php'; ?>


<main class="weather-page">

<!--page title and small description-->
    <section class="weather-hero">
        <h1 class="weather-title">Add a Weather Record</h1>
        <p class="weather-subtitle">
            Admin-only. Adds or updates a time point in <code>data/weather.json</code>.
        </p>
    </section>

    <!--form card-->
    <section class="weather-card">

        <form method="POST" action="add.php" class="login-form" style="max-width:720px;margin:0 auto;">

            <!--inputs-->
            <label for="time">Time of day (HH:MM)</label>
            <input type="text" id="time" name="time" placeholder="e.g. 12:00" required>
            <label for="temperature">Temperature (°C)</label>
            <input type="number" id="temperature" name="temperature" placeholder="e.g. 8" required>
            <label for="humidity">Humidity (%)</label>
            <input type="number" id="humidity" name="humidity" placeholder="e.g. 65" required>
            <button type="submit" class="btn btn-primary" style="margin-top:1rem;">
                Add / Update Record
            </button>
        </form>
    </section>
</main>

<footer>
    <p>@portfolio_webtech</p>
</footer>

<script src="js/main.js"></script>
</body>
</html>