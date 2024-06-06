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

        <nav>
            <ul>
                <li><a href="pixelPlayground.php">Home</a></li>
                <li><a href="games.php">Games</a></li>
                <li><a href="login.php">Login/Sign up</a></li>
                <li><a href="score.php">Score</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </nav>
    </div>

    <main>

        <div class="welcome-block">
            <h2>Welcome to Pixel Playground!</h2>
            <p>Explore our collection of exciting games!</p>
            <a href="games.php" class="play-button">Play Now</a>
        </div>

    </main>

    <footer>
        <p>&copy; 2024 Pixel Playground. All rights reserved.</p>
    </footer>
</body>

</html>