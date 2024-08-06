<?php
session_start();
if(!isset($_COOKIE['uemail'])) {
    header('location: nlogin.php');
    die();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
               body {
            font-family: Arial, sans-serif;
            background-color: #0D0E30;
            
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color:#0b0b3e;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: white;
        }
        .success-message {
    background-color: white;
    border: 1px solid #d0e9c6;
    color: black;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    text-align: center;
    width: 500px;
    margin-left: auto;
    margin-right: auto; /* or simply margin: 0 auto; */

        }

        .success-message i {
            margin-right: 5px;
            color: #3c763d;
           
        }

        .success-message a {
            color: #31708f;
            text-decoration: none;
            font-weight: bold;
        }

        .success-message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
include('connection.php');

$loggedInEmail = $_SESSION['uemail'];
$sql = "SELECT id FROM user where email='$loggedInEmail'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id']; 
} else {
    die("User does not exist.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = mysqli_real_escape_string($conn, $_POST['movie_id']);
    $selectedDate = mysqli_real_escape_string($conn, $_POST['selectedDate']);
    $selectedTime = mysqli_real_escape_string($conn, $_POST['selectedTime']);
    
    // Ensure the time is in HH:MM format and convert to HH:MM:SS
    $formattedTime = date('H:i:s', strtotime($selectedTime));
    
    $showtime = $selectedDate . ' ' . $formattedTime; // Combine date and time if using DATETIME

    // Remaining form fields
    $seats = mysqli_real_escape_string($conn, $_POST['seats']);
    $selectedSeats = mysqli_real_escape_string($conn, $_POST['selectedSeats']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    
    // Insert booking details into the database
    $sql = "INSERT INTO bookings (movie_id, user_id, showtime, seats, selectedSeats, price) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissss", $movie_id, $user_id, $showtime, $seats, $selectedSeats, $price);
    
    if ($stmt->execute()) {
        echo "<h1>Booking Confirmation</h1>";
        echo '<div class="success-message">';
        echo '<i class="fas fa-check-circle"></i> Booking successful! Thank you for choosing us. <a href="index.php">Go back to home</a>';
        echo '</div>';
    } else {
        echo "Error: " . $stmt->error;
    }
}

?>
</body>
</html>