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
    <title>My Bookings</title>
    <style>

    body {
            font-family: Arial, sans-serif;
            background-color: #0D0E30;
        }
        h2 {
            color:white;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid ;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color:white;
        }

        th {
            background-color: #f2f2f2;
            color: black;
        }

        
        tr:hover {
            background-color: grey;
        }
        </style>
</head>
<body>
    <?php
    include("navigation.php");
    ?>
    <section id="bookings">
    <h2>Your Bookings</h2>
    <table>
        <thead>
            <th>Name</th>
            <th>Movie Title</th>
            <th>Seats</th>
            <th>Selected Seats</th>
            <th>Price</th>
        </thead>
        <tbody>
        <?php
        include('connection.php');
        $select_bookings = mysqli_query($conn, "SELECT bookings.id, bookings.user_id, user.email, user.name AS user_name, bookings.movie_id, nowshowing.title AS movie_title, bookings.seats, bookings.selectedSeats, bookings.price
            FROM bookings
            INNER JOIN user ON user.id = bookings.user_id
            INNER JOIN nowshowing ON nowshowing.id = bookings.movie_id
            ") or die('Query failed');

        $loggedInUserEmail = $_SESSION['uemail'];

        if(mysqli_num_rows($select_bookings) > 0) {
            while($fetch_booking = mysqli_fetch_assoc($select_bookings)) {
                if ($loggedInUserEmail == $fetch_booking['email']) {
    ?>
                <tr>
                    <td><?php echo $fetch_booking['user_name']; ?></td>
                    <td><?php echo $fetch_booking['movie_title']; ?></td>
                    <td><?php echo $fetch_booking['seats']; ?></td>
                    <td><?php echo $fetch_booking['selectedSeats']; ?></td>
                    <td><?php echo $fetch_booking['price']; ?></td>
                </tr>
        <?php
                }
            }    
        }
    ?>


        </tbody>
    </table>
</body>
</html>




