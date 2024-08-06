<?php
include('connection.php');

if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Perform deletion of the booking
    $delete_query = "DELETE FROM bookings WHERE id='$delete_id'";
    $result = mysqli_query($conn, $delete_query);
    
    if($result) {
        header('Location: show.php'); // Redirect back to the bookings page
        exit();
    } else {
        // Debugging: Output MySQL error message if deletion fails
        die('Failed to delete booking: ' . mysqli_error($conn));
    }
}

?>
<html>
<head>
<link href="css/show.css" rel="stylesheet">
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this booking?');
        }
    </script>
</head>
<body>
    <?php include("adnav.php"); ?>
    
    <section id="bookings">
        <h2>Manage Bookings</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Movie ID</th>
                    <th>Seats</th>
                    <th>Selected Seats</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Use aliases to differentiate between bookings.id and user.id
                    $select_bookings = mysqli_query($conn, "SELECT bookings.id AS booking_id, user.id AS user_id, 
                                                            user.name, bookings.movie_id, bookings.seats, 
                                                            bookings.selectedSeats, bookings.price
                                                            FROM bookings INNER JOIN user ON user.id = bookings.user_id") or die('Query failed');
                    if(mysqli_num_rows($select_bookings) > 0) {
                        while($fetch_booking = mysqli_fetch_assoc($select_bookings)) {
                ?>
                            <tr>
                                <td><?php echo $fetch_booking['booking_id']?></td>
                                <td><?php echo $fetch_booking['user_id']?></td>
                                <td><?php echo $fetch_booking['name']?></td>
                                <td><?php echo $fetch_booking['movie_id']?></td>
                                <td><?php echo $fetch_booking['seats']?></td>
                                <td><?php echo $fetch_booking['selectedSeats']?></td>
                                <td><?php echo $fetch_booking['price']?></td>
                                <td>
                                    <a href="show.php?delete=<?php echo $fetch_booking['booking_id']?>" class="delete-btn" 
                                    onclick="return confirmDelete();">Delete</a>
                                </td>
                            </tr>
                <?php
                        }    
                    } else {
                        echo "<tr><td colspan='8'>No bookings found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </section>
    
</body>
</html>
