<?php
// Database connection credentials
$servername = "localhost";
$username = "root"; // Replace with your actual MySQL username
$password = ""; // Replace with your actual MySQL password
$dbname = "food-order";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $_POST['total'];
    $order_date = $_POST['order_date'];
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];

    // Insert query
    $sql = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address) VALUES ('$food', '$price', '$qty', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

    if ($conn->query($sql) === TRUE) {
        echo "New order added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Order</title>
    <link rel="stylesheet" href="../css/employee.css">
</head>
<body>
    <div class="container">
        <h1>Add New Order</h1>
        <form action="add-order.php" method="post">
            <div class="form-group">
                <label for="food">Food:</label>
                <input type="text" name="food" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" required>
            </div>
            <div class="form-group">
                <label for="qty">Quantity:</label>
                <input type="number" name="qty" required>
            </div>
            <div class="form-group">
                <label for="total">Total:</label>
                <input type="number" step="0.01" name="total" required>
            </div>
            <div class="form-group">
                <label for="order_date">Order Date:</label>
                <input type="datetime-local" name="order_date" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" name="status" required>
            </div>
            <div class="form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" name="customer_name" required>
            </div>
            <div class="form-group">
                <label for="customer_contact">Customer Contact:</label>
                <input type="text" name="customer_contact" required>
            </div>
            <div class="form-group">
                <label for="customer_email">Customer Email:</label>
                <input type="email" name="customer_email" required>
            </div>
            <div class="form-group">
                <label for="customer_address">Customer Address:</label>
                <textarea name="customer_address" required></textarea>
            </div>
            <input type="submit" value="Add Order">
            <a class='btn-secondary' href='page2.php?id={$row['id']}'>Back to Order List</a>
        </form>
    </div>
</body>
</html>
