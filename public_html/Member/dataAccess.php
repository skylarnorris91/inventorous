<?php 
function loadStationData(){
    require '../database.php';
    $sRecords = $conn->prepare('SELECT * FROM `station` WHERE `ID` = :stationID');
            $sRecords->bindParam(':stationID', $_GET["stationID"]);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $name = $sResults['name'];
        $deptID = $sResults['deptID'];
    echo "
    <form method=\"post\" action=\"stationMgnt.php?stationID=$statID\">                
        <span style=\"font-size: 20px; margin-bottom: 15px;\">
            $name
        </span><br>
     </form>";
}

function loadTableData(){
    require '../database.php';
    $stationID = $_GET["stationID"];
    $deptID = $_GET["deptID"];

    $removeID = $_GET["removeID"];
    if($removeID > 0){
        $sRecords = $conn->prepare( "UPDATE `userDepartmentRelation` SET `active` = 0 WHERE `deptID` = '$deptID' && `userID` = '$removeID'");
	    $sRecords->execute(); 
    }

    $sql = "SELECT * FROM `userDepartmentRelation` WHERE `deptID` = '$deptID' && active = 1";
    $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $suRecords->execute();

    while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $sRecords = $conn->prepare('SELECT * FROM `user` WHERE `ID` = :userID');
            $sRecords->bindParam(':userID', $row['userID']);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);

        $fName = $sResults['fName'];
        $lName = $sResults['lName'];
        $userID = $sResults['ID'];
        $memID = $sResults['memberID'];

        $sRecords = $conn->prepare('SELECT * FROM `member` WHERE `ID` = :memID');
            $sRecords->bindParam(':memID', $memID);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);

        $email = $sResults['email'];
     
        $memberNum = $row['memberNum'];

        switch($row['accessLvL']){
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
                <td>$memberNum</td>
                <td>$email</td>
                <td>$role</td>
                <td>
                    <a href=\"../Member/userMgnt.php?deptID=$deptID&stationID=$stationID&userID=$userID\">
                        <span style=\"color: rgb(67,67,67);font-size: 16px;\">
                                Manage
                        </span>
                    </a>
                </td>
                <td>
                    <a href=\"../Member/memberMgnt.php?deptID=$deptID&stationID=$stationID&removeID=$userID\">
                        <span style=\"color: rgb(67,67,67);font-size: 16px;\">
                                Remove
                        </span>
                    </a>
                </td>
            </tr>";

    }
}


function addMemberData($lName, $fName, $memNum, $email, $pass, $comments, $role, $allAccess){
    require '../database.php';
    $deptID = $_GET["deptID"];
    $statID = $_GET["stationID"];

    $sRecords = $conn->prepare("INSERT INTO `member`(`email`, `password`) VALUES ('$email', '$pass')");
	    $sRecords->execute(); 

    $sRecords = $conn->prepare( "SELECT MAX(ID) FROM `member`");
        $sRecords->execute(); 
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $memID = $sResults['MAX(ID)'];

    $sRecords = $conn->prepare("INSERT INTO `user`(`memberID`, `fName`, `lName`) VALUES ('$memID', '$fName', '$lName')");
	    $result = $sRecords->execute(); 

    $sRecords = $conn->prepare( "SELECT MAX(ID) FROM `user`");
        $sRecords->execute(); 
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $userID = $sResults['MAX(ID)'];

    $sRecords = $conn->prepare("INSERT INTO `userDepartmentRelation`(`userID`, `deptID`, `memberNum`, `allStations`, `accessLvL`) VALUES ('$userID', '$deptID', '$memNum', '$allAccess', '$role')");
	    $result = $sRecords->execute(); 
}

?>