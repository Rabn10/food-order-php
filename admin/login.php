<?php 	include('../config/constants.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login- Food order system</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>

	<div class="login">
		<h1 class="text-center">Login</h1>
		<br><br>	

		<?php
			if (isset($_SESSION['login'])) {
			 		echo $_SESSION['login'];
			 		unset($_SESSION['login']);
			 	} 	
		 ?>	

		 <?php
			if (isset($_SESSION['no-login-message'])) {
			 		echo $_SESSION['no-login-message'];
			 		unset($_SESSION['no-login-message']);
			 	} 	
		 ?>
		 <br><br>	

		<form action=""	method="POST" class="text-center">
			Username: <br>	
			<input type="text" name="username" placeholder="Enter username"> <br> <br>	
			Password: <br>			
			<input type="password" name="password" placeholder="Enter password"> <br> <br>	

			<input type="submit" name="submit" value="Login" class="btn-primary">
		</form>
		<p class="text-center">Created By <a href="#">Admin</a></p>
	</div>

</body>
</html>

<?php

	//check whether submit button is clicked or not
	if (isset($_POST['submit'])) {
		//process for login
		//1.Get data from login form
		$username = $_POST['username'];
	 	$password = md5($_POST['password']);

	 	//2. SQL query to check whether the username and password exit or not
	 	$sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

	 	//3. execute the query
	 	$res = mysqli_query($conn,$sql);

	 	//4. count rows to check whether the user exit or not
	 	$count = mysqli_num_rows($res);

	 	if ($count==1) {
	 		//user avaiable
	 		$_SESSION['login'] = "<div class='sucess'>Login successful</div>";
	 		$_SESSION['user'] = $username; // to checek whether user is login or not

	 		//Redirect to home page
	 		header('location:'.SITEURL.'admin/');
	 	}
	 	else{
	 		//user not found
	 		$_SESSION['login'] = "<div class='error'>Falied to login</div>";
	 		//Redirect to home page
	 		header('location:'.SITEURL.'admin/login.php');
	 	}
	}

 ?>