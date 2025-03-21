<?php include('../config/constants.php');?>

<html>
    <head>
        <title>Spotlight Cafe Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
    <div class="login">
        <h1 class="text-center">Login</h1>
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
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>

            Password: <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">

            <li><a href="employee-login.php">Employee Login</a></li>
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
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // Execute the Query
    $res = mysqli_query($conn, $sql);

    // Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1)
    {  
        $_SESSION['login'] = "<div class='success'>Login Successfull.</div>";
        $_SESSION['user'] = $username;

        // Redirect to Home Page/Dashboard
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        // User not available and login fail
        $_SESSION['login'] = "<div class='error text-center '>Username or Password did not match.</div>";
        // Redirect to Login Page
        header('location:'.SITEURL.'admin/login.php');

    }

}



?>