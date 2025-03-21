<?php
    // Include constants.php for SITEURL
    include('../config/constants.php');

    // Check whether the id is set or not
    if(isset($_GET['id']))
    {
        // Get the order ID
        $id = $_GET['id'];

        // Create SQL query to delete order
        $sql = "DELETE FROM tbl_order WHERE id=$id";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        // Check whether the query executed successfully or not
        if($res==true)
        {
            // Order deleted
            $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        else
        {
            // Failed to delete order
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Order. Try Again Later.</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }
    }
    else
    {
        // Redirect to manage order page
        header('location:'.SITEURL.'admin/manage-order.php');
    }
?>
