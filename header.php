<nav class="navbar navbar-inverse navabar-fixed-top" style="position: fixed; width: 100%; z-index: 1;">
               <div class="container">
                
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a href="index.php" class="navbar-brand">HavaTech</a>
                         <?php 
                         // checking to see if user is logged in
                         if(isset($_SESSION['email'])) {
                           require 'connection.php';
                            $user_id=$_SESSION['id'];
                                $user_type_query="SELECT * FROM users WHERE id='$user_id' ";
                                $user_type_result=mysqli_query($con,$user_type_query) or die(mysqli_error($con));
                                $row=mysqli_fetch_array($user_type_result);
                                if ($row['type']=='admin') {
                                  ?>
                                  <a href="home.php" class="navbar-brand"> Home </a>
                               <?php 
                               }else{
                              ?>
                               <a href="index.php" class="navbar-brand"> Home </a>
                                <?php }?>
                               

                         <?php 
                       }else{
                        ?>
                         <a href="index.php" class="navbar-brand"> Home </a>
                          <?php }?>
                       <a href="products.php" class="navbar-brand">Store</a>
                       <a href="about_us.php" class="navbar-brand">About Us</a>
                   </div>
                   


                   <div class="collapse navbar-collapse" id="myNavbar">
                       <ul class="nav navbar-nav navbar-right">
                           <?php
                           // checking to see if user is logged in
                           if(isset($_SESSION['email'])){
                           ?>
                           <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <?php echo $no_of_user_products; ?></a></li>
                           <li><a href="#"><span class="glyphicon glyphicon-user"> <?php echo $row['uName']; ?></span></a></li>
                           <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                           <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                           <?php
                           }else{
                            ?>
                            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                           <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                           <?php
                           }
                           ?>
                           
                       </ul>
                   </div>


               </div>
</nav>