<?php
include('connection.php');


$sql = "SELECT selectedSeats FROM bookings";
$result = $conn->query($sql);

$bookedSeats = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($bookedSeats, $row["selectedSeats"]);
    }
}

$conn->close();

echo json_encode(array("selectedSeats" => $bookedSeats));
?>
