<?php
	//include constants file
	include('../config/constants.php');
	//check whether the id and image_name is set or not
	if (isset($_GET['id']) AND isset($_GET['image_name'])) {
		//get the value and delete
		// echo "GEt value and delete";
		$id = $_GET['id'];
		$image_name = $_GET['image_name'];

		//remove the physical image file is available
		if ($image_name != "") {
			//image is Avaialble. so remove it
			$path = "../images/category/".$image_name;
			//remove the image
			$remove = unlink($path);

			//if failed to removed image then add an error messge and stop the process
			if ($remove== false) {
				//set the session message
				$_SESSION['remove'] = "<div class='error'>Falied to remove category image</div>";
				//redirect to manage category page
				header('location:'.SITEURL.'admin/manage-category.php');
				//stop the process
				die();
			}
		}

		//Delete data from database
		//query to detel dat from database
		$sql = "DELETE FROM tbl_category WHERE id=$id";

		//execute the query
		$res = mysqli_query($conn,$sql);

		//check whether the data is delete from database or not
		if ($res==true) {
			//set sucesss message and redirect
			$_SESSION['delete']="<div class='sucess'>category deleted sucessfully</div>";
			header('location:'.SITEURL.'admin/manage-category.php');
		}
		else{
			//set falied message and redirect
			$_SESSION['delete']="<div class='error'>falied to delete category</div>";
			header('location:'.SITEURL.'admin/manage-category.php');
		}
		}

	else
	{
		//redirect to Manage category page
		header('location:'.SITEURL.'admin/manage-category.php');
	}

 ?>