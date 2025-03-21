<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "food-order";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT h.*, f.title FROM tbl_history_foods h 
        JOIN tbl_food f ON h.food_id = f.id 
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
    <title>Update History</title>
    <link rel="stylesheet" href="../css/employee.css">
</head>
<body>
    <div class="container">
        <h1>Food Update History</h1>
        <a class='btn-secondary' href='page1.php'>Back to Food List</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Food Title</th>
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
                    echo "<td>" . $row["title"] . "</td>";
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
</body>
</html>
