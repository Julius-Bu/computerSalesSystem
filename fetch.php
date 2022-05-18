<?php
session_start();
include('connection.php');

$user_id=$_SESSION['id'];
$query = "SELECT * FROM items ORDER BY image_id DESC";
$result = mysqli_query($con,$query) or die(mysqli_error($con));
$number_of_rows = mysqli_num_rows($result);
$output = '';
$output .= '
 <table class="table table-bordered table-striped">
  <tr>
   <th>Sr. No</th>
   <th>Product Image</th>
   <th>Product Name</th>
   <th scope="col">Price</th>
   <th scope="col">Product Category</th>
   <th scope="col">Quantity in Stock</th>
   <th>Edit Product Name</th>
   <th>Delete</th>
  </tr>
';

if($number_of_rows > 0)
{
 $count = 0;
 foreach($result as $row)
 {
  $old_name=$row['image_name'];
  $file_array=explode(".", $old_name);
  $new_name=current($file_array);
  $count ++; 
  $output .= '
  <tr>
   <td>'.$count.'</td>
   <td><img src="img/'.$row["image_name"].'" class="img-thumbnail" width="100" height="100" /></td>
   <td>'.$new_name.'</td>
   <td>'.$row["price"].'</td>
   <td>'.$row["category"].'</td>
   <td>'.$row["quantity"].'</td>
   <td> <a><button type="button" class="edit" id="'. $row['image_id'].'"><i class="fa fa-pencil-square"></i></button></a> </td>
   <td><a><button type="button" class="delete" id="'. $row["image_id"] .'" data-image_name="'.$row["image_name"].'"> <i class="fa fa-trash"></i></button></a></td>
  </tr>
  ';
 }
}
else
{
 $output .= '
  <tr>
   <td colspan="6" align="center">No Data Found</td>
  </tr>
 ';
}
$output .= '
<tr style="background-color: #C0C0C0;">
  <td></td>
  <td colspan="5"></td>
  <td><b><a href="reports/productsReport.php" target="_new"><button>Print Report &nbsp&nbsp&nbsp&nbsp <i class="fa fa-print"></i></button></a></b></td>
  <td></td>
</tr>
</table>';
echo $output;
?>