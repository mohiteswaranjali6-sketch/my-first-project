<?php
include('connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Prevent SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Check admin credentials
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Store session variables
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $row['username'];

        // Redirect to the admin dashboard
        header("Location: admin_dashboard.php");
        exit(); 

    } else {
        echo "<h1>Login failed. Invalid username or password.</h1>";
    }
}
?>