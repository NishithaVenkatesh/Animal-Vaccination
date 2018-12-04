<<<<<<< HEAD
<html>
<head>
	<title>Animal Vaccination</title>
	<link rel="stylesheet" type="text/css" href="new.css">

	<br><br><br>
	<center><h1> FMD VACCINATION DATABASE </h1></center>
</head>

<body>

	<br><br>
	<center>
	<div class = "box">
		<?php
		
			session_start();

			$db = mysqli_connect('localhost','root','','animal_vaccination')
			or die('Error connecting to MySQL server.');

			if(isset($_POST['submit']))
				echo "Successful";

			$taluk=$_POST['TALUK'] or die ('taluk dead');
			$cattle=$_POST['CATTLE'] or die ('cattle dead');
			$buffalo=$_POST['BUFFALO'] or die ('buffalo dead');
			$pig=$_POST['PIG'];

			$q="SELECT * FROM PLACE WHERE TALUK='$taluk'";
			mysqli_query($db,$q) or die ('dead');
			$result = mysqli_query($db,$q);
			$row = mysqli_fetch_array($result);
			$tid = $row['TID'];
			$dist = $row['DISTRICT'];
			
			
			if(strcasecmp($_SESSION["district"],$dist)==0)
			{
				$select="INSERT INTO TOTAL_LIVESTOCK (TID, CATTLE, BUFFALO, PIG) VALUES('$tid', $cattle, $buffalo, $pig)";
				$db->query($select) or die ("Total Livestock already exists for taluk $taluk");
				echo "Total Livestock added";
			}	
			else
			{
				header("location: add2fail.html");
			}
			

			session_unset();


			session_destroy(); 

		?>
		</div>
		</div>
		<div class="container">
		<a href="main.html"><button>HOME</button></a>
		<a href="add2.html"><button>ADD MORE LIVESTOCK</button></a>
		</div>
	
</body>
</html>
=======
<html>
<head>
	<title>Animal Vaccination</title>

	<style>
	body{
		color: black;
		background-image: url("image.jpg");
		background-repeat: no-repeat;
		background-size: 100%;
		font-size: 20px
	     }
	</style>

	<br><br><br>
	<center><h1> FMD VACCINATION DATABASE </h1></center>
</head>

<body>
	<br><br><br><br>
	<center>
	</center>

	<br><br>
	<center>
		<?php

			$db = mysqli_connect('localhost','root','','animal_vaccination')
			or die('Error connecting to MySQL server.');

			if(isset($_POST['submit']))
				echo "Successful";

			$taluk=$_POST['TALUK'] or die ('taluk dead');
			$cattle=$_POST['CATTLE'] or die ('cattle dead');
			$buffalo=$_POST['BUFFALO'] or die ('buffalo dead');
			$pig=$_POST['PIG'];

			$tid="SELECT TID FROM PLACE WHERE TALUK='$taluk'";
			mysqli_query($db,$tid) or die ('dead');
			$result = mysqli_query($db,$tid);
			$row = mysqli_fetch_array($result);
			$res = $row['TID'];

			$select="INSERT INTO TOTAL_LIVESTOCK (TID, CATTLE, BUFFALO, PIG) VALUES('$res', $cattle, $buffalo, $pig)";
			$db->query($select) or die ("Total Livestock already exists for taluk $taluk");
			echo "Total Livestock added";

		?>

		<br><br>
		<a href="main.html"><button>HOME</button></a>
		<br><br>
		<a href="add2.html"><button>ADD MORE LIVESTOCK</button></a>
	</center>
</body>
</html>
>>>>>>> 840ffaef26e81e2a45c1da10dd33fab5d86bec2f
