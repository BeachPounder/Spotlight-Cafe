<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update Order</h1>

        <br><br>

        <?php
            // Check whether id is set or not
            if(isset($_GET['id'])) {
                $id = $_GET['id'];

                // Get order details based on ID
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1) {
                    // Get the details
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                } else {
                    // Redirect to manage order page with error message
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            } else {
                // Redirect to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="table-full">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo htmlspecialchars($food); ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><b>₱<?php echo htmlspecialchars($price); ?></b></td>
                </tr>

                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo htmlspecialchars($qty); ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status == "Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status == "On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status == "Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status == "Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo htmlspecialchars($customer_name); ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo htmlspecialchars($customer_contact); ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo htmlspecialchars($customer_email); ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo htmlspecialchars($customer_address); ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($price); ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])) {
                // Get all the values from the form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                // Get the old values for history tracking
                $sql_old = "SELECT * FROM tbl_order WHERE id=$id";
                $res_old = mysqli_query($conn, $sql_old);
                $old_row = mysqli_fetch_assoc($res_old);

                // Update the order
                $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true) {
                    // Track changes in the history table
                    $fields = ['qty', 'total', 'status', 'customer_name', 'customer_contact', 'customer_email', 'customer_address'];
                    foreach ($fields as $field) {
                        if ($old_row[$field] != $_POST[$field]) {
                            $sql_history = "INSERT INTO tbl_history_order (order_id, field_updated, old_value, new_value, update_date, updated_by) VALUES (
                                $id,
                                '$field',
                                '" . mysqli_real_escape_string($conn, $old_row[$field]) . "',
                                '" . mysqli_real_escape_string($conn, $_POST[$field]) . "',
                                NOW(),
                                '" . mysqli_real_escape_string($conn, $_SESSION['user']) . "'
                            )";
                            mysqli_query($conn, $sql_history);
                        }
                    }

                    $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
