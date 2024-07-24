<?php 
	//authorization - access control
	//check whether the user is log in or not
	if (!isset($_SESSION['user']))//if user session is not set 
	{
		//user is not login
		//redirected to login page with message
		$_SESSION['no-login-message'] = "<div class='error'>plese login to accesss admin</div>";
		header('location:'.SITEURL.'admin/login.php');
	}

 ?>