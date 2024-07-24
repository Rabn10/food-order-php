<?php 	include('../config/constants.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Signup- Food order system</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>

	<div class="login">
		<h1 class="text-center">Sign up</h1>
		<br><br>	

		<?php
			if (isset($_SESSION['add'])) {
			 		echo $_SESSION['add'];
			 		unset($_SESSION['add']);
			 	} 	
		 ?>	

		 
		 <br><br>	

		<form action=""	method="POST" class="text-center">
            FullName: <br>
            <input type="text" name="full_name" placeholder="Enter name"> <br> <br>
			Username: <br>	
			<input type="text" name="username" placeholder="Enter username"> <br> <br>	
			Password: <br>			
			<input type="password" name="password" placeholder="Enter password"> <br> <br>	

			<input type="submit" name="submit" value="Sign up" class="btn-primary">
		</form> <br>
		<p class="text-center">Created By <a href="#">Admin</a></p>
	</div>

</body>
</html>

<?php

	//check whether submit button is clicked or not
	if (isset($_POST['submit'])) {
		//process for login
		//1.Get data from login form
        $full_name = $_POST['full_name'];
		$username = $_POST['username'];
	 	$password = md5($_POST['password']);

	 	// 2. SQL query to check whether the username and password exit or not
	 	$sql = "INSERT INTO tbl_user SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

	 	//3. execute the query
	 	$res = mysqli_query($conn,$sql);

	 	//4. count rows to check whether the user exit or not
	 	$count = mysqli_num_rows($res);

	 	if ($res==true) {
            //query executed and insert data
            $_SESSION['add'] = "<div class='sucess'>Account created sucessfully</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'user/user-signup.php');

        }
        else{
            //query not executed
            $_SESSION['add'] = "<div class='error'>failed to created account</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'user/user-signup.php');
        }
	}

 ?>