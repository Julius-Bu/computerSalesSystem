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

	

  


  // min date query
  $min_date_query="SELECT MIN(tDate) AS earlyDate FROM users_items WHERE status='Confirmed'";
  $min_date_result=mysqli_query($con,$min_date_query) or die(mysqli_error($con));
  $min_date_row=mysqli_fetch_array($min_date_result);

  // max date query
  $max_date_query="SELECT MAX(tDate) AS lateDate FROM users_items WHERE status='Confirmed'";
  $max_date_result=mysqli_query($con,$max_date_query) or die(mysqli_error($con));
  $max_date_row=mysqli_fetch_array($max_date_result);

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
	<title>HavaTech Sales Report</title>
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
		.table-bordered th,
  		.table-bordered td {
    		border: 1px solid #ddd !important;
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
			<h1><p style = "margin-left:30px; margin-top:50px; font-size:14pt; font-weight:bold;">Product Sales Report from &nbsp; <?php echo $min_date_row['earlyDate'] ?> &nbsp; to &nbsp;<?php echo $max_date_row['lateDate'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></h1>
			<hr/>
        	<div align="right">
			<b style="color:blue;">Printed on:</b>
			<?php include('date.php'); ?>
        	</div>			
			<br/>
			
			<table class="table table-striped table-bordered">
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
				//Total_sales_query
				$sales_query="SELECT * FROM users_items WHERE status='Confirmed' GROUP BY tDate ORDER BY id DESC";
	    		$sales_result=mysqli_query($con,$sales_query) or die(mysqli_error($con));
				$counter=1;
				while($row=mysqli_fetch_array($sales_result)){ 
                   ?>

                <tr>
                  <td></td><td colspan="7"><b><?php echo $row['tDate']?></b></td>
                </tr>

                <?php
                //daily_sales_query
    			$group = $row['tDate'];
  				$sales_query2="SELECT * FROM users_items WHERE status='Confirmed' AND tDate='$group' ORDER BY id DESC";
  				$sales_result2=mysqli_query($con,$sales_query2) or die(mysqli_error($con));
				foreach ($sales_result2 as $row2) {     
                ?>

                <tr>
                  <td style="text-align:center;"><?php echo $counter ?></td>
                  <td style="text-align:center;"><?php echo $row2['iName']?></td>
                  <td style="text-align:center;"><?php echo $row2['item_id']?></td>
                  <td style="text-align:center;"><?php echo $row2['quantity']?></td>
                  <td style="text-align:center;"><?php echo $row2['amount']?></td>
                  <td style="text-align:center;"><?php echo $row2['category']?></td>
                  <td style="text-align:center;"><?php echo $row2['user_id']?></td>
                  <td style="text-align:center;"><?php echo $row2['tTime']?></td>
                </tr>
                    <?php $counter=$counter+1;}?>
                    
			<?php }?>
				
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