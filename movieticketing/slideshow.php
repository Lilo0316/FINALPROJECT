<?php
    
    if(!isset($_COOKIE['uemail']))
    {
        header('location: nlogin.php');
        die();
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> movie ticket booking</title>
    <style>
       body, html {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    height: 100%;
    width: 100%;
}

.slideshow {
    position: relative;
    overflow: hidden;
    width: 100%; 
    height: 100vh; 
}

.slides {
    display: flex;
    transition: transform 5s ease;
    width: 100%;
    height: 100%;
}

.slide {
    position: relative;
    flex: 0 0 100%;
    width: 100%;
    height: 100%;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: relative;
}

.synopsis {
    position: absolute;
    bottom: 50px;
    left: 50px;
    /* background-color: linear-gradient(to right, #007bff, #1a73e8); */
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    z-index: 2; 
}

.synopsis h1 {
    color: white;
    font-size: 30px;
}

.synopsis p {
    color: white;
    font-size: 25px;
}

.slide::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to left, rgba(50, 50, 50, 0.1), rgb(50, 50, 50));
    z-index: 1; 
}


        


     
    </style>
</head>
<body>
 


<div class="slideshow">
        <div class="slides">
            <?php
            include("connection.php");
            $query = "SELECT * FROM slideshow";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="slide">';
                echo '<img src="' . $row['image_url'] . '" alt="' . $row['title'] . '">';
                echo '<div class="synopsis">';
                echo '<h1>' . $row['title'] . '</h1>';
                echo '<p>' . $row['synopsis'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
        

<?php
include("poster.php");
?>

<script>
    let slideIndex = 0;
    const slides = document.getElementsByClassName("slide");

    function showSlides() {
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 5000);
    }

    showSlides(); 
</script>

    
<script src="sc.js"></script>
</body>
</html>