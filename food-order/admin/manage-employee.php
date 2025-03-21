<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Manage Employee</h1>

        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br /><br /><br />
        <a href="<?php echo SITEURL; ?>admin/add-employee.php" class="btn-primary">Add Employee</a>
        <a href="history-employee.php" class="btn btn-primary">Update Employee Log</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_employee";
            $res = mysqli_query($conn, $sql);

            if ($res == true) {
                $count = mysqli_num_rows($res);

                $sn = 1;

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $name = $rows['name'];
                        $username = $rows['username'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-employee.php?id=<?php echo $id; ?>" class="btn-secondary">Update Employee</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-employee.php?id=<?php echo $id; ?>" class="btn-danger">Delete Employee</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4"><div class="error">No Employees Added.</div></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
