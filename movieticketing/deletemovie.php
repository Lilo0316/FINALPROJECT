<?php
    $id=$_GET["id"];
    
    include("connection.php");
    $sql="DELETE FROM nowshowing WHERE id = $id";
    $result=$conn->query($sql);
    if($result==TRUE)
    {
        header("Location:shownow.php");
    }
    else
    {
        echo "User cannot be deleted!";
    }
    $conn->close();
    
?>