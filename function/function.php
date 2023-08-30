<?php
    $con = mysqli_connect("localhost","root","","bikeshop_web");

    if (mysqli_connect_errno()){
        echo "Chua the ket noi:" .mysqli_connect_error();
    }

    function getCarts(){
        global $con;
        $get_cats = "select * from category";

        $run_cats = mysqli_query($con, $get_cats);

        while($row_cats = mysqli_fetch_array($run_cats)){
                $cat_id = $row_cats['cat_id'];

                $cat_title = $row_cats['cat_title'];

                echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
            }
    }
    function getBrands(){
        global $con;
        $get_brand = "select * from brand";

        $run_brand = mysqli_query($con,$get_brand);

        while($row_brand = mysqli_fetch_array($run_brand)){
                $brand_id = $row_brand['brand_id'];

                $brand_name = $row_brand['brand_name'];

                echo "<li><a href='index.php?brand=$brand_id'>$brand_name</a></li>";
            }
    }
    function getPro(){
        global $con;
        if(!isset($_GET['cat'])){
            if(!isset($_GET['brand'])){
                $get_pro = "select * from product order by RAND() LIMIT 0,6";

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
        
   
    }
    function getProbyId(){
          
        if(isset($_GET['cat'])){
            global $con;
            $cat_id =$_GET['cat'];
       
            $get_cat_pro = "select * from product where product_cat='$cat_id'";

            $run_cat_pro = mysqli_query($con, $get_cat_pro);

            $count_cats = mysqli_num_rows($run_cat_pro);

            if($count_cats == 0){
                echo"<h2 style='padding:20px;'> Không tìm thấy loại xe!!</h2>";
            }
            while($row_cat_pro = mysqli_fetch_array($run_cat_pro)){
                $pro_id = $row_cat_pro['product_id'];
                $pro_cat = $row_cat_pro['product_cat'];
                $pro_brand = $row_cat_pro['product_brand'];
                $pro_title = $row_cat_pro['product_title'];
                $pro_price = $row_cat_pro['product_price'];
                $pro_img = $row_cat_pro['product_image'];

                echo "
                <div id='single_product'>
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
    function getProbyBrand(){
        if(isset($_GET['brand'])){
            global $con;
       
            $brand_id =$_GET['brand'];
       
            $get_brand_pro = "select * from product where product_brand='$brand_id'";

            $run_brand_pro = mysqli_query($con, $get_brand_pro);

            $count_brands = mysqli_num_rows($run_brand_pro);

            if($count_brands == 0){
                echo"<h2 style='padding:20px;'> Không tìm thấy hãng xe!!</h2>";
            }
            while($row_brand_pro = mysqli_fetch_array($run_brand_pro)){
                $pro_id = $row_brand_pro['product_id'];
                $pro_cat = $row_brand_pro['product_cat'];
                $pro_brand = $row_brand_pro['product_brand'];
                $pro_title = $row_brand_pro['product_title'];
                $pro_price = $row_brand_pro['product_price'];
                $pro_img = $row_brand_pro['product_image'];

                echo "
                <div id='single_product'>
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
    function get_ip(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    function total_items(){
        global $con;
        $ip = get_ip();

        $run_items=mysqli_query($con,"select * from cart where ip_address='$ip' ");

        echo $count_items=mysqli_num_rows($run_items);
    }

    function total_price(){
        global $con;
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

                $run_qty = mysqli_query($con, "select * from cart where product_id = '$product_id'");
                
                $row_qty = mysqli_fetch_array($run_qty);

                $qty = $row_qty['quality'];

                $total += $values;
            }
        }
        echo $total." đồng";
    }

    function cart(){
        global $con;
        if(isset($_GET['add_cart'])){
            $product_id = $_GET['add_cart'];

            $ip = get_ip();

            $run_check_pro=mysqli_query($con, "select * from cart where product_id=$product_id");
            if(mysqli_num_rows($run_check_pro)>0){
                echo "";
            }else
            {
               
               $fecth_pro=mysqli_query($con,"select * from product where product_id='$product_id'");
               
               $fecth_pro=mysqli_fetch_array($fecth_pro);
               
               $pro_title=$fecth_pro['product_title'];
               
                $run_insert_pro=mysqli_query($con, "insert into cart (product_id,product_title,ip_address) values('$product_id','$pro_title','$ip')  ");

                
            }
        }
    }

?>