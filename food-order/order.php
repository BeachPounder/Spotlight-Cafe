<?php include('partials-front/menu.php'); ?>

<?php

if(isset($_GET['food_id']))
{
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count == 1)
    {
        $row = mysqli_fetch_array($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else
    {
        header('location:'.SITEURL);
    }
}
else
{
    header('location:'.SITEURL);
}
?>

<!-- Food Search Section Starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if($image_name == "")
                    {
                        echo "<div class='error'>Image not Available.</div>";
                    }
                    else
                    {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Food Image" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">

                    <p class="food-price">₱<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>

                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required
                pattern="^[A-Za-z\s]+$" title="Only letters and spaces are allowed."
                onkeypress="return /^[A-Za-z\s]+$/.test(event.key)">

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. +639XXXXXXXXX" class="input-responsive" required
                pattern="^\+639\d{9}$" title="Phone number must start with +63 followed by 9 digits."
                onkeypress="return /^[0-9+]+$/.test(event.key)">

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. email@example.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>

        <?php
        if(isset($_POST['submit']))
        {
            // Get all details from the form and sanitize them
            $food = mysqli_real_escape_string($conn, $_POST['food']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $qty = mysqli_real_escape_string($conn, $_POST['qty']);
            $total = $price * $qty; // Total Calculation
            $order_date = date('Y-m-d H:i:s'); // Order Date
            $status = "Ordered";  // Order Status
            $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
            $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
            $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
            $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

            // Validate phone number
            if(preg_match('/^\+639\d{9}$/', $customer_contact) === 0) {
                // Invalid phone number
                $_SESSION['order'] = "<div class='error text-center'>Invalid phone number. It must start with +639 followed by 9 digits.</div>";
                header('location:'.SITEURL.'order.php?food_id='.$food_id);
                exit();
            }

            // SQL Query to save the order in the database
            $sql2 = "INSERT INTO tbl_order SET
                food = '$food', 
                price = $price, 
                qty = $qty, 
                total = $total, 
                order_date = '$order_date', 
                status = '$status', 
                customer_name = '$customer_name', 
                customer_contact = '$customer_contact', 
                customer_email = '$customer_email', 
                customer_address = '$customer_address'
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true)
            {
                // Order Successful
                $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                header('location:'.SITEURL);
            }
            else
            {
                // Failed to order food
                $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food. Please try again later.</div>";
                header('location:'.SITEURL);
            }
        }
        ?>

    </div>
</section>
<!-- Food Search Section Ends Here -->

<?php include('partials-front/footer.php'); ?>
