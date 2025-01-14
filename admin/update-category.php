<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>update category</h1>

		<br><br>

		<?php 

			//check wheterh id is set or not
			if (isset($_GET['id'])){
				//Get the id and all other detials
				// echo "getting the data";
				$id = $_GET['id'];
				//create sql query to get all other details
				$sql = "SELECT * FROM tbl_category WHERE id=$id";
				//Execute the query
				$res = mysqli_query($conn,$sql);

				//count the rows to check whether the id is valid or not
				$count = mysqli_num_rows($res);

				if ($count==1) {
					//Get all the data 
					$row = mysqli_fetch_assoc($res);
					$title = $row['title'];
					$current_image = $row['image_name'];
					$featured = $row['featured'];
					$active = $row['active'];
				}
				else{
					//redirect to manage category page
					$_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}
			}
			else{
				//redirect to mage category
				header('location:'.SITEURL.'admin/manage-category.php');
			}

		 ?>
		<form action="" method="POST" enctype="multipart/form-data">

			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" value="<?php echo $title; ?>">
					</td>
				</tr>

				<tr>
					<td>Current Image: </td>
					<td>
						<?php
							if ($current_image != "") {
							 	//display image
							 	?>

							 	<img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">


							 	<?php 
							 } 
							 else{
							 	//messsage 
							 	echo "<div class='error'>Image not found</div>";
							 }
						 ?>
					</td>
				</tr>

				<tr>
					<td>New Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>

				<tr>
					<td>Featured: </td>
					<td>
						<input <?php if ($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

						<input <?php if ($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
					</td>	
				</tr>

				<tr>
					<td>Active: </td>
					<td>
						<input <?php if ($active == "Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
						
						<input <?php if ($active == "No"){echo "checked";} ?> type="radio" name="active" value="No"> No
					</td>	
				</tr>

				<tr>
					<td>
						<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="update category" class="btn-secondary">			
					</td>

				</tr>

			</table>
		</form>

		<?php

			if (isset($_POST['submit'])) {
				//echo "clicked";

				//1.Get all the values from our form
				$id = $_POST['id'];
				$title = $_POST['title'];
				$current_name = $_POST['current_name'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];

				//2.updating new image
				//check whether the image is selected or not
				if (isset($_FILES['image']['name'])) {
					//get the image details
					$image_name = $_FILES['image']['name']; 

					//check whether the image is available or not
					if ($image_name!="") {
						//image is available
						//A. upload the new image
						$ext = end(explode('.', $image_name));

						//rename the iamge 
						$image_name = "Food_category_".rand(000,999).'.'.$ext;

						

						$source_path = $_FILES['image']['tmp_name'];

						$destination_path = "../images/category/".$image_name;

						//upload the image
						$upload = move_uploaded_file($source_path, $destination_path);

						//check whether the image is upload or not
						//and if the image is not uploaded then when will stop the process and redirected with error message
						if ($upload==false) {
							//set message
							$_SESSION['upload'] = "<div class='error'>failed to upload image</div>";
							//redirected to manage category page
							header('location:'.SITEURL.'admin/manage-category.php');
							//stop the process
							die();
						}
						//remove the current image
						if ($current_image!="") {
							$remove_path = "../images/category/".$current_image;

							$remove = unlink($remove_path);

							//check whether the image is remove or not 
							//if failed to remove then display message and stop the proces
							if ($remove==false) {
								//failed to remove iamge
								$_SESSION['falied-remove'] = "<div class='error'>falied to remove current image</div>";
								header('location'.SITEURL.'admin/manage-category.php');
								die();//stop the process
							}
						}
						
					}

					else
					{
						$image_name = $current_image;
					}
				}

				else{
					$image_name = $current_image;
				}

				//3.undate the database
				$sql2 = "UPDATE tbl_category SET 
						title = '$title',
						image_name = '$image_name',
						featured = '$featured',
						active = '$active'
						WHERE id=$id
				";

				//execute the query
				$res2 = mysqli_query($conn,$sql2); 

				//4.redirected to manage category page
				//check whether execute or not
				if ($res2==true) {
					//category update
					$_SESSION['update'] = "<div class='sucess'>Update category sucessflly</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}
				else{
					$_SESSION['update'] = "<div class='error'>falied to update category</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}

			}

		 ?>
	</div>
</div>

<?php include('partials/footer.php'); ?>