<?php 

 //database connection
$server = "localhost";
$user = "root";
$password = "";
$database =  "movie_db";


$conn = new mysqli($server, $user, $password, $database);
if($conn->connect_error){
die("Connection error".$conn->connect_error);
}
?>