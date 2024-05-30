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
            <a href="pixelPlayground.html"><img src="assets/images/Pixel4.png" alt="Gaming Website Logo"></a>
        </div class>

        <nav>
            <ul>
                <li><a href="pixelPlayground.php">Home</a></li>
                <li><a href="games.html">Games</a></li>
                <li><a href="login.php">Login/Sign up</a></li>
                <li><a href="score.html">Score</a></li>
                <li><a href="about.html">About</a></li>
            </ul>
        </nav>
    </div>

    <main>
        <div class="login-container">
            <form action="login.php" method="post">
                <h2>Login</h2>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Pixel Playground. All rights reserved.</p>
    </footer>
</body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // $database->exec()
    
        // $clean = array();
        // $clean['username'] = $_POST['username'];
        // $clean['password'] = $_POST['password'];
    
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($_POST['username'])) {
            echo "Missing field: username";
        } else if (empty($_POST['password'])) {
            echo "Missing field: password";
        } else {
            try {
                $database = new SQLite3('account.db');
                $query = <<<HEREDOC
            SELECT * FROM account;
            HEREDOC;
                $accounts = $database->query($query);
                $match = false;
                while ($row = $accounts->fetchArray(SQLITE3_ASSOC)) {
                    //Test
                    // echo $row['username'];
                    if ($username === $row['username'] && $password === $row['password']) {
                        $match = true;
                        // $_SESSION['fullname'] = $row['fullname'];
                        $_SESSION['id'] = $row['id'];
                    }
                }
                if (!$match) {
                    if (empty($_SESSION['login_attempts'])) {
                        $_SESSION['login_attempts'] = 0;
                    }
                    echo "Login failed " . ++$_SESSION['login_attempts'] . " times.";
                } else {
                    $_SESSION['login_attempts'] = 0;
                    // header("Location: ./manage.php");
                    echo("Login successful");
                }
            } catch (Exception $e) {
                echo 'Connection failed: could not connect to database. ', $e->getMessage(), "\n";
            }
        }

    } else if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        echo "Only GET and POST accepted.";
    }
    ?>

</html>