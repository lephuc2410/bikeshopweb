<?php
    $con = mysqli_connect("localhost","root","","bikeshop_web");

    if(mysqli_connect_errno()){
        echo "Không thể kết nối tới MySQL" . mysqli_connect_errno();
    }