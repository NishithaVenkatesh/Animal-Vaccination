<<<<<<< HEAD
<html>
	<head>
	</head>
	
	<body>
		<?php
			session_start();
			
			$dis = $_POST['dis'];
			$password = $_POST['psw'];
			
			$_SESSION["district"] = $dis;
			
			$db = mysqli_connect("localhost","root","","Animal_Vaccination");
			
			$q = "SELECT * FROM Login WHERE DISTRICT = '$dis' AND PASSWORD = '$password'";
			$result = mysqli_query($db,$q)
					  or die("Failed to query database");
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $count = mysqli_num_rows($result);
			 
			 if($count == 1) {
				header("location: main.html");
			}else {
				echo "Your Login Name or Password is invalid";
				header("location: loginfail.html");
				
			}
			
		?>
	</body>
=======
<html>
	<head>
	</head>
	
	<body>
		<?php
			$dis = $_POST['dis'];
			$password = $_POST['psw'];
			
			$db = mysqli_connect("localhost","root","","Animal Vaccination");
			
			$q = "SELECT * FROM Login WHERE DISTRICT = '$dis' AND PASSWORD = '$password'";
			$result = mysqli_query($db,$q)
					  or die("Failed to query database");
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			 $count = mysqli_num_rows($result);
			 
			 if($count == 1) {
				header("location: main.html");
			}else {
				echo "Your Login Name or Password is invalid";
				header("location: loginfail.html");
				
			}
			
		?>
	</body>
>>>>>>> 840ffaef26e81e2a45c1da10dd33fab5d86bec2f
</html>