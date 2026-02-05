<?php
require_once __DIR__ . '/includes/session.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Technologies Portfolio</title>

    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime(__DIR__ . '/css/style.css'); ?>">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
<?php require_once __DIR__ . '/includes/header.php'; ?> 
<main>

    <!--hero area-->
    <section class="home-hero">
        <div class="home-hero-inner">
            <p class="hero-kicker">CSC-20021 · Web Technologies</p>
            <h1 class="hero-title">
                Web Technologies<br>
                <span>Portfolio</span>
            </h1>
            <p class="hero-subtitle">
                This website demonstrates the principles of web development,
                responsive design principles, and interactive data visualisation using Chart.js.
            </p>

            <!--main buttons-->
            <div class="hero-actions">
                <a href="cv.php" class="btn btn-primary">
                    <span>View CV</span>
                    <span class="btn-icon">➜</span>
                </a>
                <a href="weather.php" class="btn btn-outline">
                    <span>Weather Data</span>
                    <span class="btn-icon">
                        <img src="images/weather.png" alt="Weather icon representing weather data">
                    </span>
                </a>
            </div>
        </div>
    </section>


    <!--portfolio components section-->
    <section class="home-section">
        <div class="home-section-inner">
            <h2 class="section-title">Portfolio Components</h2>
            <p class="section-subtitle">
                These are the components of my website portfolio, along with their technical implementation.
            </p>
            <!--toggle buttons-->
            <button type="button" id="toggle-tech" class="btn btn-outline">
                Show / hide component details
            </button>

            <div class="component-grid" id="tech-details">
                <article class="component-card">
                    <div class="component-icon">
                        <img src="images/user.png" alt="User profile icon for CV section" class="component-icon-img">
                    </div>
                    <h3>My CV</h3>
                    <p>Profile summary, academic achievements, skills and information about the module.</p>
                    <a href="cv.php" class="component-link">Open CV</a>
                </article>

                <article class="component-card">
                    <div class="component-icon">
                        <img src="images/weather.png" alt="Weather visualisation icon" class="component-icon-img">
                    </div>
                    <h3>Weather Visualisation</h3>
                    <p>Interactive Chart.js visualisations of Stoke-on-Trent weather data.</p>
                    <a href="weather.php" class="component-link">View Weather Data</a>
                </article>

                <article class="component-card">
                    <div class="component-icon">
                        <img src="images/addition.png" alt="Addition icon representing the idea of adding records of weather to the weather system" class="component-icon-img">
                    </div>
                    <h3>Weather System</h3>
                    <p>A weather tracking/reporting of a 5-day forecast of Stoke and London.</p>
                    <p>Only Amdmins can add weather records to the chart.  </p>
                    <a href="addweather.php" class="component-link">View Weather system</a>
                </article>
            </div>
        </div>
    </section>

    <!--about section-->
    <section class="home-section home-about">
        <div class="home-section-inner about-layout">
            <div class="about-text">
                <h2 class="section-title">About This Project</h2>
                <p>
                    This portfolio website was developed to demonstrate both front-end and back-end principles.
                </p>
                <p> Key features include: a responsive design, interative data visuslation using Chart.js and an accessaible user interface.  </p>
            </div>

            <div class="about-pill-grid">
                <div class="about-pill"><h3>Responsive</h3><p>Design</p></div>
                <div class="about-pill"><h3>Chart.js</h3><p>Visualisation</p></div>
                <div class="about-pill"><h3>HTML5</h3><p>CSS3 · JS</p></div>
                <div class="about-pill"><h3>WCAG</h3><p>Accessible</p></div>
            </div>
        </div>
    </section>

    <!--buttons-->
    <section class="home-section home-cta">
        <div class="home-section-inner home-cta-inner">
            <h2 class="section-title">Ready to Explore?</h2>
            <p class="section-subtitle">
                Open the CV page to learn about academic achievements and skills,
                or explore the interactive weather data visualisations.
            </p>
            <div class="hero-actions">
                <a href="cv.php" class="btn btn-primary">View My CV</a>
                <a href="weather.php" class="btn btn-outline">Explore Weather Data</a>
            </div>
        </div>
    </section>
</main>


<footer>
    <p>@portfolio_webtech</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
