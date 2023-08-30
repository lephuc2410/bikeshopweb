<!DOCTYPE html>
<?php include('./includes/db.php') ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body bgcolor="skyblue">
    <form action="insert_product.php" method="post" enctype="multipart/form-data">
        <table align="center" width = "795" border="2" bgcolor="#187eae">
        <tr align="center">
            <td colspan="7"><h2>Insert New Post Here</h2></td>
        </tr>
        <tr>
            <td align="right">
                <b>Giới thiệu sản phẩm:</b>
            </td>
            <td><input type="text" name="product_title" size="60" require></td>
        </tr>
        <tr>
        <td align="right">
                <b>Loại xe:</b>
        </td>
        <td><select name="product_cat">
            <option value="">Chọn loại xe</option>
            <?php
             $get_cats = "select * from category";

             $run_cats = mysqli_query($con, $get_cats);
     
             while($row_cats = mysqli_fetch_array($run_cats)){
                     $cat_id = $row_cats['cat_id'];
     
                     $cat_title = $row_cats['cat_title'];
     
                     echo "<option value = '$cat_id'>$cat_title</option>";
             }
             ?>
        </select></td>
        </tr>
        <tr>
        <td align="right">
                <b>Hãng xe:</b>
        </td>
        <td><select name="product_brand">
            <option value="">Chọn hãng xe</option>
            <?php
             $get_brand = "select * from brand";

             $run_brand = mysqli_query($con,$get_brand);
     
             while($row_brand = mysqli_fetch_array($run_brand)){
                     $brand_id = $row_brand['brand_id'];
     
                     $brand_name = $row_brand['brand_name'];
     
                     echo "<option value = '$brand_id'>$brand_name</option>";
                 }
             ?>
        </select></td>
        </tr>
        <tr>
            <td align="right">
                <b>Hình ảnh:</b>
            </td>
            <td>
                <input type="file" name="product_image" >
            </td>
        </tr>

        <tr>
            <td align="right">
                <b>Giá:</b>
            </td>
            <td>
                <input type="text" name="product_price">
            </td>
        </tr>
        <td align="right">
            <b>Mô tả chi tiết:</b>
        </td>
        <td>
            <textarea name="product_desc" id="" cols="30" rows="10"></textarea>
        </td>
        <tr>
            <td align="right">
                <b>Từ khóa:</b>
            </td>
            <td>
                <input type="text" name="product_keyword">
            </td>
        </tr>
        <tr align="center">
            <td colspan="7"><input type="submit" name="insert_port" value="Thêm sản phẩm"></td>
        </tr>
        </table>
    </form>
</body>
</html>

<?php
if(isset($_POST['insert_port'])){
    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_desc = trim(mysqli_real_escape_string($con,$_POST['product_desc']));
    $product_keyword = $_POST['product_keyword'];
    //Lay anh trong file
    $product_image = $_FILES['product_image'] ['name'];
    $product_image_tmp = $_FILES['product_image'] ['tmp_name'];

    move_uploaded_file($product_image_tmp,"product_images/$product_image");

    $insert_product = "insert into product(product_title, product_cat, product_brand,product_price, product_desc, product_keyword, product_image)
    values (' $product_title', ' $product_cat','$product_brand','$product_price','$product_desc',' $product_keyword','$product_image')";

    $insert_pro = mysqli_query($con, $insert_product);
    if ($insert_pro){
        echo "<script>alert('Them san pham thanh cong')</script>";
    }else{
        echo "<script>window.open('index.php?insert_product','_self')</script>";
    }
}
?>