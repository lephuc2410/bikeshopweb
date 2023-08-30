<?php include"./includes/header.php"?>
<?php include"./includes/slider.php"?>       
        <div class="content_wrapper">
            <div id="side_bar">
                <div id="side_bar-title">Danh mục</div>
                <ul id="cats">
                    <?php 
                      getCarts()
                    ?>
                
                </ul>
                <div id="side_bar-title">Loại xe</div>
                <ul id="cats">
                <?php 
                       getBrands();
                    ?>
                </ul>
            </div><!--Sidebar-->
            <div id="content_area">
                <div id="products_box">
                    <?php
                    cart()
                    ?>
                    <?php if(!isset($_GET['action'])) {?>
                    <?php
                    getPro()
                    ?>
                    <?php
                    getProbyId()
                    ?>
                     <?php
                    getProbyBrand()
                    ?>
                    <?php } else { ?>
                    <?php include('custom_login.php');?>
                    <?php } ?>
                </div>
            </div>
            <div class="content_wrapper">

            </div>
        </div>
       <?php include"./includes/contact.php" ?>

       <?php include"./includes/footer.php"?>