<?php
require_once __DIR__ . '/includes/session.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime(__DIR__ . '/css/style.css'); ?>">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
<?php require_once __DIR__ . '/includes/header.php'; ?>
<main class="cv-page">
    

    <!--profile summary at the top-->
    <section class="cv-hero">
        <div class="cv-avatar">
            <img src="images/user%20icon.png"
                 alt="Student profile photo"
                 class="cv-avatar-img">
        </div>
        <div class="cv-hero-text">
            <p class="cv-hero-kicker">Computer Science Student</p>
            <h1 class="cv-hero-title">Profile</h1>
        </div>
    </section>

    <!--the main cards-->
    <section class="cv-grid">

        <!--profile summary-->
        <article class="cv-card cv-card-wide">
            <div class="cv-card-header">
                <div class="cv-card-icon">
                    <img src="images/user.png"
                         alt="User icon for profile summary"
                         class="cv-card-icon-img">
                </div>
                <h2>Profile Summary</h2>
            </div>
            <p>
                Computer Science student with a strong foundation in cybersecurity and programming, pursuing a career in
                security. Skilled in Python, Linux, SQL, JavaScript and network fundamentals, with hands-on experience in
                vulnerability management, incident response and SIEM tools through Google Cybersecurity certification.
            </p>
            <p>
                Passionate about protecting digital systems, analysing threats, and applying technical expertise to real-world
                cybersecurity challenges. Strong communicator with proven teamwork abilities and a problem-solving mindset.
            </p>
        </article>

        <!--education-->
        <article class="cv-card cv-card-wide">
            <div class="cv-card-header">
                <div class="cv-card-icon">
                    <img src="images/book.png"
                         alt="Book icon representing education"
                         class="cv-card-icon-img">
                </div>
                <h2>Education</h2>
            </div>
            <div class="edu-block">
                <div class="edu-meta">
                    <span class="edu-tag">2023 – Present</span>
                    <span class="edu-note">BSc (Hons) Computer Science</span>
                </div>
                <h3>Keele University, Staffordshire, UK</h3>
                <p>
                    Focusing on software engineering, web development, and data structures.
                    Building skills in Java, MVC, object-oriented design, and modern web technologies.
                </p>
            </div>
            <div class="edu-block">
                <div class="edu-meta">
                    <span class="edu-tag">2021 – 2023</span>
                    <span class="edu-note">Completed</span>
                </div>
                <h3>Wolverhampton Girls’ High School, Wolverhampton, UK</h3>
                <p>
                    Completed A-levels in Biology, Chemistry, and Psychology.
                </p>
            </div>
            <div class="edu-block">
                <div class="edu-meta">
                    <span class="edu-tag">2016 – 2021</span>
                    <span class="edu-note">Completed</span>
                </div>
                <h3>The Phoenix Collegiate, West Bromwich, UK</h3>
                <p>
                    Completed GCSEs including English Literature, English Language, Mathematics, Geography,
                    Computing, Biology, Chemistry, and Physics.
                </p>
            </div>
        </article>


        <!--academic highlights-->
        <article class="cv-card cv-card-wide">
            <div class="cv-card-header">
                <div class="cv-card-icon">
                    <img src="images/writing.png"
                         alt="Writing icon representing academic highlights"
                         class="cv-card-icon-img">
                </div>
                <h2>Academic Highlights</h2>
            </div>
            <ul class="cv-list">
                <li>Experience in Roblox Lua programming (insight into game programming).</li>
                <li>Keele University app redesign (insight into UX design and working with clients).</li>
                <li>Completed multiple professional certifications to build technical knowledge.</li>
                <li>Magazine editor and designer for a student society.</li>
                <li>Mental Health Representative at sixth form.</li>
                <li>Care home volunteer.</li>
                <li>Primary school reading volunteer.</li>
            </ul>
        </article>


        <!--technical skills-->
        <article class="cv-card cv-card-tall">
            <div class="cv-card-header">
                <div class="cv-card-icon">
                    <img src="images/cog.png"
                         alt="Cog icon representing technical skills"
                         class="cv-card-icon-img">
                </div>
                <h2>Technical Skills</h2>
            </div>
            <div class="skills-list">
                <div class="skill-item">
                    <img src="images/html5.png" alt="HTML5 logo" class="skill-icon">
                    <span>HTML5</span>
                </div>
                <div class="skill-item">
                    <img src="images/css.png" alt="CSS logo" class="skill-icon">
                    <span>CSS3</span>
                </div>
                <div class="skill-item">
                    <img src="images/java.png" alt="Java logo" class="skill-icon">
                    <span>Java</span>
                </div>
                <div class="skill-item">
                    <img src="images/javascript.png" alt="JavaScript logo" class="skill-icon">
                    <span>JavaScript</span>
                </div>
                <div class="skill-item">
                    <img src="images/php.png" alt="PHP logo" class="skill-icon">
                    <span>PHP &amp; Server-side</span>
                </div>
                <div class="skill-item">
                    <img src="images/python.png" alt="Python logo" class="skill-icon">
                    <span>Python</span>
                </div>
                <div class="skill-item">
                    <img src="images/sql.png" alt="SQL logo" class="skill-icon">
                    <span>SQL</span>
                </div>
                <div class="skill-item">
                    <img src="images/oracle.png" alt="Oracle logo" class="skill-icon">
                    <span>Oracle</span>
                </div>
            </div>
        </article>

        <!--achievements-->
        <article class="cv-card">
            <div class="cv-card-header">
                <div class="cv-card-icon">
                    <img src="images/trophy.png"
                         alt="Trophy icon representing achievements"
                         class="cv-card-icon-img">
                </div>
                <h2>Achievements</h2>
            </div>
            <div class="cv-stats">
                <div class="cv-stat">
                    <img src="images/google.png"
                         alt="Google logo"
                         class="cv-stat-logo">
                    <span class="stat-value">Certification</span>
                    <span class="stat-label">
                        Google Cybersecurity<br>
                        Professional Certificate
                    </span>
                </div>
                <div class="cv-stat">
                    <img src="images/microsoft.png"
                         alt="Microsoft logo"
                         class="cv-stat-logo">
                    <span class="stat-value">Certification</span>
                    <span class="stat-label">
                        Microsoft Full-Stack Developer<br>
                        Professional Certificate
                    </span>
                </div>
                <div class="cv-stat">
                    <img src="images/ea.png"
                         alt="Electronic Arts logo"
                         class="cv-stat-logo">
                    <span class="stat-value">Certification</span>
                    <span class="stat-label">
                        Electronic Arts Software<br>
                        Engineering Forage Certificate
                    </span>
                </div>
            </div>
        </article>


            <!--modules-->
        <article class="cv-card cv-modules-card">
            <div class="cv-card-header">
                <div class="cv-card-icon">
                    <img src="images/computer.png"
                        alt="Computer icon representing web development modules"
                        class="cv-card-icon-img">
                </div>
                <h2>Modules</h2>
            </div>
            <?php
            
            //module list with links
            $modules = array(
                'CSC-20021' => array(
                    'title' => 'Web Technologies',
                    'url'   => 'https://www.keele.ac.uk/catalogue/2024-25/csc-20021.htm'
                ),
                'CSC-20077' => array(
                    'title' => 'Human-Computer Interaction',
                    'url'   => 'https://www.keele.ac.uk/catalogue/current/csc-20077.htm'
                ),
                'CSC-20002' => array(
                    'title' => 'Database Systems',
                    'url'   => 'https://www.keele.ac.uk/catalogue/2023-24/csc-20002.htm'
                ),
                'CSC-20075' => array(
                    'title' => 'Fundamentals of Data Science',
                    'url'   => 'https://www.keele.ac.uk/catalogue/2025-26/csc-20075.htm'
                )
            );

            ?>
            <ul class="module-list">
                <?php foreach ($modules as $code => $data): ?>
                    <li>
                        <a class="module-code-link"
                        href="<?php echo htmlspecialchars($data['url']); ?>"
                        target="_blank"
                        rel="noopener noreferrer">
                            <?php echo htmlspecialchars($code); ?>
                        </a>
                        <span class="module-title">
                            <?php echo htmlspecialchars($data['title']); ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </article>


        <!--image section-->
        <article class="cv-card cv-image-card">
            <div class="cv-card-header">
                <div class="cv-card-icon">
                    <img src="images/university.png"
                         alt="University building icon"
                         class="cv-card-icon-img">
                </div>
                <h2>Computer Science at Keele University</h2>
            </div>
            <div class="cv-image-wrapper">
                <img src="images/csl%20computer%20science.jpg"
                     alt="Students at a computing workshop in the central science laboratory at Keele University.">
            </div>
            <p class="cv-image-caption">
                Computing workshop in the Central Science Laboratory at Keele University.
            </p>
        </article>
    </section>
</main>


<footer>
    <p>@portfolio_webtech</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
