<?php
    require 'connection.php';
    session_start();
    $sales_id=$_GET['id'];
    $user_id=$_SESSION['id'];
    $sales_delete_query="DELETE FROM users_items WHERE user_id='$user_id' AND id='$sales_id'";
    $sales_delete_query_result=mysqli_query($con,$sales_delete_query) or die(mysqli_error($con));
    header('location: home.php#sr');
?>