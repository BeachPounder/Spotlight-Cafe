<?php
include('../config/constants.php');
// Destroy the session
session_destroy();

// Redirect to login page with a logout message
header('location:'.SITEURL.'admin/login.php');
exit();

?>