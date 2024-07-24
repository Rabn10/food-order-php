<?php
	include('partials/menu.php'); 
 ?>

	<!-- Main content section starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Order</h1>

			<br><br><br>

			<?php
			if(isset($_SESSION['update']))
			{
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}

			?>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Food</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Total</th>
					<th>Order_date</th>
					<th>Status</th>
					<th>Customer_name</th>
					<th>Customer_contact</th>	
					<th>customer_email</th>	
					<th>customer_address</th>
					<th>Action</th>	

				</tr>

				<?php
				
				//get all the orders from database
				$sql = "SELECT * FROM tbl_order";
				$res = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($res);
				$sn = 1;
				if($count>0)
				
				{
					while($row = mysqli_fetch_assoc($res))
					{
						$id = $row['id'];
						$food = $row['food'];
						$price = $row['price'];
						$qty = $row['qty'];
						$total = $row['total'];
						$order_date = $row['order_date'];
						$status = $row['status'];
						$customer_name = $row['customer_name'];
						$customer_contact = $row['customer_contact']; 
						$customer_email = $row['customer_email']; 
						$customer_address = $row['customer_address'];
						
						?>

						<tr>
							<td><?php echo $sn++;?></td>
							<td><?php echo $food;?></td>
							<td><?php echo $price;?></td>
							<td><?php echo $qty;?></td>
							<td><?php echo $total;?></td>
							<td><?php echo $order_date;?></td>

							<td>
							<?php
							if($status="ordered")
							{
								echo "<label>$status</label>";
							} 
							elseif($status="on delivery")
							{
								echo "<label sytle='color:orange;'>$status</label>";
							}
							elseif($status="delivered")
							{
								echo "<label sytle='color:green;'>$status</label>";
							}
							elseif($status="cancelled")
							{
								echo "<label sytle='color:red;'>$status</label>";
							}
							?>
							</td>

							<td><?php echo $customer_name;?></td>
							<td><?php echo $customer_contact;?></td>
							<td><?php echo $customer_email;?></td>
							<td><?php echo $customer_address;?></td>

							<td>
								<a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
							</td>
						</tr>

						<?php
					}
				}
				else
				{
					echo "<tr><td col='12', class='error'>Order not available</tr></td>";
				}

				?>

			</table>

			
		</div>
	</div>
	<!-- main content section ends -->

<?php
	include('partials/footer.php'); 
 ?>

