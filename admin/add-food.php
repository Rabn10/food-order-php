<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Food</h1>

		<br><br>

		<?php

			if (isset($_SESSION['upload'])) {
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}

		 ?>

		<form action="" method="POST" enctype="multipart/form-data">
			
			<table class="tbl-30">
				
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="enter title">
					</td>
				</tr>

				<tr>
					<td>Description: </td>
					<td>
						<textarea name="description" cols="30" rows="5" placeholder="Enter description"></textarea>
					</td>
				</tr>

				<tr>
					<td>Price: </td>
					<td>
						<input type="number" name="price">
					</td>
				</tr>

				<tr>
					<td>Select_Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Category: </td>
					<td>
						<select name="category">

							<?php

								//Create PHP code to display category from database
								//1. Create sql to get all active categories from data baase
								$sql = "SELECT * FROM tbl_category WHERE active='Yes'";
								//exeuting query
								$res = mysqli_query($conn,$sql);

								//count rows to check whether we have categories or not 
								$count = mysqli_num_rows($res);
								//if count is greater than 0 we have categories 
								if ($count>0) {
									//we have categories 
									while ($row=mysqli_fetch_assoc($res)) {
										//get the details of category
										$id = $row['id'];
										$title = $row['title'];
										?>

										<option value="<?php echo $id; ?>"><?php echo $title; ?></option>

										<?php 
									}
								}
								else{
									//we donot have categories
									?>
									<option value="0">No category found</option>
									<?php 
								}

								//display on dropdown

							 ?>

							
						</select>
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input type="radio" name="featured" value="Yes"> Yes
						<input type="radio" name="featured" value="No"> No
					</td>
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input type="radio" name="active" value="Yes"> Yes
						<input type="radio" name="active" value="No"> No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Food" class="btn-secondary">
					</td>
				</tr>

			</table>			

		</form>

		<?php
			//check whether the button is clicked or not
			if (isset($_POST['submit'])) {
				//Add the food in database
				// echo "add food";

				//1. Get the data from form
				$title = $_POST['title'];
				$description = $_POST['description'];
				$price = $_POST['price'];
				$category = $_POST['category'];
				
				//checked whether radio button for ffeatured and active checked or not
				if (isset($_POST['featured'])) {
					$featured = $_POST['featured'];
				}
				else{
					$featured = "No";//setting the default avalue
				}

				if (isset($_POST['active'])) {
					$active = $_POST['active'];
				}
				else{
					$active = "No";//setting the default avalue
				}


				//2.upload the image if selected
				//cehck whether the select image is clicked or not and upload the image only if the image is selected
				if (isset($_FILES['image']['name'])) {
					//get the details of the selected image
					$image_name = $_FILES['image']['name'];

					//check whether the image is selected or not and upload image only if selected
					if ($image_name!= "") {
						//image is selected 
						//a. renamed the image
						//get the extension of selected image like jpg,png
						$ext = end(explode('.', $image_name));

						//create new name for image
						$image_name = "Food-name-".rand(0000,9999).".".$ext;

						//b.upload the image
						//Get the source path and destination path
						//source path is th currentlocation of hte image
						$src = $_FILES['image']['tmp_name'];

						$dst = "../images/food/".$image_name;

						//upload food image
						$upload = move_uploaded_file($src, $dst);

						//check whether image is upload or not
						if ($upload==false) {
							//Failed to uplod image
							$_SESSION['upload'] = "<div class='error'>falied to upload image</div>";
							//Redirect to add food page with error message
							header('location'.SITEURL.'admin/add-food.php');
							//stop the preocess
							die();
						}
					}
				}
				else{
					$image_name = "";//setting default value as blank
				}

				//3. Insert into database

				//create a sql query to save or add food
				$sql2 = "INSERT INTO tbl_food SET
						title = '$title',
						description = '$description',
						price = $price,
						image_name = '$image_name',
						category_id = '$category',
						featured = '$featured',
						active = '$active'  
				";

				//execute the query
				$res2 = mysqli_query($conn,$sql2);
				//check whether data insertd or not
				if ($res2 == true) {
					//Data inserted successfully
					$_SESSION['add'] = "<div class='sucess'>Data inserted successfully</div>";
					header('location:'.SITEURL.'admin/manage-food.php');
				}
				else
				{
					//falied to insert data
					$_SESSION['add'] = "<div class='error'>failed to insert food</div>";
					header('location:'.SITEURL.'admin/manage-food.php');
				}

			}

		 ?>

	</div>
</div>


<?php include('partials/footer.php'); ?>