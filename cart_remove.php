<?php
    require 'connection.php';
    session_start();
    
    // checking to see if user is not logged in
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
    
    $item_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $delete_query="DELETE FROM users_items WHERE user_id='$user_id' AND item_id='$item_id'";
    $delete_query_result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
    header('location: cart.php');
?>