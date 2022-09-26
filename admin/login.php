<?php include('config/code.php'); ?>

<html>
<head>
    <title>
        Login- Stitching & Sewing system
    </title>
    <link rel= "stylesheet" href="st.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>
        <?php 
           if(isset($_SESSION['login']))
           {
              echo $_SESSION['login'];
              unset($_SESSION['login']);
           }
           if(isset($_SESSION['no_login']))
           {
              echo $_SESSION['no_login'];
              unset($_SESSION['no_login']);
           }
        ?>
        <form action="" method="POST">
        <br><br> Username:<br>
         <input type="text" name="user_name"  placeholder="Enter the username" size="34px"><br><br>
         Password:<br>
         <input type="password" name="password" placeholder="Enter the password"  size="34px"><br><br><br>
         <input type="submit" name="submit" value="login" class="btn-primary log " >

        </form>

        

       <br><br> <p class="text-center">Created by <a href="#">Takhshish Bano</a></p>
    </div>
</body>
</html>

<?php
   // check whether the submit btn is working or not
   if(isset($_POST['submit']))
   {
    //process for login
    //1. get the data from login form
     $password = md5($_POST['password']);
     $user_name = $_POST['user_name'];

     //2. sql to check whether the userrname and passowrd exist or not
     $sql = "SELECT * FROM tbl_admin WHERE user_name='$user_name' AND password='$password'";

     //3. execute the query
     $res = mysqli_query($conn, $sql);
      
     //4. count rows whether the user exist
     $count = mysqli_num_rows($res);

     if($count==1)
     {
        // user available
        $_SESSION['login']="<div class='success text-center'><b>Welcome to the database management!</b></div>";
        $_SESSION['user']= $user_name; // to check whether the user logged in or not and logout with unset it
        header('location:'.SITEURL.'admin/');
     }
     else
     {
        // user not available
        $_SESSION['login']="<div class='error'>Username or Password did not match</div>";
        header('location:'.SITEURL.'admin/login.php');
     }
   }
?>