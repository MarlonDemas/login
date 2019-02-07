<?php
    session_start();
    require_once "connect.php";

    $users = $db_server->query("CREATE TABLE IF NOT EXISTS users(
                               UserID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                               Username VARCHAR(128) NOT NULL,
                               Password VARCHAR(128) NOT NULL,
                               Date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)");
    
    if ($users) {
    } else {
        echo "Error: " . $users;
    }    

    $userErr = "";
    if (isset($_POST['submit'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $todo_res = $db_server->query("SELECT * FROM users");
        while($row = $todo_res->fetch_assoc()) {
            if(trim($user)==$row['Username'] && password_verify(trim($pass), $row['Password'])) {
                $userErr = "Successfull";
                $_SESSION['user'] = $row['Username'];
                header('Location: hotel.php');
            } else {
                $userErr = "Username or password incorrect";
            }
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
        <style>
            .hero {
                background-image: url("img/pexels-photo-189296.jpeg");
                background-size: cover;
                background-repeat: no-repeat;
            }
            
            body .hero .navbar {
                background: rgba(255,255,255,0.4);
                padding-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <section class="hero is-fullheight has-background">
            <nav class="navbar" role="navigation" aria-label="main navigation">
                <div class="navbar-brand">
                    <a class="navbar-item" href="https://bulma.io">
                        <h3 class="title is-4 has-text-weight-bold has-text-black is-uppercase">me&you</h3>
                    </a>
                </div>
            </nav>
            <div class="hero-body">
                <div class="container has-text-centered">
                    <div class="column is-4 is-offset-4">                        
                        <div class="box">
                        <h3 class="title has-text-black">Login</h3>
                        <p class="subtitle has-text-black">Please login to proceed.</p>
                        <p><?php echo $userErr ?></p>
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" name="user" type="user" placeholder="Your Username" autofocus="">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="control">
                                        <input class="input is-large" name="pass" type="password" placeholder="Your Password">
                                    </div>
                                </div>
                                <button name="submit" class="button is-block is-info is-large is-fullwidth">Login</button>
                                <hr>
                                Don't have an account? 
                                <a href="signup.php">Sign Up</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>