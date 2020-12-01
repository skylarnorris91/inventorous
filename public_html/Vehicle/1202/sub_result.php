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
	$TruckNumber = $_SESSION['TruckNumber'];
	$Type = $_SESSION['Type'];
	$Serial = $_SESSION['Serial'];
	$Size = $_SESSION['Size'];
	$Date = $_SESSION['Date'];	
	
	echo "<br>", $TruckNumber;
	echo "<br>", $Type;	
	echo "<br>", $PersonID;	
	echo "<br>", $Serial;
	echo "<br>", $Size;		
	echo "<br>", $Date;


$result = mysqli_query($con,"DELETE FROM Truck WHERE Serial = '".$Serial."'");


}
require '../../database.php';

mysqli_close($con);
?>


<a href="../../back.php/">Home</a>
<a href="../../logout.php/">Logout</a>
