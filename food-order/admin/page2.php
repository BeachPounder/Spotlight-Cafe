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

// SQL query to fetch data from tbl_order
$sql = "SELECT * FROM tbl_order";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order List</title>
    <link rel="stylesheet" href="../css/employee.css">
</head>
<body>
    <div class="container">
        <h1>Order List</h1>
        <a class='btn-secondary' href='employee-dashboard.php?id={$row['id']}'>Back to Employee Board</a>
        <a class='btn-secondary' href='employee-add-order.php?id={$row['id']}'>Add Order</a>
        <a class='btn-secondary' href='history.php?id={$row['id']}'>History Order</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['food']}</td>
                            <td>{$row['price']}</td>
                            <td>{$row['qty']}</td>
                            <td>{$row['total']}</td>
                            <td>{$row['order_date']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['customer_name']}</td>
                            <td>{$row['customer_contact']}</td>
                            <td>{$row['customer_email']}</td>
                            <td>{$row['customer_address']}</td>
                            <td>
                                <a class='btn-secondary' href='employee-update-order.php?id={$row['id']}'>Update</a>
                                <a class='btn-danger' href='employee-delete-order.php?id={$row['id']}'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No orders found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
