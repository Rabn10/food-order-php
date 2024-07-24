<?php
	include('partials/menu.php'); 
 ?>

	<!-- Main content section starts -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Category</h1>
			<br><br>
			<!-- button to add admin -->
			<a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

			<br><br><br>

			<?php

			if (isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}

			if (isset($_SESSION['remove'])) {
				echo $_SESSION['remove'];
				unset($_SESSION['remove']);
			}

			if (isset($_SESSION['delete'])) {
				echo $_SESSION['delete'];
				unset($_SESSION['delete']);
			}

			if (isset($_SESSION['no-category-found'])) {
				echo $_SESSION['no-category-found'];
				unset($_SESSION['no-category-found']);
			}

			if (isset($_SESSION['update'])) {
				echo $_SESSION['update'];
				unset($_SESSION['update']);
			}

			if (isset($_SESSION['upload'])) {
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}

		 ?>
		 <br>

			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Title</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>

				<?php

					$sql = "SELECT * FROM tbl_category";

					//execute query
					$res = mysqli_query($conn,$sql);

					//count rows
					$count = mysqli_num_rows($res);

					//create serial number variable
					$sn=1;

					//check data in databse
					if ($count>0) {
						while ($row = mysqli_fetch_assoc($res)) {
							$id = $row['id'];
							$title = $row['title'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];

							?>
							<tr>
								<td><?php echo $sn++; ?></td>
								<td><?php echo $title ?></td>

								<td>
									<?php
										//check whether image name is available or not 
										if ($image_name!="") {
										 	//display image
										 	?>

										 	<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">

										 	<?php
										 } 
										 else{
										 	//display message
										 	echo "<div class='error'>Image not added</div>";
										 }
									?>	
								</td>

								<td><?php echo $featured; ?></td>
								<td><?php echo $active; ?></td>
								<td>
									<a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
									<a href="<?php echo SITEURL; ?>admin/delete-category.php?id= <?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
								</td>
							</tr>

							<?php 
						}
					}
					else{
						//we dont have data
						//we will display the message inside table
						?>
						<tr>
							<td colspan="6"><div class="error">No cateogry added</div></td>
						</tr>
						<?php 
					}

				 ?>

				
			</table>
			
		</div>
	</div>
	<!-- main content section ends -->

<?php
	include('partials/footer.php'); 
 ?>

