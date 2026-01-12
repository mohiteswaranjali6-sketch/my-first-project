<?php
include('connection.php');

session_start();
if (isset($_SESSION['message'])) {
    echo "<div class='message {$_SESSION['message_type']}'>{$_SESSION['message']}</div>";
    unset($_SESSION['message']); // Clear message after displaying
}

// Fetch movies from the database
$sql = "SELECT * FROM movies ORDER BY release_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Movies - Admin Panel</title>
    <link rel="stylesheet" href="view_movies.css">
    <style>
        .movie-poster {
            width: 80px;
            height: 100px;
            object-fit: cover;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 2px solid black;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            border:1px solid black;
        }
        th {
            background-color:rgb(239, 243, 207);
            text-decoration-color: black;
        }
        .edit-form input {
            width: 100px;
            padding: 5px;
        }
        .edit-form input[type="submit"] {
            cursor: pointer;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            font-weight: bold;
        }
        .delete-btn {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="color:brown">Movie List</h2>
        <a href="add_movie.html" class="link">Add New Movie</a>
        <table>
            <tr>
                <th>Poster</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Duration</th>
                <th>Release Date</th>
                <th>Language</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <form action="update_movie.php" method="post" class="edit-form">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <td><img src="../<?php echo $row['poster']; ?>" alt="Poster" class="movie-poster"></td>
                        <td><input type="text" name="title" value="<?php echo $row['title']; ?>"></td>
                        <td><input type="text" name="genre" value="<?php echo $row['genre']; ?>"></td>
                        <td><input type="number" name="duration" value="<?php echo $row['duration']; ?>"></td>
                        <td><input type="date" name="release_date" value="<?php echo $row['release_date']; ?>"></td>
                        <td><input type="text" name="language" value="<?php echo $row['language']; ?>"></td>
                        <td>
                            <input type="submit" value="Update">
                            <a href="delete_movie.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this movie?');">Delete</a>
                        </td>
                    </form>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>