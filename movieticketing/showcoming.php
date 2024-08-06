
<?php

include('connection.php');
if(isset($_GET['delete']))
{
    $remove_id=$_GET['delete'];
    mysqli_query($conn, "DELETE FROM `comingsoon` WHERE id='$remove_id'") or die('');
    header('Location: nowshowingform.php');
}
?>
<html>
<head>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color: #0D0E30;
        }
        h2 {
            color:white;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color:white;
        }

        th {
            background-color: #f2f2f2;
            color: black;
        }

        
        tr:hover {
            background-color: grey;
        }
    </style>
</head>
<body>
   
    
<section id="bookings">
    <h2>MANAGE COMING SOON MOVIES</h2>
    <table>
    <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select_movie = mysqli_query($conn, "SELECT *
                    FROM comingsoon") or die('Query failed');

                if(mysqli_num_rows($select_movie) > 0) {
                    while($fetch_movie = mysqli_fetch_assoc($select_movie)) {
            ?>
                        <tr>
                            <td><?php echo $fetch_movie['id']?></td>
                            <td><?php echo $fetch_movie['title']?></td>
                            <td><?php echo $fetch_movie['image_url']?></td>
                            <td><a href="showcoming.php?delete=<?php echo $fetch_movie['id']?>" class="delete-btn" 
                            onclick="return confirm('Remove movie from coming soon?');">Delete</a></td>
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
