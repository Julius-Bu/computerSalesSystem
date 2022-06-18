
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- // BACK END SECTION OF THIS PAGE START -->
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<?php
    session_start();
    require 'check_if_added.php';
    require 'if_sold_out.php';
    require 'if_priced.php';
    // checking to see if user is logged in
    if(isset($_SESSION['email'])){
    require 'connection.php';
$user_id=$_SESSION['id'];
    $user_products_query="SELECT it.image_id,it.image_name,it.price,it.quantity,it.category FROM users_items ut INNER JOIN items it ON it.image_id=ut.item_id WHERE ut.user_id='$user_id' AND ut.status='Added to cart'";
    $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
    $no_of_user_products= mysqli_num_rows($user_products_result);
}
?>
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- // BACK END SECTION OF THIS PAGE END -->
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->



<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- // FRONT END SECTION OF THIS PAGE START -->
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!DOCTYPE html>
<html>
    <head>
        <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
      // Links to this page start
      //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
        <link rel="shortcut icon" href="img/lifestyleStore.png" />
        <title>HavaTech Products</title>
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
        <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
      // Links to this page end
      //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
    </head>
    <body>
        <div>

            <?php
            require 'connection.php';
            require 'header.php';
            ?>

            <!-- Background Image start -->
            <img src="img/bg.jpg" style="z-index: -1; position: fixed; width: 100%; margin-top: 50px;">
            <!-- Background Image end -->
            <!-- Welcome section start -->
            <div class="container">
                <div class="jumbotron">
                    <h1>HavaTech Welcomes you!</h1>
                    <p>Quality Computers and Accessories for Generations.</p>
                </div>
            </div>
            <!-- Welcome section end -->

            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Products section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

            <!-- Computer sub-section start -->
            <div class="container">
                <div id="pc"></div>
                <h2 style="margin-top: 50px;">PCs</h2>
                <?php 
                        $computer_products_query="SELECT * FROM items WHERE category='Computer'";
                        $computer_products_result=mysqli_query($con,$computer_products_query) or die(mysqli_error($con));
                        $no_of_computer_products= mysqli_num_rows($computer_products_result);

                        if ($no_of_computer_products==1) {
                            echo $no_of_computer_products." product.";
                        }else{
                            echo $no_of_computer_products." products.";
                        }
                        ?>
                        <br><br>
                <div class="row">
                    <?php
                    


                        while($row=mysqli_fetch_array($computer_products_result)){
                           
                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">
                           <?php 
                           // checking to see if user is logged in
                           if(isset($_SESSION['email'])){
                            // checking to see if product has been sold out
                            if (if_sold_out($row['image_id'])) {
                                echo '<a href="#pc">
                                <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                            </a>';
                            }else{
                                // checking to see if product has been added to cart
                           if(check_if_added_to_cart($row['image_id'])){
                            echo '<a href="cart.php">
                                <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                            </a>';
                            }else{
                            echo '<a href="#pc">
                                <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                            </a>';
                            }} }else{
                                echo '<a href="login.php">
                                <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                            </a>';
                            }?>

                            <center>
                                <div class="caption">
                                    <?php
                                    $old_name=$row['image_name'];
                                    $file_array=explode(".", $old_name);
                                    $new_name=current($file_array);
                                    ?>
                                    <h3><?php echo $new_name?></h3>
                                    <p>Price: Ugx.<?php echo $row['price']?>/-</p>
                                    <p><?php echo $row['quantity']?> remaining.</p>
                                    <?php 
                                    // checking to see if no price is set
                                    if (!if_priced($row['image_id'])) {
                                        echo '<a href="#pc" class=btn btn-block btn-success disabled>No Price</a>';
                                    }else{
                                        // checking to see if user is not logged in
                                    if(!isset($_SESSION['email'])){  ?>
                                        <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                        <?php
                                        }
                                        else{
                                            // checking to see if product has been sold out
                                            if (if_sold_out($row['image_id'])) {
                                                echo '<a href="#pc" class=btn btn-block btn-success disabled>Sold out</a>';
                                            }else{
                                                // checking to see if product has been added to shopping cart
                                            if(check_if_added_to_cart($row['image_id'])){
                                                echo '<a href="#pc" class=btn btn-block btn-success disabled>Added to cart</a>';
                                            }else{
                                                ?>
                                                <a href="cart_add.php?id=<?php echo $row['image_id']?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                                <?php
                                            }}
                                        }
                                        }
                                        ?>
                                    
                                </div>
                            </center>
                        </div>
                    </div>

                    <?php } ?>
                
                </div>
            </div>
            <!-- Computer sub-section end -->

            <!-- Peripheral sub-section start -->
            <div class="container">
                <div id="pr"></div>
                <h2 style="margin-top: 50px;">Peripherals</h2>
                <?php 
                        $peripheral_products_query="SELECT * FROM items WHERE category='Peripheral'";
                        $peripheral_products_result=mysqli_query($con,$peripheral_products_query) or die(mysqli_error($con));
                        $no_of_peripheral_products= mysqli_num_rows($peripheral_products_result);
                        if ($no_of_peripheral_products==1) {
                            echo $no_of_peripheral_products." product.";
                        }else{
                            echo $no_of_peripheral_products." products.";
                        }
                ?>
                <br><br>
                <div class="row">
                        <?php


                            while($row=mysqli_fetch_array($peripheral_products_result)){
                               
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="thumbnail">
                               <?php 
                               // checking to see if user is logged in
                               if(isset($_SESSION['email'])){
                                // checking to see if product has been sold out
                                if (if_sold_out($row['image_id'])) {
                                    echo '<a href="#pr">
                                    <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                                </a>';
                                }else{
                                    // checking to see if product has been added to cart
                               if(check_if_added_to_cart($row['image_id'])){
                                echo '<a href="cart.php">
                                    <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                                </a>';
                                }else{
                                echo '<a href="#pr">
                                    <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                                </a>';
                                } }}else{
                                    echo '<a href="login.php">
                                    <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                                </a>';
                                }?>

                                <center>
                                    <div class="caption">
                                        <?php
                                        $old_name=$row['image_name'];
                                        $file_array=explode(".", $old_name);
                                        $new_name=current($file_array);
                                        ?>
                                        <h3><?php echo $new_name?></h3>
                                        <p>Price: Ugx.<?php echo $row['price']?>/-</p>
                                        <p><?php echo $row['quantity']?> remaining.</p>
                                        <?php 

                                        // checking to see if no price is set
                                        if (!if_priced($row['image_id'])) {
                                            echo '<a href="#pr" class=btn btn-block btn-success disabled>No Price</a>';
                                        }else{
                                            // checking to see if user is not logged in
                                            if(!isset($_SESSION['email'])){  ?>
                                                <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                                <?php
                                                }
                                                else{
                                                    // checking to see if product has been sold out
                                                    if (if_sold_out($row['image_id'])) {
                                                        echo '<a href="#pr" class=btn btn-block btn-success disabled>Sold out</a>';
                                                    }else{
                                                        // checking to see if product has been added to shopping cart
                                                    if(check_if_added_to_cart($row['image_id'])){
                                                        echo '<a href="#pr" class=btn btn-block btn-success disabled>Added to cart</a>';
                                                    }else{
                                                        ?>
                                                        <a href="cart_add.php?id=<?php echo $row['image_id']?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                                        <?php
                                                    }}
                                            }
                                        }
                                            ?>
                                    </div>
                                </center>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Peripheral sub-section end -->


            <!-- Others sub-section start -->
            <div class="container">
                <div id="ac"></div>
                <h2 style="margin-top: 50px;">Other Accessaries</h2>
                <?php 
                        $others_products_query="SELECT * FROM items WHERE category='Others'";
                        $others_products_result=mysqli_query($con,$others_products_query) or die(mysqli_error($con));
                        $no_of_others_products= mysqli_num_rows($others_products_result);

                        if ($no_of_others_products==1) {
                            echo $no_of_others_products." product.";
                        }else{
                        echo $no_of_others_products." products."; 
                        }
                ?>
                <br><br>
                <div class="row">
                    <?php

                         while($row=mysqli_fetch_array($others_products_result)){
                               
                    ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="thumbnail">
                               <?php 
                               // checking to see if user is logged in
                               if(isset($_SESSION['email'])){
                                // checking to see if product has been sold out
                                if (if_sold_out($row['image_id'])) {
                                    echo '<a href="#ac">
                                    <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                                </a>';
                                }else{
                                    // checking to see if product has been added to cart
                               if(check_if_added_to_cart($row['image_id'])){
                                echo '<a href="cart.php">
                                    <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                                </a>';
                                }else{
                                echo '<a href="#ac">
                                    <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                                </a>';
                                } }}else{
                                    echo '<a href="login.php">
                                    <img src="img/'.$row['image_name'].'" alt="'.$row['image_name'].'">
                                </a>';
                                }?>

                                <center>
                                    <div class="caption">
                                        <?php
                                        $old_name=$row['image_name'];
                                        $file_array=explode(".", $old_name);
                                        $new_name=current($file_array);
                                        ?>
                                        <h3><?php echo $new_name?></h3>
                                        <p>Price: Ugx.<?php echo $row['price']?>/-</p>
                                        <p><?php echo $row['quantity']?> remaining.</p>
                                        <?php 
                                        // checking to see if no price is set
                                        if (!if_priced($row['image_id'])) {
                                        echo '<a href="#ac" class=btn btn-block btn-success disabled>No Price</a>';
                                    }else{
                                        // checking to see if user is not logged in
                                        if(!isset($_SESSION['email'])){  ?>
                                            <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                            <?php
                                            }
                                            else{
                                                // checking to see if product has been sold out
                                                if (if_sold_out($row['image_id'])) {
                                                    echo '<a href="#ac" class=btn btn-block btn-success disabled>Sold out</a>';
                                                }else{
                                                    // checking to see if product has been added to shopping cart
                                                if(check_if_added_to_cart($row['image_id'])){
                                                    echo '<a href="#ac" class=btn btn-block btn-success disabled>Added to cart</a>';
                                                }else{
                                                    ?>
                                                    <a href="cart_add.php?id=<?php echo $row['image_id']?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                                    <?php
                                                }}
                                            }
                                        }
                                            ?>
                                    </div>
                                </center>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Others sub-section start -->
                <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Products section end
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->



            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Footer Section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <br><br><br><br><br><br><br><br>
           <footer class="footer">
               <div class="container">
                <center> 
                <p> &copy Buwembo Julius 2022 </p>
               </center>
               </div>
           </footer>
           <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Footer Section end
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
        </div>
    </body>
</html>
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- // FRONT END SECTION OF THIS PAGE END -->
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->