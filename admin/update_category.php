<?php include('partial/menu-section.php'); ?>

<div class="content">
    <div class="wrapper">
        <h2>Update Category</h2><br><br>

        <?php 
        //    check whether the id set or not
        if(isset($_GET['id']))
        {
            // get the id and all the other details
            $id = $_GET['id'];
            // create sql query to get all data
            $sql = "SELECT * FROM tbl_categories WHERE id=$id";

            // execute
            $res = mysqli_query($conn, $sql);

            // count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //   get the data
                $rows= mysqli_fetch_assoc($res);
                $title = $rows['title'];
                $current_image = $rows['image_name'];
                $featured = $rows['featured'];
                $active = $rows['active'];
            }
            else
            {
                // redirect to category page
                $_SESSION['reject'] = "<div class='error'>No-valid category.</div>";
                header('location.'.SITEURL.'admin/category');
            }
        }
        else
        {
            // redirect to category page
            header('location:'.SITEURL.'admin/category.php');
        }
        
        ?>


        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-half">

        <tr>
           <td>Title</td>
           <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
        </tr>
        <tr>
            <td>Current Image</td>
            <td><?php 
                  if($current_image !="")
                  {
                    // display the image
                    ?>

                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="200px">
                    <?php

                  }
                  else
                  {
                    // display the message
                     echo "<div class='error'>Image is not added.</div>";
                  }


            ?></td>
        </tr>
        <tr>
            <td>Image</td>
            <td><input type="file" name="image"></td>
        </tr>
        <tr>
            <td>Feature</td>
            <td>
                <input  <?php if($featured=="Yes"){echo "Checked"; } ?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){echo "checked";; } ?> type="radio" name="featured" value="No">No
            </td>
        </tr>
        <tr>
            <td>Active</td>
            <td>
                <input <?php if($featured=="Yes"){echo "Checked"; } ?> type="radio" name="active" value="Yes">Yes
                <input <?php if($featured=="No"){echo "Checked"; } ?> type="radio" name="active" value="No">No
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update-Category" class="btn-update">
            </td>
        </tr>

</table>
        </form>
    </div>
</div>
<?php 
 
 if(isset($_POST['submit']))
 {
    //    echo "submit";
    // get the value from our form
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //  updating new image
    // check whether image is selected or not
    if(isset($_FILES['image']['name']))
    {
    //    get the image details
        $image_name =$_FILES['image']['name'];

        // check whether the image is available or not
        if($image_name != "")
        {
            // image available

            // A. upload the new image

            // auto rename our image
            //  get the extension of our image(jpg, png, gif, etc)e.g. "dress.jpg"
            $ext = end(explode('.', $image_name));

            //   rename the image name
            $image_name = "Dress_category".rand(000, 999).'.'.$ext; //e.g. food_category_834.jpg


            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            // Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            // check whether the image uploaded or not
            // if the image is not uploaded then we will stop the process and redirect with error message
            if($upload==false)
            {
                // set message
                $_SESSION['upload'] = "<div class='error'>Failed to upload the image. Please try again later.</div>";
                header('location:'.SITEURL.'admin/category.php');
                // stop the process
                die();
            }
           

            //B. remove the current img if available
            if($current_image!="")
            {
                $remove_path = "../images/category/".$current_image;

                $remove = unlink($remove_path);
    
                // check whether the image is removed or not
                // if failed to remove dislpay the image and stop the process
                if($remove==false)
                {
                    // failed to remove image
                    $_SESSION['failed'] = "<div class='error'>Filed to remove image. Please try again later.</div>";
                    header('location'.SITEURL.'admin/category.php');
                    die();
                }
                
            }
            

        }
        else
        {
            $image_name =$current_image;
        }
    }
    else
    {
        $image_name = $current_image;
    }

    // update the database
    $sql2 = "UPDATE tbl_categories SET
      title = '$title',
      image_name = '$image_name',
      featured = '$featured',
      active = '$active'
      WHERE id=$id
    ";
    //  execute the query
    $res2 = mysqli_query($conn, $sql2);

    // redirect to manage category page
    // whether query executed or not
    if($res2==true)
    {
        $_SESSION['update'] ="<div class='success'>Category is updated successfully</div>";
        header('location:'.SITEURL.'admin/category.php');
    }
    else
    {
        $_SESSION['update'] ="<div class='error'>Category is not updated. Please try again later.</div>";
        header('location'.SITEURL.'admin/category.php');
    }


 }
 else
 {
        
 }
?>
<?php include('partial/footer.php'); ?>