<?php
require_once __DIR__ . '/includes/session.php';
// If already logged in as admin, go to intended page (next) or addweather.php

//if user is already admin, send straight to wanted to page 
if (is_admin()) {
    $next = $_GET['next'] ?? 'addweather.php';
    header('Location: ' . $next);
    exit;
}

//reading the form inputs 
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    //admin login details stored in csv file 
    $usersFile = __DIR__ . '/data/users.csv';


    if (!file_exists($usersFile)) {
        $error = 'Login system error: users.csv file not found.';
    } else {

        $handle = fopen($usersFile, 'r');
        if ($handle === false) {
            $error = 'Login system error: unable to read users.csv.';

        } else {
            $isValid = false;
            $adminName = '';
            
            //skipping first row
            $first = fgetcsv($handle);
            
            //reading each row for matching admin details 
            while (($row = fgetcsv($handle)) !== false) {
                if (count($row) < 3) continue;
                $fileUser  = trim($row[0]);
                $filePass  = trim($row[1]);
                $fileAdmin = trim($row[2]); // 1 or 0
                if ($username === $fileUser && $password === $filePass && $fileAdmin === '1') {
                    $isValid = true;
                    $adminName = $fileUser;
                    break;
                }
            }

            fclose($handle);
            if ($isValid) {
                session_regenerate_id(true);
                $_SESSION['logged_in'] = true;
                $_SESSION['username']  = $adminName;
                $_SESSION['is_admin']  = true;
                //sending user back to addweather.php
                $next = $_GET['next'] ?? 'addweather.php';
                header('Location: ' . $next);
                exit;
            } else {
                $error = 'Invalid admin login credentials.';
            }
        }
    }
}

$nextForForm = $_GET['next'] ?? 'addweather.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login – Web Tech Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    
    <style>
        /*----styling of login page----*/
        body.login-page { min-height: 100vh; margin: 0; }
        .login-main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 3.5rem 1.5rem 2.5rem;
        }
        .login-wrapper { display: flex; justify-content: center; }
        .login-card {
            width: min(560px, 100%);
            background: #270027;
            border-radius: 18px;
            padding: 1.75rem 1.5rem;
            border: 1px solid #ffffffcd;
        }
        .login-card,
        .login-card h2,
        .login-card p,
        .login-form label,
        .login-hint { color: #f9fafb !important; }
        .login-card p { margin: 0 0 1rem 0; font-size: 0.95rem; opacity: 0.9; }
        .login-form { display: flex; flex-direction: column; gap: 0.85rem; }
        .login-form label { font-size: 0.9rem; opacity: 0.95; }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            padding: 0.65rem 0.75rem;
            border-radius: 10px;
            border: 1px solid #1f2937;
            background: #270027;
            color: #000000;
            font-size: 0.95rem;
            outline: none;
        }
        .login-form input:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14,165,233,0.15);
        }
        .login-form input::placeholder { color: rgba(249, 250, 251, 0.55); }
        .error-message {
            margin-bottom: 1rem;
            padding: 0.75rem 0.9rem;
            border-radius: 12px;
            background: rgba(239, 68, 68, 0.12);
            color: #fecaca;
            border: 1px solid rgba(239, 68, 68, 0.35);
            font-size: 0.95rem;
        }
        .login-hint { margin-top: 0.85rem; font-size: 0.85rem; opacity: 0.75; }
    </style>
</head>


<body class="login-page">
<?php require_once __DIR__ . '/includes/header.php'; ?>


<main class="login-main">
    <section class="weather-hero">
        <h1 class="weather-title">Admin Login</h1>
        <p class="weather-subtitle">
            Admins can add weather records on the weather system page.
        </p>
    </section>

    <div class="login-wrapper">
        <section class="login-card">
            <h2>Admin Login</h2>
            
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            

            <form action="login.php?next=<?php echo urlencode($nextForForm); ?>" method="post" class="login-form">
                <label for="username-admin">Username</label>
                <input type="text" id="username-admin" name="username" required autocomplete="username" placeholder="e.g. user16">
                <label for="password-admin">Password</label>
                <input type="password" id="password-admin" name="password" required autocomplete="current-password" placeholder="Your password">
                <button type="submit" class="btn btn-primary" style="margin-top:0.5rem;">
                    Log in as Admin
                </button>

            </form>
            <div class="login-hint">
                Enter admin credentials (from <code>data/users.csv</code>)           
            </div>
        </section>
    </div>
</main>


<footer>
    <p>@portfolio_webtech</p>
</footer>

<script src="js/main.js"></script>
</body>
</html>

