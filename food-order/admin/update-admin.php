<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_admin WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            }
        ?>

        <form action="" method="POST">

            <table class="john">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $updated_by = "Admin"; // You can dynamically set this based on the logged-in user

    // Get old values
    $sql_old = "SELECT * FROM tbl_admin WHERE id=$id";
    $res_old = mysqli_query($conn, $sql_old);
    $row_old = mysqli_fetch_assoc($res_old);

    // Update the admin
    $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = '$id'";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['update'] = "<div class='success'>Admin Updated!</div>";

        // Log changes to history
        $fields = ['full_name' => $full_name, 'username' => $username];
        foreach ($fields as $field => $new_value) {
            if ($row_old[$field] != $new_value) {
                $sql_log = "INSERT INTO tbl_history_admins (admin_id, field_updated, old_value, new_value, update_date, updated_by) 
                            VALUES ($id, '$field', '{$row_old[$field]}', '$new_value', NOW(), '$updated_by')";
                mysqli_query($conn, $sql_log);
            }
        }

        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}

?>

<?php include('partials/footer.php'); ?>
