<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert Data
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    $sql = "INSERT INTO students (name, email, phone, course) VALUES ('$name', '$email', '$phone', '$course')";
    $conn->query($sql);
    header("Location: crud.php");
}

// Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET name='$name', email='$email', phone='$phone', course='$course' WHERE id=$id";
    $conn->query($sql);
    header("Location: crud.php");
}

// Delete Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM students WHERE id=$id";
    $conn->query($sql);
    header("Location: crud.php");
}

// Fetch Data for Update
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM students WHERE id=$id");
    $editData = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD operation</title>
    <link rel = "stylesheet" type = "text/css" href = "CRUD.css"> 
</head>
<div class="design">
<body>
    <h2>PHP CRUD Operation </h2>

    <!-- Form for Add / Update -->
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">
        
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $editData['name'] ?? ''; ?>" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $editData['email'] ?? ''; ?>" required><br>
        
        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $editData['phone'] ?? ''; ?>" required><br>
        
        <label>Course:</label>
        <input type="text" name="course" value="<?php echo $editData['course'] ?? ''; ?>" required><br><br>

        <?php if ($editData): ?>
            <input type="submit" name="update" value="Update Student">
        <?php else: ?>
            <input type="submit" name="add" value="Add Student" class="btn">
        <?php endif; ?>
    </form>

    <hr>

    <!-- Display Records -->
     <div class="design1">
    <h3>Student Records</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
        </div>
        <?php
        $result = $conn->query("SELECT * FROM students");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["phone"]; ?></td>
            <td><?php echo $row["course"]; ?></td>
            <td>
                <a href="crud.php?edit=<?php echo $row["id"]; ?>">Edit</a> |
                <a href="crud.php?delete=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        
        <?php endwhile; ?>
    </table>
    </div>
</body>
</html>
