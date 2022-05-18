
<?php
//update.php

include('connection.php');

if(isset($_POST["image_id"]))
{
 $old_name = get_old_image_name($con, $_POST["image_id"]);
 $file_array = explode(".", $old_name);
 $file_extension = end($file_array);
 $new_name = $_POST["image_name"] . '.' . $file_extension;
 $query = '';
 if($old_name != $new_name)
 {
  $old_path = 'img/' . $old_name;
  $new_path = 'img/' . $new_name;
  if(rename($old_path, $new_path))
  { 
   $query = "
   UPDATE items 
   SET image_name = '".$new_name."', price = '".$_POST["price"]."', quantity = '".$_POST["quantity"]."', category = '".$_POST["category"]."' 
   WHERE image_id = '".$_POST["image_id"]."'
   ";
  }
 }
 else
 {
  $query = "
   UPDATE items 
   SET price = '".$_POST["price"]."', quantity = '".$_POST["quantity"]."', category = '".$_POST["category"]."' 
   WHERE image_id = '".$_POST["image_id"]."'
   ";
 }
 
 $statement = mysqli_query($con,$query) or die(mysqli_error($con));
}
function get_old_image_name($con, $image_id)
{
 $query = "
 SELECT image_name FROM items WHERE image_id = '".$image_id."'
 ";
 $result = mysqli_query($con,$query) or die(mysqli_error($con));
 foreach($result as $row)
 {
  return $row["image_name"];
 }
}

?>