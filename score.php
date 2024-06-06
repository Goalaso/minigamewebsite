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
    <footer>
        <p>&copy; 2024 Pixel Playground. All rights reserved.</p>
    </footer>
</body>
<?php

    $database = new SQLite3('account.db');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Insert score into database
        
        // $id = $_SESSION['id'];
        // $username = $_SESSION['username'];
        // $game = $_POST['game'];
        // $score = $_POST['score'];

        try {
            $insert_query = $database->prepare("INSERT INTO score (id, username, game, score) VALUES (:id, :username, :game, :score);");

            //var_dump($_POST);

            $insert_query->bindValue(":id", $_SESSION["id"], SQLITE3_INTEGER);
            $insert_query->bindValue(":username", $_SESSION["username"], SQLITE3_TEXT);
            $insert_query->bindValue(":game", $_POST["game"], SQLITE3_TEXT);
            $insert_query->bindValue(":score", $_POST["score"], SQLITE3_INTEGER);
            
            $scores = $insert_query->execute();

            //echo "Success!";
            //echo var_dump($accounts->fetchArray());
            // header("Location: manage.php");
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        
        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') { // Create high score table

            ?>
            <table>
                <tr>
                    <th>User</th>
                    <th>Game</th>
                    <th>Score</th>
                </tr>
            <?php
            $query = <<<HEREDOC
            SELECT * FROM score 
            WHERE game = 'snake'
            ORDER BY score DESC
            LIMIT 5;
            HEREDOC;
            $scores = $database->query($query);
            
            while ($row = $scores->fetchArray(SQLITE3_ASSOC)) {
                
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['game'] . "</td>";
                echo "<td>" . $row['score'] . "</td>";
                echo "</tr>";
                }
                } else {
                    echo "Only GET and POST accepted.";
                }
                    
            ?>
        </table>
</html>