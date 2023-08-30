<?php
include("./includes/db.php");
include("./function/function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/style.css">
    <script src="js/jquery.js">  </script>
</head>
<body>
    <div class="main_wrapper">
        <div class="header_wrapper">
        <div class="header_logo">
            <a href="index.php"><img class="logo_img" id="logo" src="images/bikeshop_logo.png" alt=""></a>
        </div>
        <div id="form">
            <form method="get" action="results.php" enctype="multipart/form-data">
                <input type="text" name="user_query" placeholder="Tìm sản phẩm">
                <input type="submit" name="search" value="Tìm kiếm">
            </form>
        </div>
        <div class="cart">
            <ul>
                <li class="dropdown_header_cart">
                    <div id="notification_total_cart" class="shopping_cart">
                        <img src="./images/cart.png" alt="">
                        <div class="noti_cart_number"> 
                            <?php
                            
                                total_items()
                            ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="register_login">
            <div class="login"><a href="index.php?action=login">Login</a></div>
            <div class="register"><a href="custom_register.php">Register</a></div>
        </div>
        </div>
        <div class="menu_bar">
            <ul id="menu">
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="all_products.php">Tất cả sản phẩm</a></li>
                <li><a href="customer/my_account.php">Tài khoản</a></li>
                <li><a href="cart.php">Giỏ hàng</a></li>
                <li><a href="contact.php">Hỗ trợ</a></li>
                <li><a href="logout.php">Đăng xuất</a></li>
            </ul>
        </div>