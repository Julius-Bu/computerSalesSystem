<?php
require '../connection.php';
session_start();
if(!isset($_SESSION['email'])){  //if not loged in
    header('location: ../login.php');  // prompts you to log in
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

	$query = "SELECT * FROM items ORDER BY image_id DESC";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	$number_of_rows = mysqli_num_rows($result);


}else{
  header('location: ../index.php');
}
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
// Making sure that only admins access this page end
//||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="../img/lifestyleStore.png" />
	<title>HavaTech Products Report</title>
	<style>
		.container {
			width:75%;
			margin:auto;
		}
				
		.table {
		    width: 100%;
		    margin-bottom: 20px;
		}	

		.table-striped tbody > tr:nth-child(odd) > td,
		.table-striped tbody > tr:nth-child(odd) > th {
		    background-color: #f9f9f9;
		}
		.img-thumbnail {
  			display: inline-block;
  			max-width: 100%;
  			height: auto;
  			padding: 4px;
  			line-height: 1.42857143;
  			background-color: #fff;
  			border: 1px solid #ddd;
  			border-radius: 4px;
  			-webkit-transition: all .2s ease-in-out;
       		-o-transition: all .2s ease-in-out;
          	transition: all .2s ease-in-out;
		}

		@media print{
		#print {
		display:none;
		}
		}

		#print {
			width: 90px;
		    height: 30px;
		    font-size: 18px;
		    background: white;
		    border-radius: 4px;
			margin-left:28px;
			cursor:hand;
		}
		
	</style>
	<script>
		function printPage() {
		    window.print();
		}
	</script>	
</head>


<body>
	<div class = "container">
		<div id = "header">
			<br/>
			<button type="submit" id="print" onclick="printPage()">Print</button>
			<h1><p style = "margin-left:30px; margin-top:50px; font-size:14pt; font-weight:bold;">Products Report &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></h1>
			<hr/>
        	<div align="right">
			<b style="color:blue;">Printed on:</b>
			<?php include('date.php'); ?>
        	</div>			
			<br/>
			
			<table class="table table-striped">
			  <thead>
					<tr>
						<th>Sr. No</th>
	   					<th>Product Image</th>
	   					<th>Product Name</th>
	   					<th>Price</th>
	   					<th>Product Category</th>
	   					<th>Quantity in Stock</th>
					
					</tr>
			  </thead>   
			  <tbody>

				<?php
				if($number_of_rows > 0){
					$count = 0;
				foreach ($result as $row) { 
				$old_name=$row['image_name'];
  				$file_array=explode(".", $old_name);
  				$new_name=current($file_array);
				$count ++;    
                ?>

                <tr>
                  <td style="text-align:center;"><?php echo $count ?></td>
                  <td style="text-align:center;"><img src="../img/<?php echo $row['image_name']?>" class="img-thumbnail" width="100" height="100" /></td>
                  <td style="text-align:center;"><?php echo $new_name?></td>
                  <td style="text-align:center;"><?php echo $row['price']?></td>
                  <td style="text-align:center;"><?php echo $row['category']?></td>
                  <td style="text-align:center;"><?php echo $row['quantity']?></td>
                </tr>
                <tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
                    <?php }} else{
                    	?>
                    	<tr>
                    <td></td>
   					<td colspan="5" align="center">No Data Found</td>
  					</tr>
                    <?php
                }
                ?>
			  </tbody> 
		  </table> 
			<br />
			<br />
			<hr/>
			<b style="color:blue; font-size:15px;">
			Printed By: <?php echo $credential_row['uName'] ?>.
			</b>
		</div>
	</div>
</body>
</html>