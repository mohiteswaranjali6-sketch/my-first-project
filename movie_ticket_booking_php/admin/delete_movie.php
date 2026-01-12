<?php
include('connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete movie from database
    $sql = "DELETE FROM movies WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_movies.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>