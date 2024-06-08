<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Pixel Playground
    </title>
    <!-- Link your CSS file here -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Your content goes here -->
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
        <!-- Game thumbnails -->
        <div class="game-grid">
            <div class="game-container">
                <div class="game-screen">
                </div>
                <h2>Snake</h2>
                <p>description of game</p>
                <a href = "snake.php"> <button class="play-now-button">play now</button> </a>
            </div>

            <div class="game-container">
                <div class="game-screen">
                </div>
                <h2>Dino Run</h2>
                <p>description of game</p>
                <a href = "dino.php"> <button class="play-now-button">play now</button> </a>
            </div>

            <div class="game-container">
                <div class="game-screen">
                </div>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <div class="game-screen">
                </div>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <div class="game-screen">
                </div>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>
        </div>
        
    </main>
    <footer>
        <p>&copy; 2024 Pixel Playground. All rights reserved.</p>
    </footer>
    
</body>
</html>
