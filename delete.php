<?php
//delete.php

include('connection.php');

if(isset($_POST["image_id"]))
{
 $file_path = 'img/' . $_POST["image_name"];
 if(unlink($file_path))
 {
  $query = "DELETE FROM items WHERE image_id = '".$_POST["image_id"]."'";
  $statement = $con->prepare($query);
  $statement->execute();
 }
}


?>