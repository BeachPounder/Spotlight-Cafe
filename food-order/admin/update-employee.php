<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Employee</h1>

        <br /><br />

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_employee WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $name = $row['name'];
                    $username = $row['username'];
                } else {
                    $_SESSION['no-employee-found'] = "<div class='error'>Employee not found.</div>";
                    header('location:' . SITEURL . 'admin/manage-employee.php');
                }
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-employee.php');
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Employee" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $username = $_POST['username'];
            $updated_by = "Admin"; // Or dynamically set based on logged-in user

            // Get old values
            $sql_old = "SELECT * FROM tbl_employee WHERE id=$id";
            $res_old = mysqli_query($conn, $sql_old);
            $row_old = mysqli_fetch_assoc($res_old);

            // Update the employee
            $sql = "UPDATE tbl_employee SET 
                name='$name',
                username='$username'
                WHERE id='$id'
            ";

            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $_SESSION['update'] = "<div class='success'>Employee Updated Successfully.</div>";

                // Log changes to history
                $fields = ['name' => $name, 'username' => $username];
                foreach ($fields as $field => $new_value) {
                    if ($row_old[$field] != $new_value) {
                        $sql_log = "INSERT INTO tbl_history_employees (employee_id, field_updated, old_value, new_value, update_date, updated_by) 
                                    VALUES ($id, '$field', '{$row_old[$field]}', '$new_value', NOW(), '$updated_by')";
                        mysqli_query($conn, $sql_log);
                    }
                }

                header('location:' . SITEURL . 'admin/manage-employee.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Employee.</div>";
                header('location:' . SITEURL . 'admin/update-employee.php');
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
