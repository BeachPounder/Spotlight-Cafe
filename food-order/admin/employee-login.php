<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Spotlight Cafe Employee Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
    <div class="login">
        <h1 class="text-center">Employee Login</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) 
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }

        ?>
        <br>
                <!-- Login Form Starts Here -->
                <form action="" method="POST" class="text-center">
            Username: <br>  <!-- Marie -->
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>  <!-- 12345 -->
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
        <p class="text-center">Created By - Danie Y. Limpag</p>
        </div>
    </body>
</html>

<?php
if (isset($_POST['submit'])) 
{
    // Get the Data from Login Form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQL to check whether the user exists or not
    $sql = "SELECT * FROM tbl_employee WHERE username='$username' AND password='$password'";

    // Execute the Query
    $res = mysqli_query($conn, $sql);

    // Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1)
    {  
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;

        // Redirect to Employee Dashboard
        header('location:'.SITEURL.'admin/employee-dashboard.php');
    }
    else
    {
        // User not available and login fail
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        // Redirect to Login Page
        header('location:'.SITEURL.'admin/employee-login.php');
    }
}
?>
