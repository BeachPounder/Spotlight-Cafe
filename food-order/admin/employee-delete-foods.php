<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include('../config/db_connect.php');

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        $remove_path = "../images/category/".$image_name;
        $remove = unlink($remove_path);

        if ($remove == false) {
            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
            header('location:'.SITEURL.'employee/page1.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        header('location:'.SITEURL.'employee/page1.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
        header('location:'.SITEURL.'employee/page1.php');
    }
} else {
    header('location:'.SITEURL.'employee/page1.php');
}
?>
