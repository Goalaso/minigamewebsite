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
        <!-- Game thumbnails, news articles, etc. -->
        
        <div class="game-grid">
            <div class="game-container">
                <div class="game-info">
                <h2>Game 1</h2>
                </div>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <h2>Game 2</h2>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <h2>Game 3</h2>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <h2>Game 4</h2>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <h2>Game 5</h2>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <h2>Game 6</h2>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <h2>Game 7</h2>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <h2>Game 8</h2>
                <p>description of game</p>
                <button class="play-now-button">play now</button>
            </div>

            <div class="game-container">
                <h2>Game 9</h2>
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
