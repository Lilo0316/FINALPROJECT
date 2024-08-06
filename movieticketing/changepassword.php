<?php
session_start();
include('connection.php');
if(isset($_SESSION['uemail'])) {
    $email = $_SESSION['uemail'];
    $res=mysqli_query($conn,"SELECT Password FROM user WHERE email='$email'");
    $row=mysqli_fetch_assoc($res);
    $password = $row['Password'];
    if(isset($_POST['submit'])) {
        if(isset($_POST['cur_pass'], $_POST['new_pass'], $_POST['con_pass'])) {
            $cur_pass = $_POST['cur_pass'];
            $new_pass = $_POST['new_pass'];
            $con_pass = $_POST['con_pass'];

            if($cur_pass == $password) {
                if($new_pass == $con_pass) {
                    $update_user = $conn->prepare("UPDATE `user` SET Password=? WHERE email=?");
                    $update_user->bind_param("ss", $new_pass, $email);
                    $update_user->execute();
                    echo '<script>
                            alert("Password changed successfully");
                          </script>';
                } else {
                    echo'<script>
                        alert("Passwords do not match");
                    </script>';
                }
            } else {
                echo'<script>
                        alert("Current password incorrect");
                    </script>';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Change Password</title>
        <style>
               body {
    font-family: Arial, sans-serif;
    background-color: #0D0E30; 
    margin: 0;
    padding: 20px;
    color: white;
}
           .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}
            
            form #upd
            {
                text-align: center;
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s;
            }
            form #upd:hover
            {
                background-color: #0056b3;
            }
            .change-password-form {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
            }
            .change-password-form input[type="password"] {
        width: calc(100% - 22px); /* Adjust the width */
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        }
        </style>
        
    </head>
    <body>
        <div class="container">
        <div class="change-password-form">
                <h2>CHANGE PASSWORD</h2><br>

            <form action="" method="post" class="passform" onsubmit="return update()">
            <p>Current Password<br><br>
                <input type="password" name="cur_pass" value="<?php echo htmlspecialchars($password); ?>" id="show">
            </p>
            <p>New Password<br><br>
                <input type="password" name="new_pass" value="" id="show">
            </p>
            <p>Confirm Password<br><br>
                <input type="password" name="con_pass" value="" id="show">
            </p>
            <input type="submit" name="submit" value="Save Changes" id="upd">
            <p class=sub-text>Go Back To HomePage. <a href="index.php">Go Back. </a></p>
            </form>
        </div>
        </div>
    </body>
</html>