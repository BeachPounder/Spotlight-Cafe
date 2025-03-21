<?php
include('../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_employee WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Employee Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-employee.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Employee.</div>";
        header('location:' . SITEURL . 'admin/manage-employee.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-employee.php');
}
?>
