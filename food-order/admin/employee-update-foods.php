<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "food-order";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $updated_by = "Employee"; // You can dynamically set this based on the logged-in user

    // Get old values
    $stmt = $conn->prepare("SELECT * FROM tbl_food WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res_old = $stmt->get_result();
    $row_old = $res_old->fetch_assoc();

    // Update the food item
    $stmt = $conn->prepare("UPDATE tbl_food SET title=?, description=?, price=? WHERE id=?");
    $stmt->bind_param("ssdi", $title, $description, $price, $id);
    if ($stmt->execute()) {
        $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";

        // Prepare the log insertion statement
        $stmt_log = $conn->prepare("INSERT INTO tbl_history_foods (food_id, field_updated, old_value, new_value, update_date, updated_by) 
                                    VALUES (?, ?, ?, ?, NOW(), ?)");

        // Bind parameters for logging
        $stmt_log->bind_param("issss", $id, $field, $old_value, $new_value, $updated_by);

        // Log changes to history
        $fields = ['title' => $title, 'description' => $description, 'price' => $price];
        foreach ($fields as $field => $new_value) {
            if ($row_old[$field] != $new_value) {
                $old_value = $row_old[$field];
                $stmt_log->execute();
            }
        }

        header('location: page1.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
    }
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM tbl_food WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows == 1) {
        $row = $res->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
    } else {
        header('location: page1.php');
    }
} else {
    header('location: page1.php');
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Food</title>
    <link rel="stylesheet" href="../css/employee.css">
</head>
<body>
    <div class="container">
        <h1>Update Food</h1>

        <?php 
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($price); ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
            <input type="submit" name="submit" value="Update Food" class="btn-primary">
        </form>
        <br>
        <a class='btn-secondary' href='page1.php'>Back to Food List</a>
    </div>
</body>
</html>
