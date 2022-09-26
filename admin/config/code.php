<?php
   // start the session
   session_start();

   //create constants t store von repeating values
   define('SITEURL', 'http://localhost/stitching&sewing/');
   define('LOCALHOST', 'localhost');   // TO GIVE THE NAME TO CONSTANT WE NEED TO GIVE ALL CAPITALK LETTERS
   define('DB_USER_NAME', 'root'); 
   define('DB_PASSWORD','');
   define('DB_NAME', 'table_ofcutomer');

   //  Execute Query and save data in database
    //   $res = result

    $conn = mysqli_connect(LOCALHOST, DB_USER_NAME, DB_PASSWORD) or die(mysqli_error());   //database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting database
   // $res = mysqli_query($conn, $sql) or die(mysqli_error());  //mysqli is improved version of mysql
 
?>