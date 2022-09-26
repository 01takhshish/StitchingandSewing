<?php include('partial/menu-section.php'); ?>

<!-- Main Content Menu Section Starts -->
<div class="content">
                <div class="wrapper">
                     <h1>Manage Category</h1><br>

<?php 
   if(isset($_SESSION['add']))
   {
     echo $_SESSION['add'];
     unset($_SESSION['add']);
   }

   if(isset($_SESSION['remove']))
   {
     echo $_SESSION['remove'];
     unset($_SESSION['remove']);
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
   if(isset($_SESSION['upload']))
   {
     echo $_SESSION['upload'];
     unset($_SESSION['upload']);
   }
   if(isset($_SESSION['failed']))
   {
     echo $_SESSION['failed'];
     unset($_SESSION['failed']);
   }
?>

                     <!-- button to add category -->
                     <br><br>
                     <a href="add_category.php" class="btn-primary">Add Category</a><br><br>

                     <table class="tbl-full">
                        <tr>
                            <th>S.no.</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        // query to get all category
                        $sql = "SELECT * FROM tbl_categories";

                        // to execute the query
                        $res = mysqli_query($conn, $sql);

                        // count rows
                        $count = mysqli_num_rows($res);

                        $sn =1;

                        // check whether we have data or not
                        if($count>0)
                        {
                            // we have data in database
                            // get the data and dispaly
                            while($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>

                                    <td>
                                        <?php 
                                        //    check whether image name is available or not
                                        if($image_name!= "")
                                        {
                                            // dispaly the image
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >

                                            <?php
                                        }
                                        else
                                        {
                                            // display the massege
                                            echo "<div class='error'>Image is not added.</div>";
                                        }
                                        ?>
                                    </td>

                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td><a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-update">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delete">Delete Admin</a>

                            </td>
                        </tr>
                        
                                <?php

                            }
                        }
                        else
                        {
                            // we don't have data
                            ?>
                             <tr>
                                   <td colspan="6"><div class="error">No Category Added</div></td>
                             </tr>
                            <?php
                        }

                        
                        ?>
                        
                        
                        
                     </table>
                      <div class="clearfix"></div>
                </div>
        </div>
         <!-- Main Content Menu Section Ends ---->

<?php include('partial/footer.php'); ?>

