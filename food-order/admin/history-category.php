<?php
include('partials/menu.php');

// Check if session is not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Category Update History</h1>
        <a class='btn-secondary' href='manage-category.php'>Back to Category List</a>
        <br /><br />

        <?php
        // Include database connection
        include('../config/constants.php');

        // Check database connection
        if (!$conn) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM tbl_history_category ORDER BY update_date DESC";
        $res = mysqli_query($conn, $sql);

        // Check SQL query execution
        if ($res == false) {
            die("SQL query failed: " . mysqli_error($conn));
        }

        $count = mysqli_num_rows($res);

        if ($count > 0) {
            ?>
            <table class="tbl-full">
                <tr>
                    <th>ID</th>
                    <th>Category ID</th>
                    <th>Field Updated</th>
                    <th>Old Value</th>
                    <th>New Value</th>
                    <th>Update Date</th>
                    <th>Updated By</th>
                </tr>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['category_id']; ?></td>
                    <td><?php echo $row['field_updated']; ?></td>
                    <td><?php echo $row['old_value']; ?></td>
                    <td><?php echo $row['new_value']; ?></td>
                    <td><?php echo $row['update_date']; ?></td>
                    <td><?php echo $row['updated_by']; ?></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        } else {
            echo "<div class='error'>No updates found.</div>";
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
