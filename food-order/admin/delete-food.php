<?php
include('../config/constants.php');

// Check if the id and image_name value is set
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the image file if available
    if ($image_name != "") {
        $path = "../images/food/" . $image_name;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Failed to Remove Food Image.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }

    // Delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>
