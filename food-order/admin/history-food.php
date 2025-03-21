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

$sql = "SELECT h.*, f.title FROM tbl_history_food h 
        JOIN tbl_food f ON h.food_id = f.id 
        ORDER BY h.update_date DESC";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error: " . $conn->error);
}

$conn->close();
?>

<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Food Update History</h1>
        <a class='btn-secondary' href='manage-food.php'>Back to Food List</a>

        <table class="tbl-full">
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
                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["field_updated"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["old_value"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["new_value"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["update_date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["updated_by"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No history found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
