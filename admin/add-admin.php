<?php include('partials/menu.php'); ?>

<div class="main-content">
	<div class="wrapper">
		<h1>Add Admin</h1>

		<br><br>

		<?php
			if (isset($_SESSION['add']))//checking whether the session is set or not 
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}

		 ?>

		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
					<td>Full Name: </td>
					<td>
						<input type="text" name="full_name" placeholder="Enter name">
					</td>
				</tr>

				<tr>
					<td>Username: </td>
					<td>
						<input type="text" name="username" placeholder="Enter username">
					</td>
				</tr>

				<tr>
					<td>Password: </td>
					<td>
						<input type="password" name="password" placeholder="Enter password">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php include('partials/footer.php'); ?>

<?php

	//process the value from Form and save it in Database

	//Check wether the button is clicked or not

	if (isset($_POST['submit'])) {
		//button clicked
		//echo "button clicked";

		//Get the Data from form
		$full_name = $_POST['full_name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		//SQL Query to save the data into database
		$sql = "INSERT INTO tbl_admin SET
			full_name = '$full_name',
			username = '$username',
			password = '$password' 
		";

		//3. executing query and saving data into database
		$res = mysqli_query($conn,$sql) or die(mysqli_error());

		//4. check whether the(query is executed)  data is inserted or not and display message
		if ($res==TRUE) {
			//Data inserted
			//echo "Data inserted";
			//Create a session variable to display message
			$_SESSION['add'] = "<div class='sucess'>Admin Added successfully</div>";
			//redireced page to manage admin
			header("location:".SITEURL.'admin/manage-admin.php');
		}
		else
		{
			//failed to insert data
			//echo "Failed to insert data";
			$_SESSION['add'] = "<div class='error'>Falied to add admin</div>";
			//redireced page to manage admin
			header("location:".SITEURL.'admin/add-admin.php');
		}
	}

 ?>