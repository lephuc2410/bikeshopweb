<div class="login_box">
    <form action="" method="post">
        <table align="left" width="70%">
            <tr align="left">
                <td colspan="4">
                    <h2>Đăng nhập</h2>
                    <span>
                        Chưa có tài khoản <a href="custom_register.php">Đăng kí ngay</a>
                    </span>
                </td>
            </tr>
            <tr>
                <td width="15%"><b>Email:</b></td>
                <td><input type="email" name="email" placeholder="Email"></td>
            </tr>
            <tr>
                <td width="15%"><b>Mật khẩu:</b></td>
                <td><input type="password" name="password" placeholder="Password"></td>
            </tr>
            <tr align="left">
                <td></td>
                <td colspan="4">
                    <a href="checkout.php?forgot_pass">
                        Quên mật khẩu
                    </a>
                </td>
            </tr>

            <tr align="left">
                <td></td>
                <td colspan="4">
                    <input type="submit" name="login" value="Đăng nhập">
                </td>
            </tr>

        </table>
    </form>
</div>
<?php
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $run_login = mysqli_query($con,"select * from user where password = '$password' AND email = '$email'");

        $check_login = mysqli_num_rows($run_login);

        if($check_login == 0){
            echo "<script>alert('Email hoặc mật khẩu không đúng, vui lòng thử lại')</script>";
            exit();
        }
        $ip = get_ip();
        $run_cart = mysqli_query($con,"select * from cart where ip_address ='$ip'");

        $check_cart = mysqli_num_rows($run_cart);

        if ($check_login > 0 AND $check_cart==0){
            $_SESSION['email'] = $email;
            echo "<script>alert('Đăng nhập thành công')</script>";
            echo "<script>window.open('customer/my_account.php','_self')</script>";
        } else {
            $_SESSION['email']=$email;
            echo "<script>alert('Đăng nhập thành công')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }
    }
    
?>