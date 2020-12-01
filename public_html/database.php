<?php
$server = 'localhost';
$username = 'u59pnag8ayzvm';
$password = 'stupiduserpassword.';
$database = 'dbzh9nn9rqnnqw';
$database2 = 'dbm5sh9sgawvey';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database2;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}
?>
