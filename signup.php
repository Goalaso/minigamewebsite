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
        <div class="login-container">
            <form action="signup.php" method="post">
                <h2>Sign up</h2>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmpassword">Confirm Password:</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" required>
                </div>
                <button type="submit">Sign up</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Pixel Playground. All rights reserved.</p>
    </footer>
</body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['password'] == $_POST['confirmpassword']) {
        try {
            $database = new SQLite3('account.db');

            $query = $database->prepare("SELECT * FROM account WHERE username = :username;");
            $query->bindValue(":username", $_POST["username"], SQLITE3_TEXT);
            $isUsernameTaken = $query->execute();
            // echo var_dump($isUsernameTaken);

            // Idk how this works. isUsernameTaken always has value 0 when var_dumped but if statement still executes?
            if ($isUsernameTaken) {

                $insert_query = $database->prepare("INSERT INTO account (username, password) VALUES
    (:username, :password);");

                //var_dump($_POST);

                //$insert_query->bindValue(":id", 6, SQLITE3_INTEGER);
                $insert_query->bindValue(":username", $_POST["username"], SQLITE3_TEXT);
                $insert_query->bindValue(":password", $_POST["password"], SQLITE3_TEXT);

                $accounts = $insert_query->execute();

                // Test
                echo "Success!";
                //echo var_dump($accounts->fetchArray());
                // header("Location: manage.php");
            } else {
                echo "Username taken";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Passwords do not match";
    }
} else if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    echo "Only GET or POST accepted";
}
?>
</html>