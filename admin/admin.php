<?php include('partial/menu-section.php'); ?>
         <!-- Main Content Menu Section Starts -->
        <div class="content">
                <div class="wrapper">
                     <h1>Manage Admin</h1><br>

                    <?php 
                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];   //displaying session message
                            unset($_SESSION['add']); //removing session message
                        }

                        if(isset($_SESSION['delete']))
                        {
                            echo $_SESSION['delete'];
                            unset($_SESSION['delete']);
                        }

                        if(isset($_SESSION['update']))
                        {
                            echo $_SESSION['update'];
                            unset($_SESSION['update']);
                        }

                        if(isset($_SESSION['user-not-found']))
                        {
                            echo $_SESSION['user-not-found'];
                            unset($_SESSION['user-not-found']);
                        }

                        if(isset($_SESSION['incorrect-password']))
                        {
                            echo $_SESSION['incorrect-password'];
                            unset($_SESSION['incorrect-password']);
                        }

                        if(isset($_SESSION['update-password']))
                        {
                            echo $_SESSION['update-password'];
                            unset($_SESSION['update-password']);
                        }
                    ?>
                    <br><br>
            
                     <!-- button to add admin -->
                     <a href="add_admin.php" class="btn-primary">Add Admin</a><br><br>

                     <table class="tbl-full">
                        <tr>
                            <th>S.no.</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>

                        <?php
                          //Query to Get all Admin
                           $sql = "SELECT * FROM tbl_admin";
                           //Execute the Query
                           $res = mysqli_query($conn, $sql);

                           //check whether the Query is Executed or not
                           if($res == TRUE)
                           {
                            // COUnt rows to check whether we have data in database or not
                            $count = mysqli_num_rows($res); // function to get all rows in database

                            $sn = 1; // create the variable and Assign the value

                            // check the num of rows
                            if($count>0)
                            {
                                // data is in database
                                while($rows= mysqli_fetch_assoc($res))
                                {
                                    // using the while loop to get all the data from database
                                    // while loop will run as long as we have data in datbase

                                    //get individual id
                                    $id= $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $user_name = $rows['user_name'];

                                    //display the value in our table
                                    ?>
                                     <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $user_name; ?></td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/forget_password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn-update">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn-delete">Delete Admin</a>
                                        </td>
                                      </tr>
                       
                                    <?php
                                }
                            }
                            else{
                                // data is not in the database

                            }
                           }
                        ?>

                        
                        
                     </table>


                      <div class="clearfix"></div>
                </div>
        </div>
         <!-- Main Content Menu Section Ends ---->

         <?php include('partial/footer.php'); ?>