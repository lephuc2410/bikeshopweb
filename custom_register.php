<?php include"./includes/header.php"?>       
            <script>
                $(document).ready(function(){

                    $("#password_confirm2").on('keyup',function(){
                       var password_confirm1 = $("#password_confirm1").val();  

                       var password_confirm2 = $("#password_confirm2").val();  


                       if(password_confirm1 == password_confirm2){
                        $("#status_confirm_password").html('<strong style="color:green">Mật khẩu đúng</strong>')
                       }else{
                        $("#status_confirm_password").html('<strong style="color:red">Mật khẩu không đúng</strong>')
                       }
                    })
                })
            </script>
            <div class="register_box">
            <form method="post" enctype="multipart/form-data">
            <table align="left" width="70%">
            <tr align="left">
                <td colspan="4">
                    <h2>Đăng kí</h2>
                    <span>
                        Đã có tài khoản <a href="index.php?action=custom_login">Đăng nhập ngay</a>
                    </span>
                </td>
            </tr>
            <tr>
                <td width="15%"><b>Họ và tên:</b></td>
                <td colspan="3"><input type="text" name="name" placeholder="Họ và tên"></td>
            </tr>
            <tr>
                <td width="15%"><b>Mã số sinh viên:</b></td>
                <td colspan="3"><input type="text" name="mssv" placeholder="Mã số sinh viên"></td>
            </tr>
            <tr>
                <td width="15%"><b>Email:</b></td>
                <td colspan="3"><input type="email" name="email" placeholder="Email"></td>
            </tr>
            <tr>
                <td width="15%"><b>Địa chỉ:</b></td>
                <td colspan="3">
                    <?php include('./includes/country_list.php') ?>
                </td>
            </tr>
            <tr>
                <td width="15%"><b>Mật khẩu:</b></td>
                <td colspan="3"><input type="password" id="password_confirm1" name="password" placeholder="Password"></td>
                
            </tr>
            <tr>
                <td width="15%"><b>Xác nhận mật khẩu:</b></td>
                <td colspan="3"><input type="password" id="password_confirm2" name="confirm_password" placeholder="Confirm Password">
                <p id="status_confirm_password"></p></td>
            
            </tr>
            

            <tr align="left">
                <td></td>
                <td colspan="4">
                    <input type="submit" name="register" value="Đăng kí">
                </td>
            </tr>

        </table>
    </form>
</div>
<?php 
 if (isset($_POST['register'])){
    if(!empty($_POST['email']) && (!empty($_POST['password'])) && (!empty($_POST['confirm_password'])) && (!empty($_POST['name']))){
        $ip = get_ip();
        $name = $_POST['name'];
        $mssv = $_POST['mssv'];
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $hash_password = md5($password);
        $confirm_password = trim($_POST['confirm_password']);
        $country = $_POST['country'];

        $check_exist = mysqli_query($con,"select * from user where email = '$email'");
        $email_count = mysqli_num_rows($check_exist);
        $row_register = mysqli_fetch_array($check_exist);

        if($email_count>0){
            echo "<script>alert('Xin lỗi, $email đã được sử dụng')</script>";
        } elseif( $password == $confirm_password){
           $run_insert = mysqli_query($con,"insert into user (ip_address,name,mssv,email,password,country) values('$ip','$name','$mssv','$email','$hash_password','$country')" );
            if($run_insert){
                $sel_user = mysqli_query($con,"select * from user where email = '$email'");
                $row_user = mysqli_fetch_array($sel_user);


                $_SESSION['user_id'] = $row_user['id'];
            }
        }

    } 
 }
?>

           
       <?php include"./includes/contact.php" ?>

       <?php include"./includes/footer.php"?>