<?php
    require 'connection.php';
    session_start();
    $customer_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $delete_query="DELETE FROM users WHERE id='$customer_id'";
    $delete_query_result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
    header('location: home.php#cr');
?>