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
    <footer>
        <p>&copy; 2024 Pixel Playground. All rights reserved.</p>
    </footer>
</body>
<?php

$database = new SQLite3('./account.db');

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Insert score into database
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $game = $data['game'];
    $score = $data['score'];

    try {
        $insert_query = $database->prepare("INSERT INTO score (id, username, game, score) VALUES (:id, :username, :game, :score);");

        $insert_query->bindValue(":id", $id, SQLITE3_INTEGER);
        $insert_query->bindValue(":username", $username, SQLITE3_TEXT);
        $insert_query->bindValue(":game", $game, SQLITE3_TEXT);
        $insert_query->bindValue(":score", $score, SQLITE3_INTEGER);

        $scores = $insert_query->execute();

        //echo "Success!";
        //echo var_dump($accounts->fetchArray());
        // header("Location: manage.php");

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Create high score table

    ?>
        <form action="score.php" method="GET">
            <input type="range" id="numScores" name="numScores" list="values">
            <label for="numScores">Number of scores shown</label>
            <datalist id="values">
                <option value="0" label="0"></option>
                <option value="25" label="25"></option>
                <option value="50" label="50"></option>
                <option value="75" label="75"></option>
                <option value="100" label="100"></option>
            </datalist>

            <input type="checkbox" id="personal" name="personal" value="1">
            <label for="personal">Personal high scores only?</label>

            <select id="game" name="game">
                <option value="dino">Dino Runner</option>
                <option value="creeps">Dodge the Creeps</option>
                <option value="snake">Snake</option>
                <option value="bird">Wacky Bird</option>
                <option value="space">Space Invaders</option>
            </select>


            <input type="submit" value="Submit">
        </form>

        <?php
        // Default high score table values
        $game = 'all';
        $numScores = 10;
        $personal = 0;
        $games = array("snake", "dino", "creeps", "bird");
        $gamenames = array("Snake", "Dino Runner", "Dodge the Creeps", "Wacky Bird");

        // User high score table values`
        if (isset($_GET['game'])) {
            $game = $_GET['game'];
        }

        if (isset($_GET['numScores'])) {
            $numScores = $_GET['numScores'];
        }

        if (isset($GET['personal'])) {
            $personal = $GET['personal'];
        }

        // echo ($game . $numScores . " " . $personal);
    
        if ($game == 'all') {
            $i = 0;
            foreach ($games as $game) {
                $query = "
                    SELECT * FROM score
                    WHERE game = '" . $game . "' 
                    ORDER BY score DESC
                    LIMIT " . $numScores
                ;
                $scores = $database->query($query);

                echo "
                        <table class='high-score-table'>
                            <caption>" . $gamenames[$i] . "</caption>
                            <tr>
                                <th>User</th>
                                <th>Score</th>
                            </tr>
                    ";

                while ($row = $scores->fetchArray(SQLITE3_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['score'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                $i++;
            }
        } else if (isset($_GET['personal'])) {
            if (!isset($_SESSION['username'])) {
                echo "Please log in to view personal high scores";
            } else {
                switch ($game) {
                    case 'dino':
                        $gamename = 'Dino Runner';
                        break;
                    case 'creeps':
                        $gamename = 'Dodge the Creeps';
                        break;
                    case 'snake':
                        $gamename = 'Snake';
                        break;
                    case 'bird':
                        $gamename = 'Wacky Bird';
                        break;
                    case 'space':
                        $gamename = 'Space Invaders';
                        break;
                    default:
                    echo 'Error: no game name';
                }

                $query = "
                            SELECT * FROM score
                            WHERE game = '" . $game . "' AND username = '" . $_SESSION['username'] . "'
                            ORDER BY score DESC
                            LIMIT " . $numScores
                ;
                $scores = $database->query($query);

                echo "
                        <table class='high-score-table'>
                        <caption>" . $gamename . "</caption>
                        <tr>
                        <th>User</th>
                        <th>Score</th>
                        </tr>
                    ";

                while ($row = $scores->fetchArray(SQLITE3_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['score'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        } else {
            switch ($game) {
                case 'dino':
                    $gamename = 'Dino Runner';
                    break;
                case 'creeps':
                    $gamename = 'Dodge the Creeps';
                    break;
                case 'snake':
                    $gamename = 'Snake';
                    break;
                case 'bird':
                    $gamename = 'Wacky Bird';
                    break;
                case 'space':
                    $gamename = 'Space Invaders';
                    break;
                default:
                echo 'Error: no game name';
            }

            $query = "
                        SELECT * FROM score
                        WHERE game = '" . $game . "' 
                        ORDER BY score DESC
                        LIMIT " . $numScores
            ;
            $scores = $database->query($query);

            echo "
                    <table class='high-score-table'>
                    <caption>" . $gamename . "</caption>
                    <tr>
                    <th>User</th>
                    <th>Score</th>
                    </tr>
                    ";

            while ($row = $scores->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['score'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

        }
} else {
    echo "Only GET and POST accepted.";
}

?>

</html>