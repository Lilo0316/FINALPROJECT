<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0D0E30;
            margin: 0;
            padding: 0;
            color: #fff; 
        }
        </style>
</head>
<body>
    <h1>ADD FOR SLIDESHOW</h1>
    <form action="slidemovie.php" method="post" autocomplete="off" enctype="multipart/form-data">
        
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="synopsis">Synopsis:</label><br>
        <input type="text" id="synopsis" name="synopsis" required><br>
        <label for="image_url">Image URL:</label><br>
        <input type="file" id="image_url" accept=".jpg, .jpeg, .png" name="image_url" required><br>
    <input type="submit" name="submit" value="Submit">
</form>

    

</body>
</html>
