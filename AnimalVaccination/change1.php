<html>
<head>
	<title>Animal Vaccination</title>
	<link rel="stylesheet" type="text/css" href="new.css">
	<!--<style>
	body{
		color: black;
		background-image: url("image.jpg");
		background-repeat: no-repeat;
		background-size: 100%;
		font-size: 20px
	     }

	
	.button	{
   	 	background-color: black;
    		border: none;
    		color: white;
    		padding: 5px 15px;
    		text-align: center;
    		text-decoration: none;
    		display: inline-block;
    		font-size: 16px;
    		margin: 4px 2px;
    		cursor: pointer;
		}
	</style>-->

	<br><br>
	<center><h1>CHANGE TOTAL LIVESTOCK</h1></center>
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

			$cattle1="SELECT CATTLE FROM TOTAL_LIVESTOCK WHERE TID='$tid'";
			mysqli_query($db,$cattle1) or die('dead');
			$result1=mysqli_query($db,$cattle1);
			$row1=mysqli_fetch_array($result1);
			$res1=$row1['CATTLE'];
			
			if(strcasecmp($_SESSION["district"],$dist)==0)
			{
				if( $res1 != NULL)
				{	
					$select="UPDATE TOTAL_LIVESTOCK SET CATTLE=$cattle, BUFFALO=$buffalo, PIG=$pig WHERE TID='$tid'";
					$db->query($select) or die ('dead....');
					echo "Total Livestock changed";
				}
				else
				{
					echo "Error; Total Livestock doesn't exist";
				}
			}
			else
			{
				header("location: change1fail.html");
			}
		?>	
		
		</div>
		<div class="container">
		<a href="main.html"><button>HOME</button></a>
		<a href="change1.html"><button>CHANGE MORE LIVESTOCK</button></a>
		</div>
</body>
</html>