<?php 
     // Authorization - access control
     // check whether the user logged in or not
     if(!isset($_SESSION['user'])) // if user session is not set
     {
        //user is not logged in 
        //redirect to login page with message
        $_SESSION['no_login']="<div class='error text-center'>Please login to access Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
     }
?>