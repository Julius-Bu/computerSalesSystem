<?php
//edit.php
include('connection.php');

$query = "
SELECT * FROM items 
WHERE image_id = '".$_POST["image_id"]."'
";
$result = mysqli_query($con,$query) or die(mysqli_error($con));

foreach($result as $row)
{
 $file_array = explode(".", $row["image_name"]);
 $output['image_name'] = $file_array[0];
 $output['price'] = $row["price"];
 $output['category'] = $row["category"];
 $output['quantity'] = $row["quantity"];
}

echo json_encode($output);

?>