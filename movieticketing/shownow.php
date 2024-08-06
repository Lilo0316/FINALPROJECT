<?php

include('connection.php');

if(isset($_GET['delete'])) {
    $remove_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `bookings` WHERE movie_id='$remove_id'") or die('Failed to delete related bookings');
    mysqli_query($conn, "DELETE FROM `nowshowing` WHERE id='$remove_id'") or die('Failed to delete movie');
    header('Location: nowshowingform.php');
}
if(isset($_POST['update_movie'])) {
    $update_id = $_POST['movie_id'];
    $update_title = $_POST['title'];
    if(isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $uploaded_file = $upload_dir . basename($_FILES['image_url']['name']);
        if(move_uploaded_file($_FILES['image_url']['tmp_name'], $uploaded_file)) {
            $update_image_url = $uploaded_file;
        }
    }
    
    mysqli_query($conn, "UPDATE `nowshowing` SET title='$update_title', image_url='$update_image_url' WHERE id='$update_id'") or die('Query failed');
    $message[] = 'Movie updated successfully.';
}

?>

<html>
<head>
<link href="css/shownow.css" rel="stylesheet">
</head>
<body>
<section id="bookings">
    <h2>MANAGE NOW SHOWING MOVIES</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select_movie = mysqli_query($conn, "SELECT * FROM nowshowing") or die('Query failed');
            if(mysqli_num_rows($select_movie) > 0) {
                while($fetch_movie = mysqli_fetch_assoc($select_movie)) {
            ?>
            <tr>
                <td><?php echo $fetch_movie['id']?></td>
                <td><?php echo $fetch_movie['title']?></td>
                <td><img src="<?php echo $fetch_movie['image_url']?>" alt="movie image"></td>
                <td>
                    <a href="shownow.php?delete=<?php echo $fetch_movie['id']?>" class="delete-btn" 
                    onclick="return confirm('Remove movie from nowshowing?');">Delete</a>
                </td>
                <td>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="movie_id" value="<?php echo $fetch_movie['id']; ?>">
                        <input type="hidden" name="current_image_url" value="<?php echo $fetch_movie['image_url']; ?>">
                        <input type="text" name="title" value="<?php echo $fetch_movie['title']; ?>">
                        <input type="file" name="image_url">
                        <input type="submit" name="update_movie" value="Update">
                    </form>
                </td>
            </tr>
            <?php
                }    
            }
            ?>
        </tbody>
    </table>
</section>
</body>
</html>