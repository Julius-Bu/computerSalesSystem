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

  //daily_sales_query
  $group = $_GET['id'];
  $sales_query="SELECT * FROM users_items WHERE status='Confirmed' AND tDate='$group' ORDER BY id DESC";
  $sales_result=mysqli_query($con,$sales_query) or die(mysqli_error($con));

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
	<title>HavaTech Daily Sales</title>
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
			<h1><p style = "margin-left:30px; margin-top:50px; font-size:14pt; font-weight:bold;">Product Sales Report on <?php echo $group ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></h1>
			<hr/>
        	<div align="right">
			<b style="color:blue;">Printed on:</b>
			<?php include('date.php'); ?>
        	</div>			
			<br/>
			
			<table class="table table-striped">
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
					</tr>
			  </thead>   
			  <tbody>
				<?php
				$counter=1;
				foreach ($sales_result as $row) {
                        
                         ?>
                    <tr>
                      <td style="text-align:center;"><?php echo $counter ?></td>
                      <td style="text-align:center;"><?php echo $row['iName']?></td>
                      <td style="text-align:center;"><?php echo $row['item_id']?></td>
                      <td style="text-align:center;"><?php echo $row['quantity']?></td>
                      <td style="text-align:center;"><?php echo $row['amount']?></td>
                      <td style="text-align:center;"><?php echo $row['category']?></td>
                      <td style="text-align:center;"><?php echo $row['user_id']?></td>
                      <td style="text-align:center;"><?php echo $row['tTime']?></td>
                    </tr>
                    <tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
                    <?php $counter=$counter+1;}?>
				
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