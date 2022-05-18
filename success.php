<?php
    session_start();
    require 'connection.php';
    // checking to see if user is not logged in
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }else{

    
        
        $user_id=$_GET['id'];

        $item_quantity_query1="SELECT * FROM users_items WHERE user_id='$user_id' AND status='Added to cart'";
        $item_quantity_result1=mysqli_query($con,$item_quantity_query1) or die(mysqli_error($con));
       while( $row1=mysqli_fetch_array($item_quantity_result1)){
        $pquantity=$row1['quantity'];
        $item_id=$row1['item_id'];

        $item_quantity_query2="SELECT * FROM items WHERE image_id='$item_id'";
        $item_quantity_result2=mysqli_query($con,$item_quantity_query2) or die(mysqli_error($con));
        while($row=mysqli_fetch_array($item_quantity_result2)){



        //updating quantity

        $quantity=$row['quantity']-$pquantity;

        $item_quantity_query="UPDATE items SET quantity='$quantity' WHERE image_id='$item_id'";
        $item_quantity_result=mysqli_query($con,$item_quantity_query) or die(mysqli_error($con));}}

        $tTime=date("h:i:sa");
        $tDate=date("Y-m-d");
        $user_id=$_SESSION['id'];
        $confirm_query="UPDATE users_items SET status='Confirmed',tDate='$tDate',tTime='$tTime' WHERE user_id=$user_id AND status='Added to cart'";
        $confirm_query_result=mysqli_query($con,$confirm_query) or die(mysqli_error($con));


        $user_id=$_SESSION['id'];
    $user_products_query="SELECT it.image_id,it.image_name,it.price FROM users_items ut INNER JOIN items it ON it.image_id=ut.item_id WHERE ut.user_id='$user_id' AND ut.status='Added to cart'";
    $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
    $no_of_user_products= mysqli_num_rows($user_products_result);
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title> Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <img src="img/bg.jpg" style="z-index: -1; position: fixed; width: 100%; margin-top: 50px;">
            <br>
            <div class="container" style="margin-top: 50px;">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading"></div>
                            <div class="panel-body">
                                <p>Your order is confirmed. Thank you for shopping with us. <a href="products.php">Click here</a> to purchase any other item.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
               <div class="container">
                <center> 
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
