<?php
include('connection.php');
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.html");
    exit();
}


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

    $sql = "INSERT INTO movies (title, genre, duration, release_date, language, poster) 
            VALUES ('$title', '$genre', '$duration', '$release_date', '$language', '$poster')";

    if (mysqli_query($conn, $sql)) {
        echo "Movie added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie - Admin Panel</title>
    <link rel="stylesheet" href="add_movie.css">
</head>
<body>
    <div class="container">
        <h1 style="color:crimson">Admin Dashboard</h1>
        <h3 style="font-style: italic; color:blueviolet">Add Movie</h3>
        <form action="add_movie.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Movie Title" required>
            <input type="text" name="genre" placeholder="Genre" required>
            <input type="number" name="duration" placeholder="Duration (minutes)" required>
            <input type="date" name="release_date" required>
            <input type="text" name="language" placeholder="Language" required>
            <input type="file" name="poster" required>
            <button type="submit">Add Movie</button>
        </form>
        <a href="view_movies.php" class="link">View Movies</a>
    </div>
</body>
</html>