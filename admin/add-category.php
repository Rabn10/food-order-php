<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>

		<br><br>

		<?php

			if (isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}

			if (isset($_SESSION['upload'])) {
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}

		 ?>

		 <br><br>

		<!-- form add cateogry starts -->
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title: </td>
					<td>
						<input type="text" name="title" placeholder="Enter title">
					</td>
				</tr>

				<tr>
					<td>Select Image: </td>
					<td>
						<input type="file" name="image">
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
						<input type="submit" name="submit" value="Add category" class="btn-secondary">
					</td>
				</tr>
			</table>			
		</form>
		<!-- end category form -->

		<?php

			//check whether the submit button is clicked or not
			if (isset($_POST['submit'])) {
				//echo "clicked";

				//1. get the value from form
				$title = $_POST['title'];

				//For radio input type we need to check whether the button is selected or not
				if (isset($_POST['featured'])) {
					//gett the value from form
					$featured = $_POST['featured'];
				}
				else{
					//set the default value
					$featured = "No";
				}

				if (isset($_POST['active'])) {
					//gett the value from form
					$active = $_POST['active'];
				}
				else{
					//set the default value
					$active = "No";
				}

				//check whether the image is selected or not 
				// print_r($_FILES['image']);

				if (isset($_FILES['image']['name'])) {
					//upload image
					//to upload image we need image name,sourece path and destaination path
					$image_name = $_FILES['image']['name'];
					//upload image
					if ($image_name != "") {
						
						
						//auto rename our image
						//get the extension of our image (jpg,png,gif)
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
							//redirected to add category page
							header('location:'.SITEURL.'admin/add-category.php');
							//stop the process
							die();
						}
					}

				}

				else{
					//don't upload image and set the image name value as blank
					$image_name="";
				}

				// die();//break the code here

				//2. sql query to insert data
				$sql = "INSERT INTO tbl_category SET
					title = '$title',
					image_name = '$image_name',
					featured = '$featured',
					active = '$active'
				";

				//3. Execute the query and save in database 
				$res = mysqli_query($conn,$sql);

				//4. check whether the query is executed or not and data added or not
				if ($res==true) {
					//query executed and insert data
					$_SESSION['add'] = "<div class='sucess'>Category added successfully</div>";
					//redirect to manage category page
					header('location:'.SITEURL.'admin/manage-category.php');

				}
				else{
					//query not executed
					$_SESSION['add'] = "<div class='error'>failed to added category</div>";
					//redirect to manage category page
					header('location:'.SITEURL.'admin/add-category.php');
				}
			}
		 ?>

	</div>
</div>

<?php include('partials/footer.php'); ?>