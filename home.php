
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- // BACK END SECTION OF THIS PAGE START -->
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

<?php
require 'connection.php';
session_start();
if(!isset($_SESSION['email'])){  //if not loged in
    header('location: login.php');  // prompts you to log in
}else
{ 
  // helps to get the credential row of the current session user
  $user_id=$_SESSION['id'];
  $user_type_query="SELECT * FROM users WHERE id='$user_id'";
  $user_type_result=mysqli_query($con,$user_type_query) or die(mysqli_error($con));
  $credential_row=mysqli_fetch_array($user_type_result);
}

//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
// Making sure that only admins access this page start
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

if(isset($_SESSION['email']) && $credential_row['type']=='admin'){

  $user_id=$_SESSION['id'];

  //products_query
  $user_products_query="SELECT it.image_id,it.image_name,it.price,it.quantity,it.category FROM users_items ut INNER JOIN items it ON it.image_id=ut.item_id WHERE ut.user_id='$user_id' AND ut.status='Added to cart'";
  $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
  $no_of_user_products= mysqli_num_rows($user_products_result);


  //items_query
  $items_query="SELECT * FROM items";
  $items_result=mysqli_query($con,$items_query) or die(mysqli_error($con));
  $no_of_items_result= mysqli_num_rows($items_result);


  //sales_query
  $sales_query="SELECT * FROM users_items WHERE status='Confirmed'";
  $sales_result=mysqli_query($con,$sales_query) or die(mysqli_error($con));
  $no_of_sales_result= mysqli_num_rows($sales_result);


  //Customers_query
  $customers_query="SELECT * FROM users";
  $customers_result=mysqli_query($con,$customers_query) or die(mysqli_error($con));
  $no_of_customers_result= mysqli_num_rows($customers_result);

}else{
  header('location: index.php');
}
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
// Making sure that only admins access this page end
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
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


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Buwembo Julius">
    <meta name="generator" content="Hugo 0.84.0">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">



      <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
      // Links to this page start
      //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

      <link rel="shortcut icon" href="img/lifestyleStore.png" />
      <title>Julius 2022</title>
      <!-- latest compiled and minified CSS -->
      <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css">
      <link rel="stylesheet" href="fontawesome/css/all.css" type="text/css">
      <!-- jquery library -->
      <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
      <!-- Latest compiled and minified javascript -->
      
      <script type="text/javascript" src="fontawesome/js/all.min.js"></script>
      <script type="text/javascript" src="fontawesome/js/all.js"></script>
      <!-- External CSS -->
      <link rel="stylesheet" href="css/style.css" type="text/css">
      <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
      // Links to this page end
      //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
      <script>
        function validateForm() {
          let x = document.forms["editProductForm"]["price"].value;
          if (x == "") {
            alert("Price must be filled out");
            return false;
          }
        }
      </script>
    </head>

    <body>
      <!-- Background Image start -->
      <img src="img/bg.jpg" class="img-responsive" style="z-index: -1; position: fixed; width: 100%; margin-top: 50px;">
           <!-- Background Image end -->
    
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file"></span>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users"></span>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="bar-chart-2"></span>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="layers"></span>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

        <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Dashboard Section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            
            <div class="container" id="db">
            <h1 style="background: #F5F5F5; margin-top: 50px;">My Dashboard</h1>
               <div class="row">

                   <div class="col-xs-4 col-md-4 col-sm-4 col-lg-4">
                       <div  class="thumbnail">
                           <center>
                            <a href="#sr">
                              <i class="fa fa-line-chart" style="font-size: 500%" ></i>
                            </a>
                            <div class="caption">
                              <p id="autoResize">Total Sales</p>
                              <p><?php echo $no_of_sales_result; ?></p>
                            </div>
                           </center>
                       </div>
                   </div>

                   <div class="col-xs-4 col-md-4 col-sm-4 col-lg-4">
                       <div  class="thumbnail">
                           <center>
                            <a href="#sr">
                              <i class="fa fa-calculator" style="font-size: 500%" ></i>
                            </a>
                            <div class="caption">
                              <p id="autoResize">Total Amount</p>
                              <?php
                              $amount=0;
                              while($row=mysqli_fetch_array($sales_result)){
                                    $amount=$amount+$row['amount']; 
                               }
                              ?>
                              <p>UGX.<?php echo $amount ?>/=</p>
                            </div>
                           </center>
                       </div>
                   </div>

                   <div class="col-xs-4 col-md-4 col-sm-4 col-lg-4">
                       <div  class="thumbnail">
                           <center>
                            <a href="#cr">
                              <i class="fa fa-users" style="font-size: 500%" ></i>
                            </a>
                            <div class="caption">
                              <p id="autoResize">Total Customers</p>
                              <p><?php echo $no_of_customers_result ?></p>
                            </div>
                           </center>
                       </div>
                   </div>
               </div>

               <div class="row">
               <div class="col-xs-4 col-md-4 col-sm-4 col-lg-4">
                       <div  class="thumbnail">
                           <center>
                            <a href="#pr">
                              <i class="fa fa-laptop" style="font-size: 500%" ></i>
                            </a>
                            <div class="caption">
                              <p id="autoResize">Total Items</p>
                              <?php
                              $quantity=0;
                              while($row=mysqli_fetch_array($items_result)){
                                    $quantity=$quantity+$row['quantity']; 
                               }
                              ?>
                              <p><?php echo $quantity ?></p>
                            </div>
                           </center>
                       </div>
                   </div>

                   <div class="col-xs-4 col-md-4 col-sm-4 col-lg-4">
                       <div  class="thumbnail">
                           <center>
                            <a href="uploader.php">
                              <i class="fa fa-cloud-upload" style="font-size: 500%" ></i>
                            </a>
                            <div class="caption">
                              <p id="autoResize">Upload</p>
                              <!-- <p>1000</p> -->
                            </div>
                           </center>
                       </div>
                   </div>

                   <div class="col-xs-4 col-md-4 col-sm-4 col-lg-4">
                       <div  class="thumbnail">
                           <center>
                            <a href="#db">
                              <i class="fa fa-calendar" style="font-size: 500%" ></i>
                            </a>
                            <div class="caption">
                              <p id="autoResize">Date</p>
                              <p><?php echo date("Y-m-d") ?></p>
                            </div>
                           </center>
                       </div>
                   </div>
               </div>
            </div>

               <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                // Dashboard Section end
                //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

                <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Sales Report Section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <div id="sr" class="container">
              <h2  style="background: #F5F5F5; margin-top: 50px;">Sales Report</h2>
              <div class="table-responsive" style="background: #F5F5F5">
                <table class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Product ID</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Product Category</th>
                      <th scope="col">Customer ID</th>
                      <th scope="col">Time</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php
                    //sales_query
                    $sales_query="SELECT * FROM users_items WHERE status='Confirmed' GROUP BY tDate ORDER BY id DESC";
                    $sales_result=mysqli_query($con,$sales_query) or die(mysqli_error($con));
                    $no_of_sales_result= mysqli_num_rows($sales_result);
                    $counter=1;
                       while($row=mysqli_fetch_array($sales_result)){ 
                        ?>
                        <tr style="background-color: #C0C0C0;">
                          <td></td><td colspan="8"><b><?php echo $row['tDate']?></b></td>
                        </tr>
                        <?php
                        $group = $row['tDate'];
                        $sales_query2="SELECT * FROM users_items WHERE status='Confirmed' AND tDate='$group' ORDER BY id DESC";
                        $sales_result2=mysqli_query($con,$sales_query2) or die(mysqli_error($con));
                        foreach ($sales_result2 as $rowd) {
                        
                         ?>
                    <tr>
                      <td><?php echo $counter ?></td>
                      <td><?php echo $rowd['iName']?></td>
                      <td><?php echo $rowd['item_id']?></td>
                      <td><?php echo $rowd['quantity']?></td>
                      <td><?php echo $rowd['amount']?></td>
                      <td><?php echo $rowd['category']?></td>
                      <td><?php echo $rowd['user_id']?></td>
                      <td><?php echo $rowd['tTime']?></td>
                      <td><a href="sales_remove.php?id=<?php echo $rowd['id'] ?>"><button><i class="fa fa-trash"></i></button></a></td>
                    </tr>
                    
                    <?php $counter=$counter+1;}
                    ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><b> Print Daily Report</b></td>
                      <td><a href="reports/salesDailyReport.php?id=<?php echo $row['tDate']?>" target="_new"><button><i class="fa fa-print"></i></button></a></td>
                    </tr>
                    <?php
                  }?>
                    <tr style="background-color: #C0C0C0;">
                      <td></td>
                      <td colspan="6"></td>
                      <td><b><a href="reports/totalSalesReport.php" target="_new"><button> Print Report &nbsp&nbsp&nbsp&nbsp<i class="fa fa-print"></i></button></a></b></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Sales Report Section end
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->



            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Products Report Section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

            <!-- Table section start -->
             <div class="container" id="pr" >
              <h2  style="background: #F5F5F5; margin-top: 50px;">Products Report</h2>
               <div class="table-responsive" id="image_table" style="background: #F5F5F5;">
                
               </div>
              </div>
              <!-- Table section end -->
            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Products Report Section end
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->


            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Customers Report Section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
            <div id="cr" class="container">
              <h2  style="background: #F5F5F5; margin-top: 50px;">Customers Report</h2>
              <div class="table-responsive" style="background: #F5F5F5">
                <table class="table table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Customer Name</th>
                      <th scope="col">Customer ID</th>
                      <th scope="col">Gendar</th>
                      <th scope="col">Email</th>
                      <th scope="col">Contact</th>
                      <th scope="col">City</th>
                      <th scope="col">Address</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $counter=1;
                       while($row=mysqli_fetch_array($customers_result)){
                           
                         ?>
                    <tr>
                      <td><?php echo $counter ?></td>
                      <td><?php echo $row['uName']?></td>
                      <td><?php echo $row['id']?></td>
                      <td><?php echo $row['gender']?></td>
                      <td><?php echo $row['email']?></td>
                      <td><?php echo $row['contact']?></td>
                      <td><?php echo $row['city']?></td>
                      <td><?php echo $row['address']?></td>
                      <td><a href="delete_user.php?id=<?php echo $row['id']?>"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    <?php $counter=$counter+1;}?>
                    <tr style="background-color: #C0C0C0;">
                      <td></td>
                      <td colspan="6"></td>
                      <td><b><a href="reports/customersReport.php" target="_new"><button> Print Report &nbsp&nbsp&nbsp&nbsp<i class="fa fa-print"></i></button></a></b></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Customers Report Section end
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

      
    </main>
  </div>
</div>


    <script src="bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
      <div class="container-fluid">
          
            <br><br> <br><br><br><br>
            <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Footer Section start
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
           <footer class="footer"> 
               <div class="container">
               <center> 
                 &copy Buwembo Julius 2022
               </center>
               </div>
           </footer>
           <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
            // Footer Section end
            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
        </div>
    </body>
</html>

<!-- Edit box start -->
<div id="imageModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <form method="POST" id="edit_image_form" name="editProductForm" onsubmit="return validateForm()">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Edit Product Name</h4>
    </div>
    <div class="modal-body">
     <div class="form-group">
      <label>Product Name</label>
      <input type="text" name="image_name" id="image_name" class="form-control" />
     </div>
     <div class="form-group">
      <label>Price</label>
      <input type="text" name="price" id="price" class="form-control" />
     </div>
     <div class="form-group">
      <label>Product Category</label>
      <select name="category" class="form-control" id="category">
        <option value="Computer">Computer</option>
        <option value="Peripheral">Peripheral</option>
        <option value="Others">Others</option>
      </select>
     </div>
     <div class="form-group">
      <label>Quantity</label>
      <input type="text" name="quantity" id="quantity" class="form-control" />
     </div>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="image_id" id="image_id" value="" />
     <input type="submit" name="submit" class="btn btn-info" value="Save Changes" />
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </form>
  </div>
 </div>
</div>
<!-- Edit box end -->

<script>
  $(document).ready(function(){
    load_image_data();
   function load_image_data()
   {
    $.ajax({
     url:"fetch.php",
     method:"POST",
     success:function(data)
     {
      $('#image_table').html(data);
     }
    });
   }

  $(document).on('click', '.edit', function(){
  var image_id = $(this).attr("id");
  $.ajax({
   url:"edit.php",
   method:"post",
   data:{image_id:image_id},
   dataType:"json",
   success:function(data)
   {
    $('#imageModal').modal('show');
    $('#image_id').val(image_id);
    $('#image_name').val(data.image_name);
    $('#price').val(data.price);
    $('#category').val(data.category);
    $('#quantity').val(data.quantity);
   }
  });
 });



  $(document).on('click', '.delete', function(){
  var image_id = $(this).attr("id");
  var image_name = $(this).data("image_name");
  if(confirm("Are you sure you want to remove it?"))
  {
   $.ajax({
    url:"delete.php",
    method:"POST",
    data:{image_id:image_id, image_name:image_name},
    success:function(data)
    {
     load_image_data();
     alert("Image removed");
    }
   });
  }
 });

  $('#edit_image_form').on('submit', function(event){
  event.preventDefault();
  if($('#image_name').val() == '')
  {
   alert("Enter Image Name");
  }
  else
  {
    if($('#price').val() == '')
  {
   alert("Price should not be empty");
  }
  else{
   $.ajax({
    url:"update.php",
    method:"POST",
    data:$('#edit_image_form').serialize(),
    success:function(data)
    {
     $('#imageModal').modal('hide');
     load_image_data();
     alert('Image Details updated');
    }
   });
 }
  }
 });

  });
</script>

<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- // FRONT END SECTION OF THIS PAGE END -->
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->