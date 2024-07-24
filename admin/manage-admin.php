<?php
	include('partials/menu.php'); 
 ?>

	<!-- Main content section starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Admin</h1>

			<br>

			<?php
				if (isset($_SESSION['add'])) {
					echo $_SESSION['add'];//displaying session message
					unset($_SESSION['add']); //remmoving session message
				}

				if (isset($_SESSION['delete'])) {
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
				}

			 ?>
			 <br><br><br>
			<!-- button to add admin -->
			<a href="add-admin.php" class="btn-primary">Add Admin</a>

			<br><br><br>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Action</th>
				</tr>

				<?php
					//query to get all admin
					$sql = "SELECT * FROM tbl_admin"; 
					//Excute the query
					$res = mysqli_query($conn,$sql);
					//Check whether the query ise executed or not
					if ($res==TRUE) {
						//Count rows to check whether we have data in database or not
						$count = mysqli_num_rows($res);// function to get all the rows in database 
						//check the num of rows
						if ($count>0) {
							//We hava data in database
							
							$sn=1;//create a varable and assign the value 

							while ($rows=mysqli_fetch_assoc($res)) {
								//using while loop to get all the data in databse 
								//And while loop will run as long as data in database

								//get individual data
								$id = $rows['id'];
								$full_name = $rows['full_name'];
								$username = $rows['username'];
								//display the values in our table
								?>

								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $full_name; ?></td>
									<td><?php echo $username; ?></td>
									<td>
										<a href="#" class="btn-secondary">Update Admin</a>
										<a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
									</td>
								</tr>


								<?php
							}
						}
						else
						{
							//We do not have data in database 
						}
					}

				 ?>
				
			</table>
			
		</div>
	</div>
	<!-- main content section ends -->

<?php
	include('partials/footer.php'); 
 ?>

