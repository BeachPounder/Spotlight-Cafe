<?php
include('partials/menu.php');

// SQL query to get all history data
$sql = "SELECT h.*, e.name AS employee_name FROM tbl_history_employees h 
        JOIN tbl_employee e ON h.employee_id = e.id 
        ORDER BY h.update_date DESC";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result === false) {
    die("Error: " . mysqli_error($conn));
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Employee Update History</h1>
        <br><br>
        <a class="btn-secondary" href="manage-employee.php">Back to Employee List</a>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Field Updated</th>
                <th>Old Value</th>
                <th>New Value</th>
                <th>Update Date</th>
                <th>Updated By</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["employee_name"] . "</td>";
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

<?php include('partials/footer.php'); ?>
