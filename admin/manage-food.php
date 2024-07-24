<?php
	include('partials/menu.php'); 
 ?>

	<!-- Main content section starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Food</h1>

			<br><br>
			<!-- button to add admin -->
			<a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

			<br><br><br>

			<?php

				if (isset($_SESSION['add'])) {
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}

				if (isset($_SESSION['delete'])) {
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
				}

				if (isset($_SESSION['upload'])) {
					echo $_SESSION['upload'];
					unset($_SESSION['upload']);
				}

				if (isset($_SESSION['Unauthorized'])) {
					echo $_SESSION['Unauthorized'];
					unset($_SESSION['Unauthorized']);
				}

				if (isset($_SESSION['update'])) {
					echo $_SESSION['update'];
					unset($_SESSION['update']);
				}

			 ?>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Title</th>
					<th>price</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php

					//create sql query to get all the food 
					$sql = "SELECT * FROM tbl_food";

					//execute query
					$res = mysqli_query($conn,$sql);

					//count rows to check whether we have food or not
					$count = mysqli_num_rows($res);

					$sn=1;

					if ($count>0) {
						//we have food in database
						//get the foods from database and display
						while ($row=mysqli_fetch_assoc($res)) {
							//get the values from individuals columns
							$id = $row['id'];
							$title = $row['title'];
							$price = $row['price'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];
							?>

							<tr>
								<td><?php echo $sn++; ?></td>
								<td><?php echo $title; ?></td>
								<td><?php echo $price; ?></td>
								<td>
									<?php
									//check whether we have image or not
									if ($image_name=="") {
									 	//we do not have image
									 	echo "<div class='error'>image not added</div>";
									 } 

									 else{
									 	//we have iamge, display image
									 	?>

									 	<img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="70px;">

									 	<?php 
									 }
									 ?>
								</td>
								<td><?php echo $featured; ?></td>
								<td><?php echo $active ?></td>
								<td>
									<a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
									<a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
								</td>
							</tr>


							<?php 
						}
					}

					else{
						//we donot hava database
						echo "<tr> <td clospann='7' class='error'>Food mot added yet</td> </tr>";
					}

				 ?>

			</table>

			
		</div>
	</div>
	<!-- main content section ends -->

<?php
	include('partials/footer.php'); 
 ?>
