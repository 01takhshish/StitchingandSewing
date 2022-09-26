<?php include('partial/menu-section.php'); ?>

<!-- Main Content Menu Section Starts -->
<div class="content">
                <div class="wrapper">
                     <h1>Manage Dress</h1><br>

                     <!-- button to add admin -->
                     <a href="<?php echo SITEURL;?>admin/add_men.php" class="btn-primary">Add Dress</a><br><br>

                     <?php 
   if(isset($_SESSION['add']))
   {
     echo $_SESSION['add'];
     unset($_SESSION['add']);
   }

   
?>


                     <table class="tbl-full">
                        <tr>
                            <th>S.no.</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Fetures<th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        // query to get all dress
                        $sql = "SELECT * FROM tbl_dress";

                        // to execute the query
                        $res = mysqli_query($conn, $sql);

                        // count rows
                        $count = mysqli_num_rows($res);

                        $sn =1;

                        if($count>0)
                        {
                          //  we have food in databse
                          //  get the food from database and didspaly
                          while($row = mysqli_fetch_assoc($res))
                          {
                            // get the value
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                              
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title;?></td>
                            <td><?php echo $price; ?></td>
                            <td>
                              <?php 
                            //   check whether we have image or not
                            if($image_name == "")
                            {
                              // we display the error msg
                              echo "<div class='error'>Image is not added</div>";
                            }
                            else
                            {
                                //  showing the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/men/<?php echo $image_name; ?>" width="100px">;
                                <?php
                            }
                            ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                              <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-update">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delete">Delete Admin</a>

                            </td>
                        </tr>
                            <?php
                          }
                        }
                        else
                        {
                             echo "<tr><td colspan ='7' class='error'>Food is not added.</td></tr>";
                        }
                        
                        ?>  
                     </table>
                      <div class="clearfix"></div>
                </div>
        </div>
         <!-- Main Content Menu Section Ends ---->

<?php include('partial/footer.php'); ?>

