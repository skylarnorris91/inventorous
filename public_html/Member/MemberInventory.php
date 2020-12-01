<style>
table {
text-align: right;
    width: 200px;
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
<h2> Member Inventory: </h2>

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
	<form action="AllMembers.php" method="POST">
		<input type="submit" value = "View all members">	
	</form>
	<form action="AllForSelectMember.php" method="POST">
		<input type="submit" value = "<?php
	session_start();
	$email = $_SESSION['email'];

	$con=mysqli_connect("localhost", 'u59pnag8ayzvm', 'stupiduserpassword.', 'dbzh9nn9rqnnqw');
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$result = mysqli_query($con,"SELECT LastName, FirstName FROM Member WHERE Email = '$email'");
	while($row = mysqli_fetch_array($result)) { 
		echo $row['FirstName'], " ";
		echo $row['LastName'], "'s Items";
	}
	?>">
		
	</form>
	<form action="FindMember.php" method="POST">
		<input type="submit" value = "View all items associated with member">	
	</form>
	<form action="AddToMember.php" method="POST">
		<input type="submit" value = "Add Item to specific member">	
	</form>
</h2>
</body>
</html>

<a href="../back.php/">Home</a>
<a href="../logout.php/">Logout</a>
