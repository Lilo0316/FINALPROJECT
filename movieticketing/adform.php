<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'movie_db');
    
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === "snadmin@gmail.com") {
        $_SESSION["uemail"] = $email;
        setcookie('uemail', $email, time() + 60*60*24*30);
        header('location: admin.php');
        exit();
    } else {
        $error = "Access denied. You do not have permission to access this page.";
        $_SESSION["login_error"] = $error;
        header("Location: adform.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="css/adform.css" rel="stylesheet">
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
        <form id="loginForm" method="post">
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

    </div>
</body>
</html>