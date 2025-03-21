<?php include('partials/menu.php');?>

<head>
    <link rel="stylesheet" href="dope.css">
</head>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br> 
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //Displaying Session Message
                unset($_SESSION['add']); //Removing Session Message
            }
            ?>
        <form action="" method="POST">

        <table class="john">
            <tr>
                <td>Full Name: </td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
            </tr>

            <tr>
                <td>Username: </td>
                <td>
                    <input type="text" name="username" placeholder="Your Username">
                </td>
            </tr>

            <tr>
                <td>Password: </td>
                <td>
                <input type="password" name="password" placeholder="Your Password">
                </td>

            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="micheal-secondary">
                </td>
            </tr>





        </table>
        </form>

    </div>
</div>






<?php include('partials/footer.php');?>

<?php
//Process the value from the From and Save it in DataBase.

if(isset($_POST['submit']))
{

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO tbl_admin set
            full_name='$full_name',
            username='$username',
            password='$password'
    ";

    //3. Execure Query and Save Data in Database.
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if($res==True)
    {
        //echo "Data Inserted";
        $_SESSION['add'] = "Admin Added Successfully";
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to insert data
        //echo "Failed to insert data";
        $_SESSION['add'] = "Failed to Add Admin";
        header("location:".SITEURL.'admin/add-admin.php');
    }
}

?>