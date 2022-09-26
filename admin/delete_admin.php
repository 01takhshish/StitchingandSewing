<?php
    //include code.php file here (constants for $conn)
    include('config/code.php');

   // get the id of the admin to be 
   $id = $_GET['id'];

   // create sqlm querry t delete admin
   $sql = "DELETE FROM tbl_admin WHERE id=$id";

   //Execute the query
   $res = mysqli_query($conn, $sql);

   //check whther the qurry executed successfully  or not
   if($res==TRUE)
   {
       // query executed successfully( admin deleted)
    //    echo "Admin deleted";
     // create session variable to display massege
     $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
     //redirect to admin page
     header('location:'.SITEURL.'admin/admin.php');

   }
   else
   {
      // query is not executed successfully(failed to delete)
    //   echo "Admin not deleted";

    $_SERVER['delete'] = "<div class='error'>Failed to delete admin. Try again later</div>";
    header('location:'.SITEURL.'admin/admin.php');

   }

   // redirect to manage admin page with message(success/ error)

?>