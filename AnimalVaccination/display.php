<?php
	session_start();

	$db = mysqli_connect('localhost','root','','animal_vaccination')
 	or die('Error connecting to MySQL server.');

	if(isset($_POST['submit']))
		echo "successful";

	$dist=$_SESSION['district'];

	$x="SELECT TID FROM PLACE WHERE DISTRICT='$dist'";
	$results = mysqli_query($db,$x) or die ('dead');
	$rows = mysqli_fetch_array($results);
	$tid = $rows['TID'];
	$num=count(
	
	$y="SELECT TOTAL FROM TOTAL_LIVESTOCK WHERE TID='$tid'";
	$result1 = mysqli_query($db,$y) or die ('dead');
	$row1 = mysqli_fetch_array($result1);
	$tot = $row1['TOTAL'];

	$z="SELECT VTOTAL FROM VACCINATED_LIVESTOCK WHERE TID='$tid'";
	$result2 = mysqli_query($db,$z) or die ('dead');
	$row2 = mysqli_fetch_array($result2);
	$vtot = $row2['VTOTAL'];	

	$a="SELECT DAYS FROM MAN_POWER WHERE TID='$tid'";
	$result3 = mysqli_query($db,$a) or die ('dead');
	$row3 = mysqli_fetch_array($result3);
	$tea = $row3['DAYS'];	

	if(($tot==NULL) && ($vtot==NULL) && ($tea==NULL))
	{
		$sql="UPDATE TOTAL_LIVESTOCK SET CATTLE=0, BUFFALO=0, PIG=0, TOTAL=0 WHERE TID='$tid'";
		$ret=mysqli_query($db,$sql);
		$sql1="UPDATE VACCINATED_LIVESTOCK SET VCATTLE=0, VBUFFALO=0, VPIG=0, VTOTAL=0 WHERE TID='$tid'";
		$ret1=mysqli_query($db,$sql1);
		$sql2="UPDATE MAN_POWER SET TEAMS=0, DAYS=0 WHERE TID='$tid'";
		$ret2=mysqli_query($db,$sql2);
	}

	$getinfo ="SELECT P.TALUK, T.CATTLE, T.BUFFALO, T.PIG, T.TOTAL, V.VCATTLE, V.VBUFFALO, V.VPIG, V.VTOTAL, P1.PERC, M.TEAMS, M.DAYS FROM PLACE P, 			TOTAL_LIVESTOCK T, VACCINATED_LIVESTOCK V, PERCENTAGE P1, MAN_POWER M WHERE M.TID=P1.TID AND P1.TID=V.TID AND V.TID=T.TID AND T.TID=P.TID AND 	P.DISTRICT='$dist'";
	$result = mysqli_query($db, $getinfo) or die('dead');
	
?>

<html>
<head>
	<title>Animal Vaccination</title>
	

	<style>

	body{
		color: black;
		background-image: url("image1.jpg");
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
	</style>

	<br><br><br><br><br>
	<center><h1>FMD VACCINATION DATABASE</h1></center>
</head>

<body>
	<center>
		<table border="2" border-color="black">
		<tr><td>DISTRICT: </td>
		<td><?php echo ("{$_SESSION['district']}"); 
		?></td></tr>
		<br>

		<tr><td rowspan="2">TALUK</td>
		<td colspan="4">TOTAL LIVESTOCK</td>
		<td colspan="4">VACCINATED LIVESTOCK</td>
		<td rowspan="2">PERCENTAGE VACCINATED</td>
		<td colspan="2">MAN POWER</td></tr>
		
		<tr><td>CATTLE</td>
		<td>BUFFALO</td>
		<td>PIG</td>
		<td>TOTAL</td>
		<td>CATTLE</td>
		<td>BUFFALO</td>
		<td>PIG</td>
		<td>TOTAL</td>
		<td>NO. OF TEAMS</td>
		<td>NO.OF DAYS</td></tr>		
	
		<?php
		$num_results = count($result);
		if($num_results>=0)
		{
			 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		?>

       		<tr><td><?php echo $row['TALUK']?></td>
		<td><?php echo $row['CATTLE']?></td>
		<td><?php echo $row['BUFFALO']?></td>
		<td><?php echo $row['PIG'] ?></td>
		<td><?php echo $row['TOTAL']?></td>
		<td><?php echo $row['VCATTLE']?></td>
		<td><?php echo $row['VBUFFALO']?></td>
		<td><?php echo $row['VPIG']?></td>
		<td><?php echo $row['VTOTAL']?></td>
		<td><?php echo $row['PERC']?></td>
		<td><?php echo $row['TEAMS']?></td>
		<td><?php echo $row['DAYS']?></td></tr>

		if(TID==NULL)
		
		<?php } ?>		

		<?php } ?>

		</table>

		<br>
		<a href="main.html" class="button">HOME</a>
		<a href="logout.php" class = "button">LOGOUT</a>
	</center>
</body>
</html>
