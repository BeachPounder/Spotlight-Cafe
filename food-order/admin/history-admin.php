<?php include('partials/menu.php'); ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "food-order";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT h.*, a.username FROM tbl_history_admins h 
        JOIN tbl_admin a ON h.admin_id = a.id 
        ORDER BY h.update_date DESC";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Update History</title>
    <link rel="stylesheet" href="../css/employee.css">
</head>
<body>
    <div class="main-content">
        <div class="wrapper">
            <h1>Admin Update History</h1>
            <a class='btn-secondary' href='manage-admin.php'>Back to Admin List</a>

            <table class="history-table">
                <tr>
                    <th>ID</th>
                    <th>Admin Username</th>
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
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["field_updated"] . "</td>";
                        echo "<td>" . $row["old_value"] . "</td>";
                        echo "<td>" . $row["new_value"] . "</td>";
                        echo "<td>" . $row["update_date"] . "</td>";
                        echo "<td>" . $row["updated_by"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No history found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>

<?php include('partials/footer.php'); ?>
