<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "food-order";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
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
    $updated_by = 'Employee'; // This should be dynamic based on logged-in user

    // Fetch old values
    $sql = "SELECT * FROM tbl_order WHERE id = $id";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();

    $fields = [
        'food' => $food,
        'price' => $price,
        'qty' => $qty,
        'total' => $total,
        'order_date' => $order_date,
        'status' => $status,
        'customer_name' => $customer_name,
        'customer_contact' => $customer_contact,
        'customer_email' => $customer_email,
        'customer_address' => $customer_address
    ];

    foreach ($fields as $field => $new_value) {
        $old_value = $row[$field];
        if ($old_value != $new_value) {
            $update_date = date('Y-m-d H:i:s');
            $sql_log = "INSERT INTO tbl_history (order_id, field_updated, old_value, new_value, update_date, updated_by)
                        VALUES ($id, '$field', '$old_value', '$new_value', '$update_date', '$updated_by')";
            $conn->query($sql_log);
        }
    }

    $sql = "UPDATE tbl_order SET 
                food = '$food', 
                price = '$price', 
                qty = '$qty', 
                total = '$total', 
                order_date = '$order_date', 
                status = '$status', 
                customer_name = '$customer_name', 
                customer_contact = '$customer_contact', 
                customer_email = '$customer_email', 
                customer_address = '$customer_address'
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header('Location: manage-order.php');
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbl_order WHERE id = $id";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Order</title>
    <link rel="stylesheet" href="../css/employee.css">
</head>
<body>
    <div class="container">
        <h1>Update Order</h1>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="food">Food</label>
                <input type="text" name="food" value="<?php echo $row['food']; ?>">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" value="<?php echo $row['price']; ?>">
            </div>
            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" name="qty" value="<?php echo $row['qty']; ?>">
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" name="total" value="<?php echo $row['total']; ?>">
            </div>
            <div class="form-group">
                <label for="order_date">Order Date</label>
                <input type="datetime-local" name="order_date" value="<?php echo date('Y-m-d\TH:i', strtotime($row['order_date'])); ?>">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <input type="text" name="status" value="<?php echo $row['status']; ?>">
            </div>
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" name="customer_name" value="<?php echo $row['customer_name']; ?>">
            </div>
            <div class="form-group">
                <label for="customer_contact">Customer Contact</label>
                <input type="text" name="customer_contact" value="<?php echo $row['customer_contact']; ?>">
            </div>
            <div class="form-group">
                <label for="customer_email">Customer Email</label>
                <input type="text" name="customer_email" value="<?php echo $row['customer_email']; ?>">
            </div>
            <div class="form-group">
                <label for="customer_address">Customer Address</label>
                <input type="text" name="customer_address" value="<?php echo $row['customer_address']; ?>">
            </div>
            <input type="submit" value="Update">
            <a href="page2.php" class="btn-secondary">Back to Order List</a>
        </form>
    </div>
</body>
</html>
