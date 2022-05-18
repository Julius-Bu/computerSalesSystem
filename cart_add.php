<?php

    
    //require 'header.php';
    require 'connection.php';
    session_start();
    // checking to see if user is not logged in
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }

    
    

    
    $item_id=$_GET['id'];

    //geting from item
    $items_query="SELECT * FROM items WHERE image_id='$item_id'";
    $items_query_result=mysqli_query($con,$items_query) or die(mysqli_error($con));
    $row=mysqli_fetch_array($items_query_result);

    $old_name=$row['image_name'];
    $file_array=explode(".", $old_name);
    $new_name=current($file_array);


    //inserting into users_items
    $iName=$new_name;
    $category=$row['category'];
    $pquantity=1;
    $amount=$row['price']*$pquantity;
    $user_id=$_SESSION['id'];
    $tTime=date("h:i:sa");
    $tDate=date("Y-m-d");
    $it_id=$row['image_id'];
    $add_to_cart_query="INSERT INTO users_items(user_id,item_id,iName,category,quantity,amount,status,tDate,tTime) VALUES ('$user_id','$item_id','$iName','$category','$pquantity','$amount','Added to cart','$tDate','$tTime')";
    $add_to_cart_result=mysqli_query($con,$add_to_cart_query) or die(mysqli_error($con));
    header('location: products.php');
?>