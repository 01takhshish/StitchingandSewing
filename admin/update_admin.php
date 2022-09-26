<?php include('partial/menu-section.php'); ?>

<div class="content">
    <div class="wrapper">
        <h3>Update Admin</h3><br>

        <!-- Getting Info -->
        <?php 

          // 1. Getting the Id
             $id = $_GET['id'];

          // 2. create the sql to get the details
          $sql = "SELECT * FROM tbl_admin WHERE id=$id";

          // 3. Execute the query
          $res = mysqli_query($conn, $sql);

          //check whether the query executed or not
          if($res==true)
          {
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            // check whether we have admin data or not
            if($count==1)
            {
                // // get the detail
                // echo "Admin is Available";
                $row =mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $user_name = $row['user_name'];
            }
            else
            {
               // Redirect to Manage admin
               header('location:'.SITEURL.'admin/admin.php');
            }
          }
        ?>

        <form action="" method="POST">
            <table class="tbl-half">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value ="<?php echo $full_name; ?>"></td>
                <tr>
                </tr>
                    <td>User Name</td>
                    <td><input type="text" name="user_name" value= "<?php echo $user_name; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-update">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
     //check whether the submit button is clicked or not
     if(isset($_POST['submit']))
     {
        // echo "Submit is working";
        //Get the value from to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $user_name = $_POST['user_name'];

        //Create the sql query
        $sql = "UPDATE tbl_admin SET
        full_name ='$full_name',
        user_name = '$user_name'
        WHERE id=$id";

        ///execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not
        if($res==true)
        {
            //query executed and admin updated
            $_SESSION['update'] = "<div class='success'><b>Admin updated Successfully</b></div>";

            //redirect admin page
            header('location:'.SITEURL.'admin/admin.php');
        }
        else
        {
            //failed to update admin
            $_SESSION['update'] = "<div class='error'><b>Admin is not updated</b></div>";

            //redirect to admin page
            header('location:'.SITEURL.'admin/admin/php');

        }
     }
?>

<?php include('partial/footer.php'); ?>