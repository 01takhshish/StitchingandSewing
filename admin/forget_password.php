<?php include('partial/menu-section.php') ?>

  <div class="content">
    <div class="wrapper">
        <h3>Change Password</h3><br>
  
        <?php 
          if(isset($_GET['id']))
          {
            $id= $_GET['id'];
          }
        ?> 

        <form action="" method="POST">
            <table class="tabl-half">
                <tr>
                    <td>Current Password</td>
                    <td><input type="password" name="current_password" placeholder="Enter your old password"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" placeholder="Enter your new password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Enter your new password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-update">
                    </td>
                </tr>

            </table>
        </form>
    </div>
  </div>
  <?php 
    // CHECK whether the submit button is working or not

    if(isset($_POST['submit']))
    {
      //  echo "Clicked";

      // 1. get the data from the database
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);


      //2. check  whether the password in database and current password is same or not
          $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
      
          //Execute the query
          $res= mysqli_query($conn, $sql);

          if($res==true)
          {
            //check whether the data is available  or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
              //user exist and password can be changed
              // echo "User Exist";
              //check whether the new password and current password match or not
              if($new_password == $confirm_password)
              {
                // update password
                  $sql2 =  "UPDATE tbl_admin SET
                       password ='$new_password'
                       WHERE id=$id
                       ";

                  // Execute the query
                  $res2 = mysqli_query($conn, $sql2);

                  // check whether the  Query is executed or not
                  if($res==true)
                  {
                    // display password is update
                    $_SESSION['update-password']="<div class ='success'><b>Password is Updated</b></div>";
                     header('location:'.SITEURL.'admin/admin.php');
                  }
                  else
                  {
                      // password is not updated
                      $_SESSION['update-password']="<div class ='error'><b>There is some error. Please try again later</b></div>";
                      header('location:'.SITEURL.'admin/admin.php');
                  }
              }
              else
              {
                // redirect to admin page
                $_SESSION['incorrect-password']="<div class ='error'><b>Incorrect Password</b></div>";
                header('location:'.SITEURL.'admin/admin.php');
              }
            }
            else
            {
              //user does not exist set message and redirect
                $_SESSION['user-not-found'] = "<div class='error'><b>user not found</b></div>";
                header('location:'.SITEURL.'admin/admin.php');
            }
          }

      //3.  check whether the new password and current password is same or not
      

      //4. if above is true then change the password
    }
  ?>

<?php include('partial/footer.php') ?>