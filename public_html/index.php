<!DOCTYPE html>
<?php    
    require 'genericDataAccess.php';
    require 'dataAccess.php';

    if(!empty($_POST['deptName']) && !empty($_POST['email']) && !empty($_POST['passwordReg'])){
        addDeptData($_POST['deptName'], $_POST['email'], password_hash($_POST['passwordReg'], PASSWORD_BCRYPT), $_POST['comments']);
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Inventorous</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bebas+Neue">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/popup.css">
</head>

<body style="border-color: #ffffff;">
    <div class="container">
        <nav class="navbar navbar-light navbar-expand-md fixed-top navigation-clean-search">
            <div class="container"><a class="navbar-brand" href="#" style="color: #333333;">Inventorous</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#FAQ">FAQ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                    <form class="form-inline mr-auto" target="_self">
                        <!--<div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" id="search-field" name="search"></div>-->
                    </form><a class="btn btn-light action-button" role="button" href="#login" style="background: rgb(133,21,21);">Login/Sign Up</a>
                </div>
            </div>
        </nav>
        <div class="row text-right">
            <div class="col" style="background: #851515;height: 450px;">
                <h1 style="border-color: rgb(255,255,255);">
                    Inventorous
                </h1>
                <span style="color: rgb(255,255,255);padding-left: 0px;font-family: Alata, sans-serif;">
                    A Fire Department Inventory Management System&nbsp;
                </span>
            </div>
            <div class="col text-center" style="background: #851515;height: 450px;">
                <img src="assets/img/phone.png" style="padding-top: 50px;">
            </div>
    </div>

    <a class="anchor" id="about"></a>
    <h1 class="about" style="padding-top: 0px;color: rgb(51,51,51);text-align: center;margin-top: 80px;">about inventorous</h1>
    <p style="margin-right: 10%;margin-left: 10%;text-indent: 50px;">Inventorous is an online database for fire department personnel to keep track of inventory and monthly equipment inspections. Features include the ability to manage fire department members, view records, add or update inventory counts, log equipment malfunctions and damage, and record dates of inspections.</p>
    <a class="anchor" id="FAQ"></a>
    <h1 class="FAQ" style="padding-top: 0px;color: rgb(51,51,51);text-align: center;background: #e3e3e3;margin-top: 80px;margin-bottom: 0px;">FAQ</h1>
    <div role="tablist" id="accordion-1">
        <div class="card" style="background: #f5f5f5;">
            <div class="card-header" role="tab">
                <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="true" aria-controls="accordion-1 .item-1" href="#accordion-1 .item-1" style="border-color: rgb(51,51,51);color: rgb(51,51,51);">How much does it cost to register my fire department?</a></h5>
            </div>
            <div class="collapse show item-1" role="tabpanel" data-parent="#accordion-1">
                <div class="card-body">
                    <p class="card-text">Right now, Inventorous is in its testing and beta phase. We created Inventorous as a Capstone project and to help small, local fire departments manage their inventory more easily. You can take advantage of our services for free right now</p>
                </div>
            </div>
        </div>
        <div class="card" style="background: rgb(245,245,245);">
            <div class="card-header" role="tab">
                <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-2" href="#accordion-1 .item-2" style="color: rgb(51,51,51);">What kind of support is offered to your members?</a></h5>
            </div>
            <div class="collapse item-2" role="tabpanel" data-parent="#accordion-1">
                <div class="card-body">
                    <p class="card-text">Inventorous was created and is managed by two Computer Science students at Appalachian State University. Because we are busy students, We do not currently have online chat support or phone support, but the contact form on our website sends your questions and comments directly to both of our emails. We will do our best to respond to within 1 business day, likely sooner.</p>
                </div>
            </div>
        </div>
        <div class="card" style="background: rgb(245,245,245);">
            <div class="card-header" role="tab">
                <h5 class="mb-0"><a data-toggle="collapse" aria-expanded="false" aria-controls="accordion-1 .item-3" href="#accordion-1 .item-3" style="color: rgb(51,51,51);">FAQ 3</a></h5>
            </div>
            <div class="collapse item-3" role="tabpanel" data-parent="#accordion-1">
                <div class="card-body">
                    <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <a class="anchor" id="contact"></a>
    <div class="contact-clean" style="background: rgba(0,0,0,0);text-align: center;">
        <form id="contact" method="post" action="contact.php" target="_blank" style="background: rgb(227,227,227);">
            <h2 class="text-center">Contact Us</h2>
            <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name"></div>
            <div class="form-group"><input class="form-control is-invalid" type="email" name="email" placeholder="Email"><small class="form-text text-danger">Please enter a correct email address.</small></div>
            <div class="form-group"><textarea class="form-control" name="message" placeholder="Message" rows="14"></textarea></div>
            <div class="form-group"><button class="btn btn-primary" type="submit" style="background: #851515;">send </button></div>
        </form>
    </div>
	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>
    <a class="anchor" id="login"></a>
    <div class="login-clean" style="background: rgb(133,21,21); max-width: 1140px; margin: auto;">
        <form action="login.php" method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate" style="border-color: rgb(133,21,21);color: rgb(133,21,21);"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background: rgb(133,21,21);">Log In</button></div>
            <a class="forgot" style="cursor:pointer" data-toggle="modal" data-target="#registerModal">
                Want to sign up? Register here.
            </a>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <input class="form-control" type="name" name="deptName" placeholder="Department Name" required /></div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Department Email" required /></div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="passwordReg" placeholder="Password"></div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="passwordReg-repeat" placeholder="Password (Repeat)"></div>
                        <div class="form-group">
                            <textarea class="form-control" name="comments" placeholder="Comments" rows="3" maxlength="500"></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" style="background: rgb(133,21,21); border: none;">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>