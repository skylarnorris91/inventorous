<style>
table {
    width: 100px;
    margin-left: auto;
    margin-right: auto;
}
</style>

<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>

<h2> Truck Inventory: </h2>
	<?php
	session_start();
	$email = $_SESSION['email'];
	echo "User: ";

	$con=mysqli_connect("localhost", 'u59pnag8ayzvm', 'stupiduserpassword.', 'dbzh9nn9rqnnqw');
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT LastName, FirstName FROM Member WHERE Email = '$email'");
	while($row = mysqli_fetch_array($result)) {
		echo "<tr>";  
		echo '<td>' . $row['FirstName'] . '</td>';
		echo " ", '<td>' . $row['LastName'] . '</td>';
		echo "</tr>";
	}
	echo "</table>";
	echo "<br>";
 	echo "Email: ";
	echo $email;
	?>

    <h2>
 		<form action="/Station/Station1/Station1.php" method="POST">
			<input type="submit" value = "Station 1">	
		</form>

		<form action="/Station/Station2/Station2.php" method="POST">
			<input type="submit" value = "Station 2">	
		</form>
	</h2>

</body>
</html>


<a href="../back.php/">Home</a>
<a href="../logout.php/">Logout</a>
