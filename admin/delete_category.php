<?php 
//   include constant file
    include('config/code.php');

    // check whether the id and image_name value is set or not
    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
      // get the value and delete
      //echo "gt value and delete it";
      $id = $_GET['id'];
      $image_name = $_GET['image_name'];

      // remove the physical image file if available 
      if($image_name != "")
      {
        // if image is available then remove it
        $path = "../images/category/".$image_name;
        // remove the image
        $remove = unlink($path);
 
        // if failed to remove image then add an error message and stop the process
        if($remove==false)
        {
            // set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove image. Please try again later</div>";

            // redirect the category page
            header('location:'.SITEURL.'admin/category.php');
            // stop the process
            die();
        }
      }
      
    //   delete the data from database
    // sql query to delete data
    $sql = "DELETE FROM tbl_categories WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether the data is delete from the database or not
    if($res==true)
    {
        // set success message and redirect
        $_SESSION['delete'] = "<div class='success'>Category is deleted.</div>";
        header('location:'.SITEURL.'admin/category.php');
    }

    }
    else
    {
        // redirect to category page
        $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
        header('location:'.SITEURL.'admin/category.php');
    }
?>