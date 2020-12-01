<?php 
function updatePass($oldPass, $newPass){
    require '../database.php';
    $sRecords = $conn->prepare('SELECT * FROM `user` WHERE `ID` = :userID');
            $sRecords->bindParam(':userID', $_GET["userID"]);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $memID = $sResults["memberID"];

    $sRecords = $conn->prepare('SELECT * FROM `member` WHERE `ID` = :memberID');
            $sRecords->bindParam(':memberID', $memID);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $pass = $sResults['password'];

			if(password_verify($oldPass, $pass)){
                $sRecords = $conn->prepare('UPDATE `member` SET `password`= :newPass WHERE `ID` = :memberID');
                $sRecords->bindParam(':memberID', $memID);
                $sRecords->bindParam(':newPass', $newPass);
	            $sRecords->execute();
	            $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
			}else{
                echo "Old password is incorrect.";
            }
}

function updateInfo($lName, $fName, $memNum, $email, $comments, $role, $allAccess){
    require '../database.php';
    $userID = $_GET["userID"];
    $deptID = $_GET["deptID"];
    
    if(!empty($lName)) {
          $sRecords = $conn->prepare( "UPDATE `user` SET `lName` = '$lName' WHERE `ID` = '$userID'");
	    $sRecords->execute();       
    }
    if(!empty($fName)) {
      $sRecords = $conn->prepare( "UPDATE `user` SET `fName` = '$fName' WHERE `ID` = '$userID'");
	    $sRecords->execute(); 
    }
    if(!empty($email)) {
        $sRecords = $conn->prepare('SELECT * FROM `user` WHERE `ID` = :userID');
            $sRecords->bindParam(':userID', $_GET["userID"]);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $memID = $sResults["memberID"];
        $sRecords = $conn->prepare( "UPDATE `member` SET `email` = '$email' WHERE `ID` = '$userID'");
	    $sRecords->execute(); 
    }
    if(!empty($lName)) {
          $sRecords = $conn->prepare( "UPDATE `userDepartmentRelation` SET `memberNum` = '$memNum' WHERE `userID` = '$userID' && `deptID` = '$deptID'");
	    $sRecords->execute();       
    }
    if(!empty($fName)) {
      $sRecords = $conn->prepare( "UPDATE `userDepartmentRelation` SET `accessLvL` = '$role' WHERE `userID` = '$userID' && `deptID` = '$deptID'");
	    $sRecords->execute(); 
    }
    if(!empty($email)) {
      $sRecords = $conn->prepare( "UPDATE `userDepartmentRelation` SET `allAccess` = '$allAccess' WHERE `userID` = '$userID' && `deptID` = '$deptID'");
	    $sRecords->execute(); 
    }
}

function loadUserData(){
    require '../database.php';    
    $userID = $_GET["userID"];
    $deptID = $_GET["deptID"];

    $sRecords = $conn->prepare('SELECT * FROM `user` WHERE `ID` = :userID');
            $sRecords->bindParam(':userID', $_GET["userID"]);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $lName = $sResults['lName'];
        $fName = $sResults['fName'];
        $memID = $sResults["memberID"];

    $sRecords = $conn->prepare('SELECT * FROM `member` WHERE `ID` = :memberID');
            $sRecords->bindParam(':memberID', $memID);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $email = $sResults['email'];

    $sRecords = $conn->prepare('SELECT * FROM `userDepartmentRelation` WHERE `userID` = :userID && `deptID` = :deptID');
            $sRecords->bindParam(':userID', $userID);
            $sRecords->bindParam(':deptID', $deptID);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $memNum = $sResults['memberNum'];
        
        switch($sResults['accessLvL']){
            case 1: $role = "Admin"; break;
            case 2: $role = "Officer"; break;
            defualt:
            case 3: $role = "Member"; break;
            case 5: $role = "Root"; break;
        }

    echo "
        <tr>
            <td>$fName</td>
            <td>$lName</td>
            <td>$memNum</td>
            <td>$email</td>
            <td>$role</td>
        </tr>";
}
?>