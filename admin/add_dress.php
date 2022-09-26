<?php include('partial/menu-section.php'); ?>

<div class="content">
    <div class="wrapper">
        <h2>Add Dress</h2>
        <?php
        if(isset($_SESSION['upload']))
   {
    echo $_SESSION['upload'];
    unset($_SESSION['upload']);
   }
?>
    <br><br>

    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-half">
            <tr>
                <td>Title</td>
                <td><input type="text" name="title" placeholder="Enter the Title" required></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><textarea name="description" cols="30" row="10" placeholder="Enter the quality of the dress"></textarea></td>    
            </tr>
            <tr>
                <td>Price</td>
                <td><input type="number" name="price" placeholder="Enter the price of the dress"></td>
            </tr>
            <tr>
                <td>Select Image</td>
                <td><input type= "file" name="image"></td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                    <select name="category_id">
<?php
//    create php code to dispaly categories from database
//  1. create sql querry to get all active categories from database
  $sql = "SELECT * FROM tbl_categories WHERE active='Yes'";

  $res = mysqli_query($conn, $sql);

//   count rows to check whether we have categories or not
$count= mysqli_num_rows($res);

//  if count is grater than zero then we have category else we don't have
if($count>0)
{
//    we have categories
         
       while($row= mysqli_fetch_assoc($res))
       {
        //  get all the details of categories
         $id = $row['id'];
         $title = $row['title'];
          
         ?>
         <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
         <?php
       }
}
else
{
    // we don't have categories
    ?>
    <option value="0">No category is Found</option>
    <?php
}

//  2. dispaly on dropdawn

?>
                        
                    </select>
                </td>
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
                    <input type="submit" name="submit" value="Add Dress" class="btn-update">
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>
<?php 
if(isset($_POST['submit']))
{
    // echo "Button clicked";

    // 1. get the value from form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price  = $_POST['price'];
    $category_id = $_POST['category_id'];

    // for radio button we need to check whether the radio button is selected or not
    if(isset($_POST['featured']))
    {
        // if radio button is selected
        $featured = $_POST['featured'];
    } 
    else
    {
        //  if radio button is not selected
        $featured = "No";
    }

    if(isset($_POST['active']))
    {
        // if radio button is selected
        $active = $_POST['active'];
    } 
    else
    {
        //  if radio button is not selected
        $active = "No";
    }

    // 2. upload the image if selected
    //  check whether the image is selected or not and upload the image only if image is selected
    if(isset($_FILES['image']['name']))
    {
        //  get the details of the selected image
        $image_name= $_FILES['image']['name'];

        // check whether the image is selected or not
        if($image_name != "")
        {
            // image is selected
         // 1. rename the image
            //  get the extension of the selected image
            $ext = end(explode('.', $image_name));
            // rename the image
            $image_name = "Dress_design".rand(0000, 9999).'.'.$ext; // new image name may be given ----

         // 2. upload the image
            //  get the source path and the destination path
          

            // source path is the current location of the image
            $src = $_FILES['image']['tmp_name'];

            // destination path for the image to be uploaded
            $dsp = "../images/dress/".$image_name;

            // upload image 
            $upload = move_uploaded_file($src, $dsp);

            // check whether the image uploaded or not
            // if the image is not uploaded then we will stop the process and redirect with error message
            if($upload == false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload the image. Please try again later.</div>";
                header('location:'.SITEURL.'admin/add_dress.php');
                die();
            }
        }
    }
    else
    {
        $image_name = "";  // setting defult as blank
    }

    // 3. insert into database
    $sql2 = "INSERT INTO tbl_dress SET
    title = '$title' ,
    description = '$description',
    price = '$price',
    image_name = '$image_name',
    featured = '$featured' ,
    active = '$active'
";

    // execute the query
    $res2 = mysqli_query($conn, $sql2);

    // 4. redirect with message with manage admin page
    if($res2==true)
        {
            // data inserted and category add
            $_SESSION['add'] = "<div class='success'>Dress is added.</div>";
            header('location:'.SITEURL.'admin/dress.php');
        }
        else
        {
        //    Failed to add category
        $_SESSION['add'] = "<div class='erorr'>Failed to add dress. Please try again later.</div>";
        header('location:'.SITEURL.'admin/dress.php');
        }
}
?>

<?php include('partial/footer.php'); ?>

