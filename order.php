<?php include('./partial_frontend/menu.php') ?>

    <!-- Navbar Section Ends Here -->
     
    <?php 
    //  check whether dress id is set or not
    if(isset($_GET['dress_id']))
    {
        // get the dress id and details of the selected dress
        $dress_id = $_GET['dress_id'];

        // get the details of the selected dress
        $sql = "SELECT * FROM tbl_dress WHERE id=$dress_id";
        // execute
        $res = mysqli_query($conn, $sql);
        // count the rows
        $count = mysqli_num_rows($res);

        //check whether the data is available or not
        if($count==1)
        {
            // we have details
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
        //     we don't have
        //  redirect  to home  page
          header('location:'.SITEURL);
        }
    }
    else
    {
         header('location:'.SITEURL);
    }
    ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your appointment.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend></legend>

                    
    
                    <div class="food-menu-desc">
                        <h3>We come at your place for taking measurnment and  choosing the style and fabric for your dress.</h3>
                        <br><p class="price text-centre"><b>FREE!!</b></p>

                        <div class="order-label"></div>
                        <!-- <input type="number" name="qty" class="input-responsive" value="1" required> -->
                        
                    </div>

                </fieldset>
                
                <fieldset>
                <div class="food-menu-img">
                    <?php 
                       if($image_name== "")
                       {
                        echo "<div class='error'>Image is not  Available.</div>";
                       }
                       else
                       {
                        ?>
                             <img src="<?php echo SITEURL; ?>images/dress/<?php echo $image_name; ?>" alt="dress" width="130px" class="img">
                        <?php
                       }
                    ?>
                       
                    </div>
                    <div class="foodmenu">
                        <h4><?php echo $title; ?></h4>
                        <input type="hidden" name="dress" value="<?php echo $title; ?>">
                        <p class="price">Rs. <?php echo $price;  ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                    </div>

                    <br><br>
                    <legend>Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Takhshish" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. takhsish@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                       <a href="appoint.html">
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                    
                </fieldset>
                

            </form>

            <?php
            // checked whether submit btn is working or not
            if(isset($_POST['submit']))
            {
                // get all the details from the form
                $dress = $_POST['dress'];
                $price = $_POST['price'];
                $qty = "1";
                $total = $price * $qty;
                $date = date("Y-m-d h:i:sa");
                $status = "Appointment";
                $customer_name = $_POST['full-name'];
                $customer_contact  = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                // save the order in the database
                // create sql to save the data
                $sql2 = "INSERT INTO tbl_order SET
                   dress = '$dress',
                   price = '$price',
                   qty = '$qty',
                   total = '$total'
                   date = '$date',
                   status = '$status',
                   customer_name = '$customer_name',
                   customer_contact = '$customer_contact',
                   customer_email = '$customer_email',
                   customer_address = '$customer_address'
                ";
                // exucte the  query
                $res2 = mysqli_query($conn, $sql2);

                // checked whthe query exec
                if($res2 ==true)
                {
                //     $_SESSION['login']="<div class='success text-center'><b>Welcome to the database management!</b></div>";
                   header('location:'.SITEURL.'appoint.php');
                 }
                else 
                {
                    
                    // $_SESSION['login']="<div class='error text-center'><b>Welcome to the database management!</b></div>";
                    // header('location:'.SITEURL.);
                }
            }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('./partial_frontend/footer.php') ?>