<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Current Password: </td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </tr>
            <tr>
                <td>New Password: </td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>

            <tr>
                <td>Confirm Password: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>

<?php

if(isset($_POST['submit']))
{
    // Include database connection
    include('config/constants.php');

    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // Debugging information
    // echo "ID: $id<br>";
    // echo "Current Password: $current_password<br>";
    // echo "New Password: $new_password<br>";
    // echo "Confirm Password: $confirm_password<br>";

    // Check whether the user with current ID and current password exists
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    // echo "SQL: $sql<br>";

    $res = mysqli_query($conn, $sql);

    if($res == true)
    {
        $count = mysqli_num_rows($res);

        if($count == 1)
        {
            // Check whether the new password and confirm password match
            if($new_password == $confirm_password)
            {
                // Update the password
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                // echo "SQL2: $sql2<br>";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {
            $_SESSION['user-not-found'] = "<div class='error'>User not Found.</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
}

?>

<?php include('partials/footer.php');?>
