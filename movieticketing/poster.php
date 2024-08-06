
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOW SHOWING</title>
    <link href="css/poster.css" rel="stylesheet">
</head>
<body>
    <div class="headline">
        <div class="head">
            <h1>NOW SHOWING</h1>
        </div>
    </div>
    <div class="container">
        <?php
        include('connection.php');
        $query = "SELECT * FROM nowshowing";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="movie-poster">';
            echo '<img src="' . $row['image_url'] . '" alt="' . $row['title'] . '">';
            echo '<div class="movie-title">' . $row['title'] . '</div>';
            echo '<div class="overlay">';
            echo '<a href="booknow.php?id=' . $row['id'] . '"><button class="book-now">Book Now</button></a>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        
    </div>
    <div class="headline">
        <div class="head">
            <h1>COMING SOON</h1>
        </div>
    </div>
    <div class="container">
        <?php
       include('connection.php');
        $query = "SELECT * FROM comingsoon";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="movie-poster">';
            echo '<img src="' . $row['image_url'] . '" alt="' . $row['title'] . '">';
            echo '<div class="movie-title">' . $row['title'] . '</div>';
            echo '<div class="overlay">';
            echo '<button class="coming-soon">Coming Soon</button>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    </div>

</body>
</html>
