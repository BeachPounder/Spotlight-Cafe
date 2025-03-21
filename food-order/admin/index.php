<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">DASHBOARD</h1>
        <br>
        <?php
        if (isset($_SESSION['login'])) {
            echo '<div class="success">' . $_SESSION['login'] . '</div>';
            unset($_SESSION['login']);
        }
        ?>
        <br><br>

        <div class="dashboard-box">
            <div class="col-4 text-center rounded-square">
                <?php
                // Count categories
                $sql_categories = "SELECT * FROM tbl_category";
                $res_categories = mysqli_query($conn, $sql_categories);
                $count_categories = mysqli_num_rows($res_categories);
                ?>
                <h1><?php echo $count_categories; ?></h1>
                <p>Categories</p>
            </div>

            <div class="col-4 text-center rounded-square">
                <?php
                // Count foods
                $sql_foods = "SELECT * FROM tbl_food";
                $res_foods = mysqli_query($conn, $sql_foods);
                $count_foods = mysqli_num_rows($res_foods);
                ?>
                <h1><?php echo $count_foods; ?></h1>
                <p>Foods</p>
            </div>

            <div class="col-4 text-center rounded-square">
                <?php
                // Count total orders
                $sql_orders = "SELECT * FROM tbl_order";
                $res_orders = mysqli_query($conn, $sql_orders);
                $count_orders = mysqli_num_rows($res_orders);
                ?>
                <h1><?php echo $count_orders; ?></h1>
                <p>Total Orders</p>
            </div>

            <div class="col-4 text-center rounded-square">
                <?php
                // Calculate revenue generated
                $sql_revenue = "SELECT SUM(total) AS total_revenue FROM tbl_order WHERE status='Delivered'";
                $res_revenue = mysqli_query($conn, $sql_revenue);
                $row_revenue = mysqli_fetch_assoc($res_revenue);
                $total_revenue = $row_revenue['total_revenue'];
                ?>
                <h1><?php echo '$' . number_format($total_revenue, 2); ?></h1>
                <p>Revenue Generated</p>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<br><br><br><br>
<?php include('partials/footer.php'); ?>
