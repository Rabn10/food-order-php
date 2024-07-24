<?php

	include('../config/constants.php');

	// echo "Delete food";
	
	if (isset($_GET['id']) && isset($_GET['image_name'])) {
		//Porcess to delete
		// echo "Process to delete";

		//1. get id and image name
		$id = $_GET['id'];
		$image_name = $_GET['image_name']; 

		//2. remove the image if available
		//check whether the iamge is available or not and delete only if available
		if ($image_name != "") {
			//it has image and need from floder
			//get the image path
			$path = "../images/food/".$image_name;

			//Remove image file from floder
			$remove = unlink($path);
			//check whether the image is removed or not
			if ($remove==false) {
				//Falied to Remove image
				$_SESSION['upload'] = "<div class='error'>Falied to remove image </div>";
				header('location:'.SITEURL.'admin/manage-food.php');
				//stop the process 
				die();
			}

		}

		//3.Delete food from database
		$sql = "DELETE FROM tbl_food WHERE id=$id";
		//execute query
		$res = mysqli_query($conn,$sql);

		//check whether the query executed or not and set message respectively
		if ($res==true) {
			//food deleted
			$_SESSION['delete'] = "<div class='sucess'>Food deleted sucessfully</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		}
		else{
			//falied to delte food
			$_SESSION['delete'] = "<div class='error'>Fail to delete food</div>";
			header('location:'.SITEURL.'admin/manage-food.php');
		}
	}
	else{
		//reidrect to manage to Food page
		// echo "Redirect";
		$_SESSION['Unauthorized'] = "<div class='error'>Unauthorized access</div>";
		header('location:'.SITEURL.'admin/manage-food.php');
	}

 ?>