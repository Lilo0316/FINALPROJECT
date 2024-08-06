<?php
include('connection.php');

if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $check_bookings_query = "SELECT id FROM bookings WHERE user_id='$delete_id'";
    $check_result = mysqli_query($conn, $check_bookings_query);
    if(!$check_result) {
        die('Error checking bookings: ' . mysqli_error($conn));
    }
    $booking_ids = array();

    while($row = mysqli_fetch_assoc($check_result)) {
        $booking_ids[] = $row['id'];
    }
    foreach($booking_ids as $booking_id) {
        $delete_booking_query = "DELETE FROM bookings WHERE id='$booking_id'";
        $delete_booking_result = mysqli_query($conn, $delete_booking_query);
        if(!$delete_booking_result) {
            die('Failed to delete booking with ID ' . $booking_id . ': ' . mysqli_error($conn));
        }
    }
    $delete_user_query = "DELETE FROM user WHERE id='$delete_id'";
    $delete_user_result = mysqli_query($conn, $delete_user_query);
    
    if($delete_user_result) {
        header('Location: shu.php'); 
        exit();
    } else {
        die('Failed to delete user: ' . mysqli_error($conn));
    }
}
?>
<html>
<head>
<link href="css/shu.css" rel="stylesheet">
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this user and all their bookings?');
        }
    </script>
</head>
<body>
    <?php include("adnav.php"); ?>
    
    <section id="users">
        <h2>Manage Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $select_users = mysqli_query($conn, "SELECT * FROM user") or die('Query failed');
                    if(mysqli_num_rows($select_users) > 0) {
                        while($fetch_user = mysqli_fetch_assoc($select_users)) {
                ?>
                            <tr>
                                <td><?php echo $fetch_user['id']?></td>
                                <td><?php echo $fetch_user['name']?></td>
                                <td><?php echo $fetch_user['email']?></td>
                                <td><?php echo $fetch_user['address']?></td>
                                <td>
                                    <a href="shu.php?delete=<?php echo $fetch_user['id']?>" class="delete-btn" 
                                    onclick="return confirmDelete();">Delete</a>
                                </td>
                            </tr>
                <?php
                        }    
                    } else {
                        echo "<tr><td colspan='4'>No users found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </section>
    
</body>
</html>

