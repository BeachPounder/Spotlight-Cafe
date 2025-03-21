<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Order</h1>
        
        <br /><br />

        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food:</td>
                    <td>
                        <input type="text" name="food" placeholder="Enter Food">
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" step="0.01" placeholder="Enter Price">
                    </td>
                </tr>

                <tr>
                    <td>Quantity:</td>
                    <td>
                        <input type="number" name="qty" placeholder="Enter Quantity">
                    </td>
                </tr>

                <tr>
                    <td>Total:</td>
                    <td>
                        <input type="number" name="total" step="0.01" placeholder="Enter Total">
                    </td>
                </tr>

                <tr>
                    <td>Order Date:</td>
                    <td>
                        <input type="datetime-local" name="order_date">
                    </td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <input type="text" name="status" placeholder="Enter Status">
                    </td>
                </tr>

                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" placeholder="Enter Customer Name">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" placeholder="Enter Customer Contact">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="email" name="customer_email" placeholder="Enter Customer Email">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" placeholder="Enter Customer Address"></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Order" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])) {
                // Get all the details from the form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $_POST['total'];
                $order_date = $_POST['order_date'];
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                // SQL Query to Save the Data into Database
                $sql2 = "INSERT INTO tbl_order SET
                    food='$food',
                    price='$price',
                    qty='$qty',
                    total='$total',
                    order_date='$order_date',
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                ";

                // Execute the Query and Save in Database
                $res2 = mysqli_query($conn, $sql2);

                // Check whether the query executed successfully or not
                if($res2 == TRUE) {
                    // Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Order Added Successfully.</div>";
                    // Redirect to Manage Order Page
                    header('location:'.SITEURL.'admin/manage-order.php');
                } else {
                    // Failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Order.</div>";
                    // Redirect to Add Order Page
                    header('location:'.SITEURL.'admin/add-order.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
