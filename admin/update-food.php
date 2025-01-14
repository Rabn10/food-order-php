<?php include('partials/menu.php');?>

<?php
	//Check whether id is set or not
	if (isset($_GET['id'])) 
	{
	 	//get all the details
		$id = $_GET['id'];

		// sql query to get he selected food
		$sql2 = "SELECT * FROM tbl_food WHERE id=$id";
		//execute the query
		$res2 = mysqli_query($conn,$sql2);

		//Get the values based on query executed
		$row2 = mysqli_fetch_assoc($res2);

		//Get the indivual values of selected fodd
		$title = $row2['title'];
		$description = $row2['description'];
		$price = $row2['price'];
		$current_image = $row2['image_name'];
		$current_category = $row2['cateogry_id'];
		$featured = $row2['featured'];
		$active = $row2['active'];
	 } 
	 else
	 {
	 	//Redirect to manage food
	 	header('location:'.SITEURL.'admin/manage-food.php');
	 }
 ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Food</h1>
		<br><br>

		<form action="" method="POST" enctype="multipart/form-data">

			<table class="tbl-30">

				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title" value="<?php echo $title; ?>">
					</td>
				</tr>

				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
					</td>
				</tr>

				<tr>
					<td>price: </td>
					<td>
						<input type="number" name="price" value="<?php echo $price; ?>">
					</td>
				</tr>

				<tr>
					<td>Current_Image: </td>
					<td>
						<?php
							if ($current_image == "") {
								//image not avaialble
								echo "<div class='error'>image not available</div>";
							}
							else
							{
								//image available
								?>
								<img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px">
								<?php  
							}
						 ?>
					</td>
				</tr>

				<tr>
					<td>Select_New_Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">
							<?php
								//Query to get active categories
								$sql = "SELECT * FROM tbl_category WHERE active='yes'";
								//Execute the query
								$res = mysqli_query($conn,$sql);
								//Count rows
								$count = mysqli_num_rows($res);

								//check whther category available or not
								if ($count>0) 
								{
									//Category available
									while ($row=mysqli_fetch_assoc($res)) 
									{
										$category_title = $row['title'];
										$category_id = $row['id'];

										// echo "<option value='$category_id'>$category_title</option>";
										?>

											<option <?php if ($current_category==$category_id) {
												echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

										<?php  
									}
								}
								else
								{
									//category not avaialable
									echo "<option value='0'>Category not available</option>";
								}

							 ?>
						</select>
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input <?php if ($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> yes
						<input <?php if ($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input <?php if ($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> yes
						<input <?php if ($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No
					</td>
				</tr>

				<tr>
					<td>
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

						<input type="submit" name="submit" value="Update Food" class="btn-secondary">
					</td>
				</tr>
					
			</table>		
			
		</form>
		<?php

		if (isset($_POST['submit'])) 
		{
			// echo "button clicked";
			//1. Get all the details from the form
			$id = $_POST['id'];
			$title = $_POST['title'];
			$description = $_POST['description'];
			$price = $_POST['price'];
			$current_iamge = $_POST['current_image'];
			$category = $_POST['category'];
			$featured = $_POST['featured'];
			$active = $_POST['active'];

			//2.upload the image if selected

			//check whether upload button is clicke or not 
			if (isset($_FLIES['image']['name'])) 
			{
				//upload button clicked
				$image_name = $_FLIES['image']['name'];

				//check whether the file is available or not
				if ($image_name!="") 
				{
					//image is available
					//Rename the image
					$ext = end(explode('.', $image_name));

					$image_name = "Food-Name-".rand(0000,9999).'.'.$ext; 

					//get the source path and destaination path
					$src_path = $_FLIES['image']['tmp_name'];
					$dest_path  = "../images/food/".$image_name;

					//upload the image
					$upload = move_uploaded_file($src_path, $dest_path);

					//check whtherh the image is upoad or not
					if ($upload==false) 
					{
						//Falied to upload
						$_SESSION['upload'] = "<div class
						'error'>Falied to upload new image</div>";
						header('location:'.SITEURL.'admin/manage-food.php');
						die();
					}

					//remove current image if avaialble
					if ($current_image!="") 
					{
						//current image isavailable
						//remove the image
						$remove_path = "../images/food/".$current_image;

						$remove = unlink($remove_path);

						//Check whether the image is remove or not
						if ($remove==false) 
						{
							//falied to remove current image
							$_SESSION['remove-falied'] = "<div class='error'>Falied to remove curret iiamge<?div>";
							header('location'.SITEURL.'admin/manage-food/php');
							die();							
						}
					}
				}
				else
				{
					$image_name = $current_image;
				}
			}
			else
			{
			 	$image_name = $current_image;
			}

			//update the food in database
			$sql3 = "UPDATE tbl_food SET
					title = '$title',
					description = '$description',
					price = $price,
					image_name = '$image_name',
					cateogry_id = '$category',
					featured = '$featured',
					active = '$active'
					WHERE id=$id
			";

			// execute the sql query
			$res3 = mysqli_query($conn,$sql3);

			//check  whether the query executed tor not
			if ($res3==true) 
			{
				$_SESSION['update'] = "<div class='sucess'>Food updated sucessfully</div>";
				header('location:'.SITEURL.'admin/manage-food.php');	
			}
			else
			{
				$_SESSION['update'] = "<div class='error'>Failed to update food</div>";
				header('location:'.SITEURL.'admin/manage-food.php');

			}
		}

		 ?>
	</div>
</div>

<?php include('partials/footer.php');?>