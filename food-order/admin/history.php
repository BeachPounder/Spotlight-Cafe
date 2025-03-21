<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "food-order";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_history ORDER BY update_date DESC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Update History</title>
    <link rel="stylesheet" href="../css/employee.css">
</head>
<body>
    <div class="container">
        <h1>Order Update History</h1>
        <a class='btn-secondary' href='page2.php'>Back To Order List</a>
        <table>
            <tr>
                <th>Order ID</th>
                <th>Field Updated</th>
                <th>Old Value</th>
                <th>New Value</th>
                <th>Update Date</th>
                <th>Updated By</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["order_id"] . "</td>";
                    echo "<td>" . $row["field_updated"] . "</td>";
                    echo "<td>" . $row["old_value"] . "</td>";
                    echo "<td>" . $row["new_value"] . "</td>";
                    echo "<td>" . $row["update_date"] . "</td>";
                    echo "<td>" . $row["updated_by"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No history found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
