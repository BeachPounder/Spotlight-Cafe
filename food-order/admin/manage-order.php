<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Orders</h1>

        <br /><br />

        <?php
            if(isset($_SESSION['order'])) {
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
        ?>
        <a href="<?php echo SITEURL; ?>admin/add-order.php" class="btn-primary">Add Order</a>
        <a href="<?php echo SITEURL; ?>admin/history-order.php" class="btn-primary">Update Order Log</a>


        <br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
                // Get all orders from database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                $sn = 1; // Create a Serial Number and set its initial value as 1

                if($count > 0) {
                    // Orders Available
                    while($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td>₱<?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td>₱<?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <?php 
                                    if($status == "Ordered") {
                                        echo "<label style='color: blue;'>$status</label>";
                                    } elseif($status == "On Delivery") {
                                        echo "<label style='color: orange;'>$status</label>";
                                    } elseif($status == "Delivered") {
                                        echo "<label style='color: green;'>$status</label>";
                                    } elseif($status == "Cancelled") {
                                        echo "<label style='color: red;'>$status</label>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn btn-secondary">Update Order</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete Order</a>
                            </td>
                        </tr>

                        <?php
                    }
                } else {
                    // Orders not Available
                    echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                }
            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
