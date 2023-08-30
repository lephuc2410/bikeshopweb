<?php include"./includes/header.php"?>
      
        <div class="content_wrapper">
           <?php
            if(!isset($_SESSION['customer_email'])){
                include('custom_login.php');
            }
            else{
                include('payment.php');
            }
           ?>
            
           
        </div>
       <?php include"./includes/contact.php" ?>

       <?php include"./includes/footer.php"?>