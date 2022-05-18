<?php
    
    function if_priced($item_id){
        //session_start();    
        require 'connection.php';
        $product_check_query="SELECT * FROM items WHERE image_id='$item_id'";
        $product_check_result=mysqli_query($con,$product_check_query) or die(mysqli_error($con));
        $num_rows=mysqli_num_rows($product_check_result);
        $row=mysqli_fetch_array($product_check_result);
        if($row['price']<=0)return 0;
        return 1;
    }
?>