
<?php
			if (isset($_SESSION['login'])) {
			 		echo $_SESSION['login'];
			 		unset($_SESSION['login']);
			 	} 	
		 ?>	

<?php echo "user dashbord"; ?>