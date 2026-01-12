<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $duration = $_POST['duration'];
    $release_date = $_POST['release_date'];
    $language = $_POST['language'];

    // Handle file upload
    $target_dir = "uploads/";
    $poster = $target_dir . basename($_FILES["poster"]["name"]);
    move_uploaded_file($_FILES["poster"]["tmp_name"], $poster);

    $sql = "INSERT INTO movies (title, genre, duration, relese_date, language, poster) 
            VALUES ('$title', '$genre', '$duration', '$release_date', '$language', '$poster')";

    if (mysqli_query($conn, $sql)) {
        echo "Movie added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>