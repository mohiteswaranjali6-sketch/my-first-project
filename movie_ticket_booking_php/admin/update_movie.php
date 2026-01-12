<?php
include('connection.php');
session_start(); // Start the session to store messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $duration = (int)$_POST['duration'];
    $release_date = $_POST['release_date'];
    $language = mysqli_real_escape_string($conn, $_POST['language']);

    $sql = "UPDATE movies SET title='$title', genre='$genre', duration='$duration', release_date='$release_date', language='$language' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Movie updated successfully!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error updating movie: " . mysqli_error($conn);
        $_SESSION['message_type'] = "error";
    }
    
    header("Location: view_movies.php");
    exit();
}

mysqli_close($conn);
?>