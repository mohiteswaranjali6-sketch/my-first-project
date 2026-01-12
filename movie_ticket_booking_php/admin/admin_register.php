<?php
$servername="localhost";
$username="root";
$password= "";
$dbname="movie_ticket_booking_system_php";
$port=3306;

$conn=new mysqli($servername,$username,$password,$dbname,$port);
if($conn->connect_error){
die("Connection failed:". $conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO admin(username,email,password)VALUES('$username','$email','$password')";

    if($conn->query($sql)===TRUE){
        echo "Registration successful";
    }
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>