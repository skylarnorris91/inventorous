<style>
table {
    width: 200px;
    margin-left: auto;
    margin-right: auto;
}
</style>



<html>

	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>

<body>
<h2>
<a href="../../back.php/">Home</a>
<a href="../../logout.php/">Logout</a>
</h2>
Welcome: 

<?php
session_start();
$email = $_SESSION['email'];
echo $email;

$first = $_SESSION['FirstName'];
echo $first;
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
	$password = $_SESSION['password'];
	$email = $_SESSION['email'];	
	$first = $_SESSION['FirstName'];
	#echo $email;
	#echo $password;

$result = mysqli_query($con,"SELECT * FROM Truck;");

echo "<table border='1'>
<tr>
<th>PersonID</th>
<th>TruckNumber</th>
<th>Type</th>
<th>Serial</th>
<th>Size</th>
<th>Date</th>


</tr>";

while($row = mysqli_fetch_array($result))
{
	echo "<tr>";

echo "<td>" . $row['PersonID'] . "</td>";
echo "<td>" . $row['TruckNumber'] . "</td>";
echo "<td>" . $row['Type'] . "</td>";
echo "<td>" . $row['Serial'] . "</td>";
echo "<td>" . $row['Size'] . "</td>";
echo "<td>" . $row['Date'] . "</td>";
echo "</tr>";
}
echo "</table>";
}
require '../../database.php';
mysqli_close($con);
?>

