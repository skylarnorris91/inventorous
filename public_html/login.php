<?php
	session_start();
  require 'database.php';

	if( isset($_SESSION['member_id']) ){
		//$_SESSION['member_id'] = $_POST['id'];
		$_SESSION['email'] = $_POST['email'];
    header("Location: /User_Welcome_Page.php");
	}
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		$records = $conn->prepare('SELECT ID, email, password FROM member WHERE email = :email');
		$records->bindParam(':email', $_POST['email']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);
		$message = '';

		if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){
			$_SESSION['member_id'] = $results['ID'];
			$_SESSION['email'] = $results['email'];
			//$_SESSION['password'] = $_POST['password'];
			header("Location: /user.php");
		} else {
			$message = 'Sorry, those credentials do not match';
      echo "Sorry, those credentials do not match";
		}
	}

?>
