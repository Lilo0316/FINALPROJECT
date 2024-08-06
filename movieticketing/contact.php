<?php
    session_start();
    if(!isset($_COOKIE['uemail']))
    {
        header('location: nlogin.php');
        die();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0D0E30;
        }


        .container {
            max-width: 800px; 
            margin: auto; 
            padding: 20px; 
            background-color: #0b0b3e; 
            border-radius: 8px; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
           
        }
        .contact-number {
    text-align: center;
    color: white;
   
}

        h1 {
            text-align: center;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
        }

        body, html {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
    </style>
</head>
<body>
<?php
include("navigation.php");
?>

<div class="container">
    <div class="contact-number">
    <h1>Contact Us</h1>
    <p>If you have any queries or need assistance, feel free to contact us.</p>
    <p><h4>Contact number: 01-456789 or 01-424689</h4></p>
    <p><h4>Email us on: SNscreen@gmail.com</h4></p>
    
</div>
    </div>
</body>
</html>
