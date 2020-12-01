<?php
function loadNav(){
    session_start();
    echo "
        <nav class=\"navbar navbar-light navbar-expand-md navigation-clean-search\">
        <div class=\"container\">
            <a class=\"navbar-brand\" href=\"#\">
                Inventorous
            </a>
            <button data-toggle=\"collapse\" class=\"navbar-toggler\" data-target=\"#navcol-1\">
                <span class=\"sr-only\">
                    Toggle navigation
                </span>
                <span class=\"navbar-toggler-icon\">
                </span>
            </button>
            <div class=\"collapse navbar-collapse\"
                id=\"navcol-1\">
                <ul class=\"nav navbar-nav\">
                    <li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"..\user.php\">
                            Member Home
                        </a>
                    </li>
                </ul>
                <form class=\"form-inline mr-auto\" target=\"_self\">
                    <!--<div class=\"form-group\">
                        <label for=\"search-field\">
                            <i class=\"fa fa-search\"></i>
                        </label>
                        <input class=\"form-control search-field\" type=\"search\" id=\"search-field\" name=\"search\">
                    </div>-->
                </form>
                <a class=\"btn btn-light action-button\" role=\"button\" href=\"..\logout.php\" style=\"background: rgb(133,21,21);\">
                    Logout
                </a>
            </div>
        </div>
    </nav>
    ";
}

function userData(){
  require 'database.php';
  $uRecords = $conn->prepare('SELECT ID, fName, lName FROM user WHERE memberID = :member_id');
  	$uRecords->bindParam(':member_id', $_SESSION['member_id']);
	$uRecords->execute();
	$uResults = $uRecords->fetch(PDO::FETCH_ASSOC);
	$message = '';

	if(count($uResults) > 0){
    $_SESSION['user_id'] = $uResults['ID'];
    $name = $uResults['fName'];
    echo "<h1 class=\"text-center\" style=\"padding-top: 50px;padding-bottom: 50px;\">Welcome, $name</h1>";
	}
}
?>