<?php
include 'connection.php';


$query = "SELECT * FROM movie";
$result = mysqli_query($conn, $query);


while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="movie-poster">';
    echo '<img src="' . $row['image_url'] . '" alt="' . $row['title'] . '">';
    echo '<div class="movie-title">' . $row['title'] . '</div>';
    echo '<div class="overlay">';
    echo '<a href="book.php?id=' . $row['id'] . '"><button class="book-now">Book Now</button></a>';
    echo '</div>';
    echo '</div>';
}
?>
