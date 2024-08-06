<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <link href="css/nowshowingform.css" rel="stylesheet">
</head>
<body>
    <?php include("adnav.php"); ?>

    <div class="content-section">
        
    <h1>ADD NOW SHOWING MOVIE</h1>
    <form action="add_movie.php" method="post" autocomplete="off" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        
        <label for="image_url">Image URL:</label>
        <input type="file" id="image_url" accept=".jpg, .jpeg, .png" name="image_url" required>
        
        <input type="submit" name="submit" value="Submit">
    </form>
        <div class="content-item">
            <?php include("comingsoonform.php"); ?>
        </div>
        <div class="content-item">
            <?php include("slideform.php"); ?>
        </div>
        <div class="content-item">
            <?php include("shownow.php"); ?>
        </div>
        <div class="content-item">
            <?php include("showcoming.php"); ?>
        </div>
    </div>
</body>
</html>