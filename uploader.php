
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
  <title>HavaTech Upload</title>
  <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
      // Links to this page start
      //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
  <script src="script/jquery.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="fontawesome/css/all.min.css" type="text/css">
  <link rel="stylesheet" href="fontawesome/css/all.css" type="text/css">
  <script type="text/javascript" src="fontawesome/js/all.min.js"></script>
  <script type="text/javascript" src="fontawesome/js/all.js"></script>
  <script src="script/bootstrap.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
  <!-- //||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
      // Links to this page end
      //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
  <style type="text/css">
    #image_table{
      border: 0px solid blue;
      padding: 10px;
    }
  </style>
 </head>
 <body>
  <?php
    require 'header.php';
  ?>
  <!-- Background Image start -->
  <img src="img/bg.jpg" style="z-index: -1; position: fixed; width: 100%; margin-top: 50px;">
  <!-- Background Image end -->
  <br>

  <!-- Upload Button section start -->
  <div class="container" style="background: #F5F5F5; margin-top: 50px">
   <h3 align="center">Upload & Delete Product Image from here.</h3>
   <br />
   <div class="col-xs-4" >
    <input type="file" name="multiple_files" id="multiple_files" class="glyphicon glyphicon-upload" multiple />
    <span id="error_multiple_files"></span>
   </div>
   <div class="col-xs-4">
     <a href="home.php#pr"><i class="fa fa-list-alt"></i> View Products List</a>
   </div>
 </div>
 <!-- Upload Button section end -->


 </body>
</html>


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
 $('#multiple_files').change(function(){
  var error_images = '';
  var form_data = new FormData();
  var files = $('#multiple_files')[0].files;
  if(files.length > 10)
  {
   error_images += 'You can not select more than 10 files';
  }
  else
  {
   for(var i=0; i<files.length; i++)
   {
    var name = document.getElementById("multiple_files").files[i].name;
    var ext = name.split('.').pop().toLowerCase();
    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
    {
     error_images += '<p>Invalid '+i+' File</p>';
    }
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
    var f = document.getElementById("multiple_files").files[i];
    var fsize = f.size||f.fileSize;
    if(fsize > 2000000)
    {
     error_images += '<p>' + i + ' File Size is very big</p>';
    }
    else
    {
     form_data.append("file[]", document.getElementById('multiple_files').files[i]);
    }
   }
  }
  if(error_images == '')
  {
   $.ajax({
    url:"upload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#error_multiple_files').html('<br /><label class="text-primary">Uploading...</label>');
    },   
    success:function(data)
    {
     $('#error_multiple_files').html('<br /><label class="text-success">Uploaded</label>');
     load_image_data();
    }
   });
   // window.location="home.php#pr";
  }
  else
  {
   $('#multiple_files').val('');
   $('#error_multiple_files').html("<span class='text-danger'>"+error_images+"</span>");
   return false;
  }
 });  
 
});
</script>
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
<!-- // FRONT END SECTION OF THIS PAGE END -->
<!-- //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->