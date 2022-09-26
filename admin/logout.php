<?php 
    //include the code.php for SITEURL
    include('config/code.php');

    //1. destroy the session
    session_destroy(); // unset $_SESSION['user']

    //2. redirect the login page
    header('location:'.SITEURL.'admin/login.php');
?>