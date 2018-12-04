<?php
	session_start();

	$db = mysqli_connect('localhost','root','','animal_vaccination')
 	or die('Error connecting to MySQL server.');

	if(isset($_POST['submit']))
		echo "successful";

	$dist=$_SESSION['district'];
	$getinfo ="SELECT P.TALUK, T.CATTLE, T.BUFFALO, T.PIG, T.TOTAL, V.VCATTLE, V.VBUFFALO, V.VPIG, V.VTOTAL, P1.PERC, M.TEAMS, M.DAYS 
				FROM PLACE P, TOTAL_LIVESTOCK T, VACCINATED_LIVESTOCK V, PERCENTAGE P1, MAN_POWER M 
				WHERE M.TID=P1.TID 
				AND P1.TID=V.TID 
				AND V.TID=T.TID 
				AND T.TID=P.TID 
				AND P.TID IN 
				(SELECT TID 
				FROM PLACE 
				WHERE DISTRICT='$dist')";
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
		if($num_results>0)
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

		<?php } ?>		

		<?php } ?>

		</table>

		<br>
		<a href="main.html" class="button">HOME</a>
	</center>
</body>
</html>
