<html>
<head>
	<title>Animal Vaccination</title>
	<link rel="stylesheet" type="text/css" href="new.css">
	

	<br><br>
	<center><h1>CHANGE MAN POWER</h1></center>
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
			$teams=$_POST['NUMBER_OF_TEAMS'] or die ('teams dead');
			$days=$_POST['NUMBER_OF_DAYS'] or die ('days dead');

			$q="SELECT * FROM PLACE WHERE TALUK='$taluk'";
			mysqli_query($db,$q) or die ('dead');
			$result = mysqli_query($db,$q);
			$row = mysqli_fetch_array($result);
			$tid = $row['TID'];
			$dist = $row['DISTRICT'];

			$team="SELECT TEAMS FROM MAN_POWER WHERE TID='$tid'";
			mysqli_query($db,$team) or die ('dead');
			$result1 = mysqli_query($db,$team);
			$row1 = mysqli_fetch_array($result1);
			$res1 = $row1['TEAMS'];

			if(strcasecmp($_SESSION["district"],$dist)==0)
			{
				if($res1 != NULL)
				{
					$select="UPDATE MAN_POWER SET TEAMS=$teams, DAYS=$days WHERE TID='$tid'";
					$db->query($select) or die ('dead');
					echo "Man Power changed";
				}
				else
				{
					echo "Error; Man Power doesn't exist";
				}
			}
			else
			{
				header("location: change3fail.html");
			}

		?>
	</center>

	</div>
		<div class="container">
		<a href="main.html"><button>HOME</button></a>
		<a href="change3.html"><button>CHANGE MORE LIVESTOCK</button></a>
		</div>
</body>
</html>
