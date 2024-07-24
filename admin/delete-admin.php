<?php

	include("../config/constants.php");

	//1. get the id of admin to be deleted
	$id = $_GET['id'];
	
	//2. create sql query to delete admin
	$sql = "DELETE FROM tbl_admin WHERE id = $id";

	//execute the query
	$res = mysqli_query($conn,$sql);

	//check whether the query is executed or not
	if ($res==true) {
		//query executed successfully and admin delete
		//echo "Admin deleted successfully";
		//create session variable to display message
		$_SESSION['delete'] = "<div class='sucess'>Admin deleted successfully</div>";
		//redirected to manage admin page
		header('location:'.SITEURL.'admin/manage-admin.php');
	}
	else{
		//fail to delte admin
		//echo "falied to deteled admin";
		//create session variable to display message
		$_SESSION['delete'] = "<div class='error'>failed to delete admin</div>";
		//redirected to manage admin page
		header('location:'.SITEURL.'admin/manage-admin.php');
	}

	//3. redirected to manage admin page with message
 ?>