<?php include"./includes/header.php"?>
       
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
                     global $con;
                     if(!isset($_GET['cat'])){
                         if(!isset($_GET['brand'])){
                             $get_pro = "select * from product ";
             
                         $run_pro = mysqli_query($con,$get_pro);
             
                         while ($row_pro = mysqli_fetch_array($run_pro)){
                             $pro_id = $row_pro['product_id'];
                             $pro_cat = $row_pro['product_cat'];
                             $pro_brand = $row_pro['product_brand'];
                             $pro_title = $row_pro['product_title'];
                             $pro_price = $row_pro['product_price'];
                             $pro_img = $row_pro['product_image'];
             
                             echo "<div id='single_product'>
                             <h3>$pro_title</h3>
                             <img src = 'admin_area/product_images/$pro_img' width='180px' height'180' />
                             <p><b> Giá: $pro_price đồng </b></p>
                             <a href ='detail.php?pro_id=$pro_id'>Chi tiết</a>
             
                             <a href ='index.php?add_cart=$pro_id'>
                             <button style='float:right'>Thêm vào giỏ hàng</button>
                             </a>
                             </div> 
                             ";
                         }
                         }
                         
                     }
                    ?>
                    <?php
                    getProbyId()
                    ?>
                     <?php
                    getProbyBrand()
                    ?>
                </div>
            </div>
            <div class="content_wrapper">

            </div>
        </div>
       
        <?php include"./includes/contact.php" ?>              
       <?php include"./includes/footer.php"?>