<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Employee</h1>

        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="name" placeholder="Enter Employee Name" required></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter Username" required></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter Password" required></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Employee" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get form data
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            // Validate form data
            if (empty($name) || empty($username) || empty($password)) {
                $_SESSION['add'] = "<div class='error'>All fields are required.</div>";
                header('location:' . SITEURL . 'admin/add-employee.php');
                exit();
            }

            // SQL query to insert data
            $sql = "INSERT INTO tbl_employee SET 
                name='$name',
                username='$username',
                password='$password'
            ";

            // Execute the query and handle errors
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $_SESSION['add'] = "<div class='success'>Employee Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-employee.php');
                exit();
            } else {
                // Log the error message for debugging
                $error_message = mysqli_error($conn);
                error_log("Failed to add employee: " . $error_message);

                $_SESSION['add'] = "<div class='error'>Failed to Add Employee. Error: " . $error_message . "</div>";
                header('location:' . SITEURL . 'admin/add-employee.php');
                exit();
            }
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
