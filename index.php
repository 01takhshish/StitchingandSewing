<?php include('partial_frontend/menu.php') ?>

<?php 
  if(isset($_SESSION['login']))
  {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
  }
?>
    <!-- Slide Show -->
    <div class="slide-frame">
        <div class="img-container">
            <img src="images/sli.jpg" class="ghgh">
            <img src="images/cute.jpg">

        </div>
    </div>

    <!-- Categories section starts here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-centre">Categories</h2>
            <?php 
                // create sql query to dispaly categories from databse
                $sql = "SELECT * FROM tbl_categories";
                // execute the query
                $res = mysqli_query($conn, $sql);
            //    count rows to check wht th ecategory i savailabl eor not
                $count = mysqli_num_rows($res);

                if($count > 0 )
                {
                    // categories aval.
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // get th evalues like title, image_nme and id
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                     <a href="<?php echo SITEURL; ?><?php echo $title; ?>.php">
                <div class="box float-container">
                    <?php 
                      if($image_name =="")
                      {
                        echo "<div class= 'error'>Image not Available</div>";
                      }
                      else
                      {
                        // image available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Wom" class="imgsr">
                        <?php

                      }
                    ?>
                
                    <h3 class="float-text"><?php echo $title; ?></h3>
                </div>
            </a>
                        <?php
                    }
                }
                else
                {
                    // categories not available
                    echo "div class= 'error'>Category is not added</div>";
                }
            ?>
           
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories section ends here -->
    <!--  -->
    <!-- food menu section starts here -->
    <section class="food_menu">
        <div class="container">
            <h2 class="text-centre">Explore Here! Amaging Offers!</h2>

            <?php 
            //  getting foods from database that are active
            $sql2 = "SELECT * FROM tbl_dress WHERE active='Yes' AND featured = 'Yes'";

            //  execute the querry
            $res2 = mysqli_query($conn, $sql2);

            // count rows
            $count2 = mysqli_num_rows($res2);

            if($count2 > 0)
            {
                // dress available
                while($row = mysqli_fetch_assoc($res2))
                {
                    // get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
  
                   <div class="food-menu">
                   <div class="food_menu_img">
                    <?php 
                        // check whether the image is available or not
                        if($image_name == "")
                        {
                            // image is not avail.
                            echo "<div class='error'>Image is not present</div>";
                        }
                        else
                        {
                        //    image is available
                        ?>
                          <img src="<?php echo SITEURL; ?>images/dress/<?php echo $image_name; ?>" alt="dress" class="food_img">
                        <?php
                        }
                    ?>
                </div>
                <div class="food_menu_desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="price"><b><?php echo $price; ?></b></p>
                    <p class="details"><?php echo $description; ?></p><br>
                    <a href="<?php echo SITEURL; ?>order.php?dress_id=<?php echo $id; ?>" class="btn">Order Now</a>
                </div>
                <div class="clearfix"></div>
                    </div>

                    <?php
                }
            }
            else
            {
                // dress not available
                echo "<div class= 'error'>Dress is not available.</div>";
            }
            ?>

            <!-- BOX---:4:STARTS HERE -->
               
         
            <!-- BOX---::ENDS HERE -->

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- food menu section ends here -->

    
    <?php include('./partial_frontend/footer.php') ?>