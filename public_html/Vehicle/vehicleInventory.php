<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>
<h2> Select Option: </h2>

	<?php
      $vehicleID = $_GET["vehicleID"];
	?>

	<h2>
		<form action="vehicleAdd.php" method="POST">
			<input type="submit" value = "Add Item to Truck">	
		</form>

		<form action="vehicleSub.php" method="POST">
			<input type="submit" value = "Remove Item from Truck">	
		</form>

		<form action="vehicleAll.php" method="POST">
			<input type="submit" value = "View All Item on Truck">	
		</form>
	</h2>

</body>
<a href="../../back.php/">Home</a>
<a href="../../logout.php/">Logout</a>
</html>
