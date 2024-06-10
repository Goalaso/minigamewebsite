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
        <div class="flex-container" width=100%>
            <div class="game-container">
                <div class="game-screen">
                    <a href="snake.php"><img class="thumbnail" src="assets/images/snake.png" alt="Snake">
                </div>
                <h2>Snake</h2>
                <a href="snake.php"> <button class="play-now-button">play now</button> </a>
            </div>

            <div class="game-container">
                <div class="game-screen">
                    <a href="dino.php"><img class="thumbnail" src="assets/images/dinorun.png" alt="Dino Run">
                </div>
                <h2>Dino Run</h2>
                <a href="dino.php"> <button class="play-now-button">play now</button> </a>
            </div>

            <div class="game-container">
                <div class="game-screen">
                    <a href="dodgeTheCreeps.php"><img class="thumbnail" src="assets/images/dodgeTheCreeps.png"
                            alt="Dodge the Creeps">
                </div>
                <h2>Dodge the Creeps</h2>
                <a href="dodge.php"> <button class="play-now-button">play now</button> </a>
            </div>


            <div class="game-container">
                <div class="game-screen">
                    <a href="bird.php"><img class="thumbnail" src="assets/images/flappyBird.png" alt="Flappy Bird">
                </div>
                <h2>Flappy Bird</h2>
                <a href="bird.php"><button class="play-now-button">play now</button></a>
            </div>

            <div class="game-container">
                <div class="game-screen">
                    <a href="space.php"><img class="thumbnail" src="assets/images/spaceInvaders.png" alt="Space Invaders">
                </div>
                <h2>Space Invaders</h2>
                <a href="space.php"><button class="play-now-button">play now</button></a>
            </div>
            
            <div class="game-container">
                <div class="game-screen">
                    <a href="minesweeper.php"><img class="thumbnail" src="assets/images/minesweeper.png"
                            alt="Minesweeper">
                </div>
                <h2>Minesweeper</h2>
                <a href="minesweeper.php"> <button class="play-now-button">play now</button> </a>
            </div>
        </div>

    </main>
    <footer>
        <p>&copy; 2024 Pixel Playground. All rights reserved.</p>
    </footer>

</body>

</html>