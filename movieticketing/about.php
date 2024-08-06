<?php
session_start();
if(!isset($_COOKIE['uemail'])) {
    header('location: nlogin.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket Booking</title>
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

        section#about {
            margin-top: 20px; 
        }

        section#about h2 {
            color: white; 
            font-size: 24px;
            margin-bottom: 10px;
        }

        section#about p {
            color: white; 
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        section#about ul {
            color: white; 
            font-size: 16px;
            line-height: 1.5;
            padding-left: 20px; 
        }

        section#about ul li {
            margin-bottom: 5px; 
        }
        body, html {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
    </style>
<?php include("navigation.php");?>
</head>
<body>
  <div class="container">
    <section id="about">
        <h2>About Us</h2>
        <p>Welcome to  our movie ticket booking platform! We bring the magic of cinema to your fingertips.</p>
       
        <p>Why choose us?</p>
        <ul>
            <li>Extensive Movie Selection:We feature a wide range of trending and just released movies to suit every taste.</li>
            <li>Convenient Booking: Skip the long lines and book your tickets online, anytime, anywhere.</li>
            
            
            <li>24/7 Customer Support: Our dedicated support team is here to assist you with any questions or concerns.</li>
        </ul>
        
    </section>
  </div>

 
</body>
</html>
