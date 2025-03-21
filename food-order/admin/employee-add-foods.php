<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "food-order";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO tbl_food (title, description, price) VALUES ('$title', '$description', '$price')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
        header('location: page1.php');
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Food</title>
    <link rel="stylesheet" href="../css/employee.css">
</head>
<body>
    <div class="container">
        <h1>Add Food</h1>

        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <input type="submit" name="submit" value="Add Food" class="btn-primary">
        </form>
        <br>
        <a class='btn-secondary' href='page1.php'>Back to Food List</a>
    </div>
</body>
</html>
