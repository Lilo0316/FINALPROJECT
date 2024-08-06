<?php 
    session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'movie_db');
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' AND Password = '$password'");

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION["uemail"] = $row['email'];
                setcookie('uemail', $row['email'], time() + 60*60*24*30);
                header('Location: index.php');
                exit();
            }
            else {
                $error = "Invalid email or password";
                $_SESSION["login_error"] = $error;
                header("Location: nlogin.php");
                exit();
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/nlogin.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php
        if (isset($_GET['action']) && $_GET['action'] === 'logout') {
            echo "<p>You have been successfully logged out.</p>";
        }
        if (isset($_SESSION["login_error"])) {
            echo "<p class='error-msg'>{$_SESSION['login_error']}</p>";
            $_SESSION["login_error"] = "";
        }
        ?>
        <form id="loginForm"  method="post">
            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="text" name="email" class="input-text" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="input-text" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="login-btn">Login</button>
            </div>
        </form>
        <p class="sub-text">Don't have an account? <a href="signup.php">Sign Up</a></p>
        <p class="sub-text">login as admin <a href="adform.php">log In</a></p>
    </div>
</body>
</html>