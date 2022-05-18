
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- // BACK END SECTION OF THIS PAGE START -->
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<?php
    session_start();
    require 'check_if_added.php';
    require 'if_sold_out.php';
    
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
        <title>About</title>
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
                    <center>
                    <h1>About Us</h1>
                    <p>MAKERERE UNIVERSITY</p>
                    <p>BACHELOR OF INFORMATION SYSTEMS AND TECHNOLOGY</p>
                    <p>YEAR 2, 2020/21</p>
                    <p>IST 2205: Web Systems and Technology</p>
                    <p><i> By; Mr. Bitwire George Albert</i></p> <br>
                    <p><b>December 2021</b> </p>
                    </center>
                </div>
            </div>
            <!-- Welcome section end -->

            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Members section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <div class="container">
                <h2 style="margin-top: 50px;">GROUP MEMBERS</h2>
                <div class="row">
                    <!-- Member sub-section start -->
                    <div class="col-md-4 col-sm-7">
                        <div class="thumbnail">
                            <p><b>Name:</b> Bandese Violet</p>
                            <p><b>Student No.:</b> 1800720882</p>
                            <p><b>Reg. No.:</b> 18/U/20882/EVE</p>
                            <p><b>Phone No.:</b> +256 787 960847</p>
                        </div>
                    </div>
                    <!-- Member sub-section end -->
                    <!-- Member sub-section start -->
                    <div class="col-md-4 col-sm-7">
                        <div class="thumbnail">
                            <p><b>Name:</b> Sanya Hillary</p>
                            <p><b>Student No.:</b> 1800720928</p>
                            <p><b>Reg. No.:</b> 18/U/20928/EVE</p>
                            <p><b>Phone No.:</b> +256 758 620225</p>
                        </div>
                    </div>
                    <!-- Member sub-section end -->
                    <!-- Member sub-section start -->
                    <div class="col-md-4 col-sm-7">
                        <div class="thumbnail">
                            <p><b>Name:</b> Mugasha Eunison</p>
                            <p><b>Student No.:</b> 1800722825</p>
                            <p><b>Reg. No.:</b> 18/U/22825/PS</p>
                            <p><b>Phone No.:</b> </p>
                        </div>
                    </div>
                    <!-- Member sub-section end -->
                    <!-- Member sub-section start -->
                    <div class="col-md-4 col-sm-7">
                        <div class="thumbnail">
                            <p><b>Name:</b> Achen Janet Florence</p>
                            <p><b>Student No.:</b> 1800726077</p>
                            <p><b>Reg. No.:</b> 18/U/26077/PS</p>
                            <p><b>Phone No.:</b> </p>
                        </div>
                    </div>
                    <!-- Member sub-section end -->
                    <!-- Member sub-section start -->
                    <div class="col-md-4 col-sm-7">
                        <div class="thumbnail">
                            <p><b>Name:</b> Kulume Mary Alegan</p>
                            <p><b>Student No.:</b> 1800741773</p>
                            <p><b>Reg. No.:</b> 18/U/41773</p>
                            <p><b>Phone No.:</b> </p>
                        </div>
                    </div>
                    <!-- Member sub-section end -->
                </div>
            </div>
            <!-- Member sub-section end -->

            
                <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Members section end
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->



            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Footer Section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <br><br><br><br><br><br><br><br>
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