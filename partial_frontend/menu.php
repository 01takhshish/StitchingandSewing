<?php include('admin/config/code.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stitching&Sewing</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <link rel="icon" href="images/favicon2.png" type="image/png">
</head>

<body>
    <header>
        <input type="checkbox" name="" id="chk1">
        <div class="logo">
            <h1 class="lg"><i>S&S</i></h1>
        </div>

        <ul>
            <li><a href="<?php echo SITEURL; ?>women.php">Women</a></li>
            <li><a href="<?php echo SITEURL; ?>men.php">Men</a></li>
            <li><a href="<?php echo SITEURL; ?>kid.php">Kids</a></li>
            <li><a href="<?php echo SITEURL; ?>">home</a></li>
            <li><a href="<?php echo SITEURL; ?>about.php">about us</a></li>
            <li><a href="<?php echo SITEURL; ?>contact.php">contact</a></li>
            <li>
                <a href="facebook.com"><i class="fab fa-facebook"></i></a>
                <a href="twitter.com"><i class="fab fa-twitter"></i></a>
                <a href="instagram.com"><i class="fab fa-instagram"></i></a>
            </li>
        </ul>
        <div class="search-box">
            <form action="">
                <input type="text" name="search" id="srch" placeholder="Search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <div class="menu">
            <label for="chk1">
                <i class="fa fa-bars"></i>
            </label>
        </div>
    </header>