<?php
    
    function if_sold_out($item_id){
        //session_start();    
        require 'connection.php';
        $user_id=$_SESSION['id'];
        $product_check_query="SELECT * FROM items WHERE image_id='$item_id'";
        $product_check_result=mysqli_query($con,$product_check_query) or die(mysqli_error($con));
        $num_rows=mysqli_num_rows($product_check_result);
        $row=mysqli_fetch_array($product_check_result);
        if($row['quantity']<=0)return 1;
        return 0;
    }
?>