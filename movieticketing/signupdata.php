<?php

$name = $email = $address = $contact = $Password = $error = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $Password = $_POST['Password'];
   
   
}


include("connection.php");

//Query to database
$sql = "INSERT INTO user(name, email, address, contact , Password) VALUES('$name','$email', '$address','$contact','$Password')";

$result = $conn->query($sql);

if($result === TRUE){
 header("location: nlogin.php");
exit;

    echo "Your account is created";
}
else{
    echo "Your account cannot be created";
}

$conn ->close();