<?php
session_start();
require 'registerDataAccess.php';
if( isset($_SESSION['user_id']) ){
	header("Location: /#login");
}
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        echo $_POST['email']+ $_POST['password']+ $_POST['FirstName']+ $_POST['LastName'];
        registerUser($_POST['email'], $_POST['password'], $_POST['FirstName'], $_POST['LastName']);
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bebas+Neue">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>
    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post" action="register.php">
                <h2 class="text-center">
                    <strong>Create</strong> an account.
                </h2>
                <div class="form-group">
                    <input class="form-control" type="text" name="FirstName" placeholder="First Name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="LastName" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password-repeat" placeholder="Password (repeat)">
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox">
                            I agree to the license terms.
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" style="background: rgb(133,21,21);">
                        Sign Up
                    </button>
                </div>
                <a class="already" target="_blank" href="https://skylarn.sg-host.com/index.php#login">
                    Already have an account? Login here.
                </a>
            </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>