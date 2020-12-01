
<?php
session_start();

if( isset($_SESSION['user_id']) ){
	$_SESSION['user_id'] = $results['id'];
	#$_SESSION['PersonID'] = $_POST['PersonID'];
		$_SESSION['TruckNumber'] = $_POST['TruckNumber'];
		$_SESSION['Type'] = $_POST['Type'];
		$_SESSION['Serial'] = $_POST['Serial'];
		$_SESSION['Size'] = $_POST['Size'];
		$_SESSION['Date'] = $_POST['Date'];
}
require '../../database.php';

if(!empty($_POST['PersonID'])):
	
	$records = $conn->prepare('SELECT id, email, password, PersonID FROM users WHERE PersonID = :PersonID');
	$records->bindParam(':PersonID', $_POST['PersonID']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	$message = '';
		header("Location: /Truck/1202/add_result.php");
		$_SESSION['user_id'] = $results['id'];
		#$_SESSION['PersonID'] = $_POST['PersonID'];
		$_SESSION['TruckNumber'] = $_POST['TruckNumber'];
		$_SESSION['Type'] = $_POST['Type'];
		$_SESSION['Serial'] = $_POST['Serial'];
		$_SESSION['Size'] = $_POST['Size'];
		$_SESSION['Date'] = $_POST['Date'];		
endif;
?>


<!DOCTYPE html>
<html>
<head>
	<title>Member Information</title>
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
</head>
<body>
	<form action="1202Add.php" method="POST">
	
	<input type="text" placeholder="Enter Serial Number:" name="Serial">
	<input type="text" placeholder="Enter Date:" name="PersonID">
	<label for="Type">Choose a category:</label>
		  <select id="Type" name="Type">
		    <option value="Ladder"> Ladders </option>
		    <option value="Hoses"> Hoses </option>
		    <option value="Nozzels"> Nozzels </option>
		    <option value="Traffic Cones"> Traffic Cones </option>
		  </select>
	<br>
			
	<br>
	<input type="submit">
	</form>

</body>
<a href="../../back.php/">Home</a>
<a href="../../logout.php/">Logout</a>
</html>
