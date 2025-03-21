<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Order Update History</h1>
        <a class="btn-secondary" href="manage-order.php">Back to Order List</a>

        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Order ID</th>
                <th>Field Updated</th>
                <th>Old Value</th>
                <th>New Value</th>
                <th>Update Date</th>
                <th>Updated By</th>
            </tr>

            <?php
                // Query to get all records from tbl_history_order
                $sql = "SELECT * FROM tbl_history_order ORDER BY update_date DESC";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                $sn = 1; // Serial Number

                if($count > 0) {
                    // History records available
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $order_id = $row['order_id'];
                        $field_updated = $row['field_updated'];
                        $old_value = $row['old_value'];
                        $new_value = $row['new_value'];
                        $update_date = $row['update_date'];
                        $updated_by = $row['updated_by'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo htmlspecialchars($order_id); ?></td>
                            <td><?php echo htmlspecialchars($field_updated); ?></td>
                            <td><?php echo htmlspecialchars($old_value); ?></td>
                            <td><?php echo htmlspecialchars($new_value); ?></td>
                            <td><?php echo htmlspecialchars($update_date); ?></td>
                            <td><?php echo htmlspecialchars($updated_by); ?></td>
                        </tr>

                        <?php
                    }
                } else {
                    // No history records found
                    echo "<tr><td colspan='7' class='error'>No history records found.</td></tr>";
                }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
