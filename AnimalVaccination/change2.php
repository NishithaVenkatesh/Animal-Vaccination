<html>
<head>
	<title>Animal Vaccination</title>
	<link rel="stylesheet" type="text/css" href="new.css">

	<br><br>
	<center><h1>CHANGE VACCINATED LIVESTOCK</h1></center>
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

			$taluk=$_POST['TALUK'];
			$cattle=$_POST['CATTLE'];
			$buffalo=$_POST['BUFFALO'];
			$pig=$_POST['PIG'];
			
			$q="SELECT * FROM PLACE WHERE TALUK='$taluk'";
			mysqli_query($db,$q) or die ('dead');
			$result = mysqli_query($db,$q);
			$row = mysqli_fetch_array($result);
			$tid = $row['TID'];
			$dist = $row['DISTRICT'];

			$cattle2="SELECT VCATTLE FROM VACCINATED_LIVESTOCK WHERE TID='$tid'";
			$result1 = mysqli_query($db,$cattle2) or die('dead');
			$row1 = mysqli_fetch_array($result1);
			$res1 = $row1['VCATTLE'];

			$cattle1="SELECT CATTLE FROM TOTAL_LIVESTOCK WHERE TID='$tid'";
			$result2 = mysqli_query($db,$cattle1) or die('dead');
			$row2 = mysqli_fetch_array($result2);
			$res2 = $row2['CATTLE'];

			$buffalo1="SELECT BUFFALO FROM TOTAL_LIVESTOCK WHERE TID='$tid'";
			$result3 = mysqli_query($db,$buffalo1) or die('dead');
			$row3 = mysqli_fetch_array($result3);
			$res3 = $row3['BUFFALO'];
			
			$pig1="SELECT PIG FROM TOTAL_LIVESTOCK WHERE TID='$tid'";
			$result4 = mysqli_query($db,$pig1) or die('dead');
			$row4 = mysqli_fetch_array($result4);
			$res4 = $row4['PIG'];
			
			if(strcasecmp($_SESSION["district"],$dist)==0)
			{
				if($res1!=NULL)
				{
					if($cattle<=$res2 && $buffalo<=$res3 && $pig<=$res4)
					{
						$select="UPDATE VACCINATED_LIVESTOCK SET VCATTLE=$cattle, VBUFFALO=$buffalo, VPIG=$pig WHERE TID='$tid'";
						$db->query($select) or die ('dead');
						echo "Vaccinated Livestock changed";
					}
					else
					{
						echo "Error; Vaccinated Livestock greater than Total Livestock";
					}
				}
				else
				{
					echo "Error; Vaccinated Livestock doesn't exist";
			
				}
			}
			else
			{
				header("location: change2fail.html");
			}
		
		?>
	</center>
		
	</div>
		<div class="container">
		<a href="main.html"><button>HOME</button></a>
		<a href="change2.html"><button>CHANGE MORE LIVESTOCK</button></a>
		</div>
</body>
</html>
