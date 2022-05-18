
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- // BACK END SECTION OF THIS PAGE START -->
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<?php
session_start();
// checking to see if user is logged in
if(isset($_SESSION['email'])){
require 'connection.php';
$user_id=$_SESSION['id'];
    $user_products_query="SELECT it.image_id,it.image_name,it.price FROM users_items ut INNER JOIN items it ON it.image_id=ut.item_id WHERE ut.user_id='$user_id' AND ut.status='Added to cart'";
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
        <title>HavaTech</title>
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
            require 'header.php';
           ?>

           <!-- Background Image start -->
           <img src="img/bg.jpg" style="z-index: -1; position: fixed; width: 100%; margin-top: 50px;">
           <!-- Background Image end -->

           <!-- Cover section Image start -->
           <div id="bannerImage">
               <div class="container">
                   <center>
                   <div id="bannerContent">
                       <h1>GET</h1>
                       <p>Quality and affordable gadgets</p>
                       <a href="products.php" class="btn btn-danger">Shop With Us</a>
                   </div>
                   </center>
               </div>
           </div>
           <!-- Cover section Image end -->

           <!-- Lower horizontal pane section start -->
           <div class="container">
               <div class="row">

                   <div class="col-xs-4">
                       <div  class="thumbnail">
                           <a href="products.php#pc">
                                <img src="img/pc.jpg" alt="pc image">
                           </a>
                           <center>
                                <div class="caption">
                                        <p id="autoResize">PCs</p>
                                        <p>Choose among the best PC brands across the globe.</p>
                                </div>
                           </center>
                       </div>
                   </div>

                   <div class="col-xs-4">
                       <div class="thumbnail">
                           <a href="products.php#pr">
                               <img src="img/mouse.jpg" alt="mouse pic">
                           </a>
                           <center>
                                <div class="caption">
                                    <p id="autoResize">Peripherals</p>
                                    <p>Durable Peripherals here.</p>
                                </div>
                           </center>
                       </div>
                   </div>

                   <div class="col-xs-4">
                       <div class="thumbnail">
                           <a href="products.php#ac">
                               <img src="img/alienware.jpg" alt="alienware">
                           </a>
                           <center>
                               <div class="caption">
                                   <p id="autoResize">Other Accessories</p>
                                   <p>Our collection of accessories.</p>
                               </div>
                           </center>
                       </div>
                   </div>
                   
               </div>
           </div>
           <!-- Lower horizontal pane section end -->
            <br><br> <br><br><br><br>

            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Footer Section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
           <footer class="footer"> 
               <div class="container">
               <center> 
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