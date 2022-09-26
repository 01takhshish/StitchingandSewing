<?php include('partial/menu-section.php'); ?>


         <!-- Main Content Menu Section Starts -->
        <div class="content">
                <div class="wrapper">
                <?php 
  if(isset($_SESSION['login']))
  {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
  }
?>
                    <br> <h1>DASHBOARD</h1>

                     <div class="col text-centre">

                     <?php 
                         $sql = "SELECT * FROM tbl_categories";
                        //  execute
                        $res = mysqli_query($conn, $sql);
                        // count rows
                        $count = mysqli_num_rows($res);

                     ?>
                          <h1><?php echo $count; ?></h1>
                          <br>
                           categories
                      </div>

                      <div class="col text-centre">
                      <?php 
                         $sql2 = "SELECT * FROM tbl_dress";
                        //  execute
                        $res2 = mysqli_query($conn, $sql2);
                        // count rows
                        $count2 = mysqli_num_rows($res2);

                     ?>
                          <h1><?php echo $count2; ?></h1>
                           <br>
                           Dress
                      </div>
                      <div class="col text-centre">
                      <?php 
                         $sql3 = "SELECT * FROM tbl_order";
                        //  execute
                        $res3 = mysqli_query($conn, $sql3);
                        // count rows
                        $count3 = mysqli_num_rows($res3);

                     ?>
                          <h1><?php echo $count3; ?></h1>
                          <br>
                          Total orders
                      </div>
                      <div class="col text-centre">
                      <?php 
                         $sql4 = "SELECT * FROM tbl_categories";
                        //  execute
                        $res4 = mysqli_query($conn, $sql4);
                        // count rows
                        $count4 = mysqli_num_rows($res4);

                     ?>
                          <h1><?php echo $count4; ?></h1>
                          <br>
                          Revenue
                      </div>
                      <div class="clearfix"></div>
                </div>
        </div>
         <!-- Main Content Menu Section Ends ---->
<?php include('partial/footer.php'); ?>
         
    