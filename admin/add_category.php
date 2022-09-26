<?php include('partial/menu-section.php')?>


<div class="content">
    <div class="wrapper">
        <h1>Add Category</h1><br>
        <?php 
   if(isset($_SESSION['add']))
   {
     echo $_SESSION['add'];
     unset($_SESSION['add']);
   }
   if(isset($_SESSION['upload']))
   {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
   }
?>
   <br>
          <form action="" method="post" enctype="multipart/form-data">  
               <!-- enctype="multipart/form-data" this function is used for uploading the file from form -->
            <table class="tbl-half">
            <tr> 
                       <td>Title</td>
                       <td>
                         <input type="text" name="title" placeholder="Category title">
                       </td>
                   </tr>
                   <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image"></td>
                   </tr>

                   <tr>
                       <td>Featured</td>
                       <td>
                          <input type="radio" name="featured" value="Yes">Yes
                          <input type="radio" name="featured" value="No">No
                       </td>
                   </tr>

                   <tr>
                       <td>Active</td>
                       <td>
                          <input type="radio" name="active" value="Yes">Yes
                          <input type="radio" name="active" value="No">No
                       </td>
                   </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-update">
                    </td>
                </tr>
            </table>
        </form>
</div>
</div>
<?php include('partial/footer.php') ?>

<?php
     if(isset($_POST['submit']))
     {
        // echo "clicked" ;
        // get the data from form
        $title = $_POST['title'];

        // for radio input tag we need to check whether the radio button select or not
        if(isset($_POST['featured']))
        {
            // If radio button is selected get the value
            $featured = $_POST['featured'];
        }
        else
        {
            // get the defualt value
            $featured= "No";
        }

        if(isset($_POST['active']))
        {
            //If the radio button is selected get the value
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";
        }

        // check whether the image is selected or not
        // print_r($_FILES['image']);

        //  die(); // break the code

        if(isset($_FILES['image']['name']))
        {
            //upload the image
            // to upload the image we need source path and destination path
            $image_name = $_FILES['image']['name'];

            // upload image only if it is available
            if($image_name !="")
           {
     
            
            

            // auto rename our image
            //  get the extension of our image(jpg, png, gif, etc)e.g. "dress.jpg" --- dress jpg
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
                header('location:'.SITEURL.'admin/add_category.php');
                // stop the process
                die();
            }
           }
        }
        else
        {
            //  don't upload the image_name value as blank
            $image_name="";  
        }
        // create sql query to insert category into database
        $sql = "INSERT INTO tbl_categories SET
            title = '$title' ,
            image_name = '$image_name',
            featured = '$featured' ,
            active = '$active'
        ";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // check whether the query executed or not
        if($res==true)
        {
            // data inserted and category add
            $_SESSION['add'] = "<div class='success'>Category is added.</div>";
            header('location:'.SITEURL.'admin/category.php');
        }
        else
        {
        //    Failed to add category
        $_SESSION['add'] = "<div class='erorr'>Failed to add category. Please try again later.</div>";
        header('location:'.SITEURL.'admin/category.php');
        }
     }
?>