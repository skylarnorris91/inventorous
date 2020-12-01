<html>
<a href="../../back.php/">Home</a>
<a href="../../logout.php/">Logout</a>
<body>

Welcome: 
<?php
session_start();
$email = $_SESSION['email'];
echo $email;
echo "<br>";
echo "<br>";
?>

</body>
</html>

<?php
$con=mysqli_connect("localhost", 'u59pnag8ayzvm', 'stupiduserpassword.', 'dbzh9nn9rqnnqw');
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

session_start();
if( isset($_SESSION['user_id']) ){
	$_SESSION['user_id'] = $results['id'];
	$PersonID = $_SESSION['PersonID'];
	$TruckName = $_SESSION['TruckName'];
	$Type = $_SESSION['Type'];
	$Serial = $_SESSION['Serial'];
	$Size = $_SESSION['Size'];
	$Date = $_SESSION['Date'];	
	
	echo "<br>", $Type;
	echo "<br>", $PersonID;		
	echo "<br>", $Serial;
	echo "<br>", $Size;		
	echo "<br>", $Date;
	echo "<br>", $TruckName;
	
$result = mysqli_query($con,"INSERT INTO Truck (PersonID, TruckNumber, Type, Serial, Size, Date) VALUES 
('".$PersonID."','1201','".$Type."','".$Serial."','NULL','NULL')");

header("Location: /Truck/1201/1201.php");

}
require '../../database.php';

mysqli_close($con);
?>


<a href="../../back.php/">Home</a>
<a href="../../logout.php/">Logout</a>
