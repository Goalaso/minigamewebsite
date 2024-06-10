<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Pixel Playground
    </title>
    <!-- Link your CSS file here -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header-bar">
        <div class="logo">
            <a href="pixelPlayground.php"><img src="assets/images/Pixel4.png" alt="Gaming Website Logo"></a>
        </div class>

        <div class="welcome">
            <?php if (isset($_SESSION['username'])) {
                echo "Welcome " . $_SESSION['username'] . " | <a href='./logout.php'>Log out</a>";
            } ?>
        </div>

        <nav>
            <ul>
                <li><a href="pixelPlayground.php">Home</a></li>
                <li><a href="games.php">Games</a></li>
                <?php if (!isset($_SESSION['username'])) {
                    echo "<li><a href='login.php'>Login/Sign up</a></li>";
                } ?>
                <li><a href="score.php">Score</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </nav>
    </div>
    <main>


        <div class="about-block">
            <h2>Welcome to Pixel Playground!</h2>
            <h3>Project Overview</h3>
            <p>Pixel Playground is a mini games website that is a platform designed to offer a collection of engaging and
                fun minigames to users.
                Developed as part of the CS 410 Software Engineering course, this project aims to provide a seamless and
                enjoyable gaming experience through a well-integrated frontend, backend, and game engine.</p>

            <h3>Features</h3>
            <p>Variety of Games: Enjoy multiple minigames including puzzles, action, and strategy games.</p>
            <p>User-Friendly Interface: Easy navigation and intuitive design.</p>
            <p>Scoring System: Track your scores and compete with others.</p>
            <p>User Accounts: Create an account, login, and manage your profile.</p>
            <p>Leaderboards: See how you stack up against other players.</p>

            <h3>Technology Stack</h3>
            <p>Frontend: Built with HTML, CSS, and JavaScript.</p>
            <p>Backend: Powered by PHP with SQLite3 for database management.</p>
            <p>Game Development: Games are created and integrated using Godot Engine.</p>

            <!-- edit -->
            <h3>Architecture</h3>
            <p>Frontend-Backend Interaction: The frontend communicates with the backend using PHP/JavaScript.</p>
            <p>Data Flow: User actions and game data are sent to the backend, processed, and stored in the SQLite3
                database. The backend serves game state data to the frontend and Godot.</p>
            <p>Hosting: The application is hosted on Heroku with a CI/CD pipeline for continuous deployment.</p>

            <h3>Team Members</h3>
            <p>Jacob Lin: Frontend Developer and Game Developer (Godot)</p>
            <p>Selena Sat: Frontend Developer</p>
            <p>Tyler Anton: Backend Developer and Database Administrator</p>
            <p>Andrew Fales: Game Developer (Godot)</p>

            <h3>Development Process</h3>
            <p>We followed Agile methodology with bi-weekly sprints and stand-up meetings. Tools such as Trello for
                project
                management and GitHub for version control were crucial in our development process.</p>


        </div>

    </main>
    <footer>
        <p>&copy; 2024 Pixel Playground. All rights reserved.</p>
    </footer>
</body>

</html>