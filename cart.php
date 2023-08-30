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
                <div class="shopping_cart_container"> <div id="shopping_cart" align="right" style="padding: 15px;">
                    <?php
                    if(isset($_SESSION['customer_email'])){

                        echo "<b>Email của bạn: </b>" . $_SESSION['customer_email'];
                    }
                    else{
                        echo"";
                    }
                    ?>
                    <b style="color:navy">Giỏ hàng của bạn - </b> Sản phẩm: <?php total_items() ?> Thanh toán: <?php total_price() ?>
                </div><!--Shopping cart-->
                <form action="" method="post" enctype="multipart/form-data">
            <table align="center" width="100%">
                <tr align="center">
                    <th>Remove</th>
                    <th>Product</th>
                    <th>Quality</th>
                    <th>Price</th>
                </tr>
                <?php
                $total = 0;
                $ip = get_ip();
                $run_cart = mysqli_query($con, " select * from cart  where ip_address='$ip'");
                while ($fetch_cart = mysqli_fetch_array($run_cart)){
                    $product_id = $fetch_cart['product_id'];
        
                    $result_product = mysqli_query($con, "select * from product where product_id='$product_id'");
        
                    while ($fetch_product = mysqli_fetch_array($result_product)){
        
                        $product_price = array($fetch_product['product_price']);
        
                        $product_title = $fetch_product['product_title'];
        
                        $product_image = $fetch_product['product_image'];
        
                        $sing_price = $fetch_product['product_price'];
        
                        $values = array_sum($product_price);

                        $run_qty = mysqli_query($con, "select * from cart where product_id = '$product_id' ");
                
                        $row_qty = mysqli_fetch_array($run_qty);
        
                        $qty = $row_qty['quality'];
        
                        $values_qty = $values * $qty;
        
                        $total += $values_qty;
                   
                
                ?>
                <tr align="center">
                   <td><input type="checkbox" name="remove[]" value="<?php echo $product_id ?>"></td>
                   <td><?php echo $product_title ?>
                        <br/>
                        <img src="admin_area/product_images/<?php echo $product_image; ?>" alt="">
                    </td>
                   <td><input type="text" size="4"name="qty"value="<?php echo $qty; ?>"></td>
                   <td><?php echo $sing_price." đồng" ?></td>
                </tr>

                <?php } } ?>

                <tr>
                    <td colspan="4" align="right"><b>Tổng giá: </b></td>
                    <td><?php echo total_price(); ?></td>
                </tr>


                <tr align="center">
                    <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"></td>
                    <td><input type="submit" name="continue" value="Continue Shopping"></td>
                    <td><button><a href="checkout.php" >Check out</a></button></td>
                </tr>
               </table>
            </form>
                <?php
                if(isset($_POST['remove'])){

                    foreach ($_POST['remove'] as $remove_id);
                    $run_delete = mysqli_query($con, "delete from cart where product_id='$remove_id' AND ip_address = '$ip'");

                    if($run_delete){
                        echo "<script> window.open('cart.php','_self') </script>";
                    }
                }

                if(isset($_POST['continue'])){
                    echo "<script> window.open('index.php','_self') </script>";
                }
                
                
                
                ?>

            </div><!--Shopping cart container-->

               
            </div>
            <div class="content_wrapper">

            </div>
        </div>
       
        <?php include"./includes/contact.php" ?>        
       <?php include"./includes/footer.php"?>