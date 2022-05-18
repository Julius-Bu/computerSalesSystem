<?php
//upload.php
include('connection.php');
if(count($_FILES["file"]["name"]) > 0)
{
 //$output = '';
 sleep(3);
 for($count=0; $count<count($_FILES["file"]["name"]); $count++)
 {
  $file_name = $_FILES["file"]["name"][$count];
  $tmp_name = $_FILES["file"]['tmp_name'][$count];
  $file_array = explode(".", $file_name);
  $file_extension = end($file_array);
  if(file_already_uploaded($file_name, $con))
  {
   $file_name = $file_array[0] . '-'. rand() . '.' . $file_extension;
  }
  $location = 'img/' . $file_name;
  if(move_uploaded_file($tmp_name, $location))
  {
   $query = "
   INSERT INTO items (image_name, price) 
   VALUES ('".$file_name."', '')
   ";
   $statement = mysqli_query($con,$query) or die(mysqli_error($con));
  }
 }
}

function file_already_uploaded($file_name, $con)
{
 
 $query = "SELECT * FROM items WHERE image_name = '".$file_name."'";
 $statement = mysqli_query($con,$query) or die(mysqli_error($con));
 $number_of_rows = mysqli_num_rows($statement);
 if($number_of_rows > 0)
 {
  return true;
 }
 else
 {
  return false;
 }
}

?>