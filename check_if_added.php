<?php
    
    function check_if_added_to_cart($item_id){
        //session_start();    
        require 'connection.php';
        $user_id=$_SESSION['id'];
        $product_check_query="SELECT * FROM users_items WHERE item_id='$item_id' AND user_id='$user_id' AND status='Added to cart'";
        $product_check_result=mysqli_query($con,$product_check_query) or die(mysqli_error($con));
        $num_rows=mysqli_num_rows($product_check_result);
        $row=mysqli_fetch_array($product_check_result);
        if($num_rows>=1)return 1;
        return 0;
    }
?>