<?php include('partial/menu-section.php')?>

<div class="content">
    <div class="wrapper">
        <h1>Add Admin</h1><br>

        <!-- <?php
         if(isset($_SESSION['add']))  //checking whether the session is set or not
        {
                echo $_SESSION['add'];  // display the session message is set
                unset($_SESSION['add']); // removing the session message
         }
        ?> -->

        <form action="" method="post">
            <table class="tbl-half">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter the Name" required></td>
                </tr>
                <tr>   
                    <td>Username</td>
                    <td><input type="text" name="user_name" placeholder="Enter the Username" required></td>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-update">
                    </td>
                </tr>
            </table>
        </form>
</div>
</div>
<?php include('partial/footer.php') ?>

<?php
    // process the value from form and save it in databse

    // check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // button clicked
    //    get the data from form
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']);  //md5 for making password encrypt
  
    // SQL query to save the data into database
     $sql ="INSERT INTO tbl_admin SET
         full_name= '$full_name',
         user_name = '$user_name',
         password = '$password'
     ";
//  Executing Query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());  //mysqli is improved version of mysql

       //check whether the (query is executed) data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //DATA inserted
        // echo "data inserted";
        // create a session variable to display message
        $_SESSION['add'] = "<div class='success'><b>Admin Added Successfully</b></div>";
        // redirect page TO  Admin
        header("location:".SITEURL.'admin/admin.php');
    }
    else
    {
        //failed to insert data
        // echo "data is not inserted";
        // create a session variable to display message
        $_SESSION['add'] = "<div class='error'><b>Failed to Add Admin</b></div>";
        // redirect page TO  Admin
        header("location:".SITEURL.'admin/admin.php');
    }
       
    }
  
?>
