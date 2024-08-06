<?php
include('connection.php');

if (isset($_GET['movie_id']) && isset($_GET['showtime'])) {
    $movie_id = intval($_GET['movie_id']);
    $show_time = $_GET['showtime']; 
    
    $query = "SELECT selectedSeats FROM bookings WHERE movie_id = ? AND showtime = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $movie_id, $show_time);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $bookedSeats = [];
    while ($row = $result->fetch_assoc()) {
        $seats = explode(',', $row['selectedSeats']);
        $bookedSeats = array_merge($bookedSeats, $seats);
    }
    
    $stmt->close();
    $conn->close();
    
    echo implode(',', $bookedSeats);
} else {
    echo ''; 
}
?>
