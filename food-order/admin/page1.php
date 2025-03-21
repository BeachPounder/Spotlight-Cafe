<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "food-order";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_food";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Food List</title>
    <link rel="stylesheet" href="../css/employee.css">
</head>
<body>
    <div class="container">
        <h1>Food List</h1>
        <a class='btn-secondary' href='employee-dashboard.php?id={$row['id']}'>Back to Employee Board</a>
        <a class='btn-secondary' href='employee-add-foods.php'>Add Food</a>
        <a class='btn-secondary' href='history-foods.php?id={$row['id']}'>History Food</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>";
                    echo "<a href='employee-update-foods.php?id=" . $row["id"] . "' class='btn-secondary'>Update</a> ";
                    echo "<a href='employee-delete-foods.php?id=" . $row["id"] . "' class='btn-danger'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No foods found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
