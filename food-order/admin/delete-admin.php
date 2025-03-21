<?php

// Include constants.php file here
include('../config/constants.php');

// 1. Get the ID of Admin to be deleted
$id = $_GET['id'];

// Create SQL query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// Execute the query
$res = mysqli_query($conn, $sql);

// Check whether the query executed successfully or not
if($res == true) {
    // Query executed successfully and admin deleted
    //echo "Admin Deleted";
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";

    header('location:'.SITEURL.'admin/manage-admin.php');
} else {
    // Failed to delete admin
    //echo "Failed to Delete Admin";

    $_SESSION['delete'] = "<div class='error'>Failed to Deleted Admin.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

?>