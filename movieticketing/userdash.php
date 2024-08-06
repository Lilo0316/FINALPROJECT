<?php
session_start();
if(!isset($_COOKIE['uemail'])) {
    header('location: nlogin.php');
    die();
}

include('connection.php');

$loggedInEmail = $_SESSION['uemail'];

$sql = "SELECT name FROM user WHERE email = '$loggedInEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userName = $row['name'];
} else {
    header("location: nlogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="css/userdash.css" rel="stylesheet">
</head>
<?php include("navigation.php"); ?>
<body>
   
    <div class="container">
        <h1>Welcome to Your Dashboard</h1>
       
        <div>
            <?php include("upprof.php"); ?>
            <p class="subtext">Forget Password? <a href="changepassword.php">Change Password</a></p>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </div>
</body>
</html>
