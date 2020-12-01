<?php
function loadStationData(){
    require '../database.php';
    $sRecords = $conn->prepare('SELECT `ID`, `name`, address, phoneNum FROM `station` WHERE `ID` = :stationID');
            $sRecords->bindParam(':stationID', $_GET["stationID"]);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $name = $sResults['name'];
        $addr = $sResults['address'];
        $phone = $sResults['phoneNum'];
        $statID = $_GET["stationID"];
    echo "
        <tr>
            <td>$name</td>
            <td>$addr</td>
            <td>$phone</td>
        </tr>";
}

function updateStationData($newName, $newAddr, $newPhone){
    require '../database.php';
    $statID = $_GET["stationID"];
    if(!empty($newName)) {
          $sRecords = $conn->prepare( "UPDATE `station` SET `name` = '$newName' WHERE `ID` = '$statID'");
	    $sRecords->execute();       
    }
    if(!empty($newAddr)) {
      $sRecords = $conn->prepare( "UPDATE `station` SET `address` = '$newAddr' WHERE `ID` = '$statID'");
	    $sRecords->execute(); 
    }
    if(!empty($newPhone)) {
      $sRecords = $conn->prepare( "UPDATE `station` SET `phoneNum` = '$newPhone' WHERE `ID` = '$statID'");
	    $sRecords->execute(); 
    }
}

function loadTableData(){
    require '../database.php';
    $stationID = $_GET["stationID"];
    $deptID = $_GET["deptID"];

    $removeID = $_GET["removeID"];
    if($removeID > 0){
        $sRecords = $conn->prepare( "UPDATE `vehicleStationRelation` SET `active` = 0 WHERE `stationID` = '$stationID' && `vehicleID` = '$removeID'");
	    $sRecords->execute(); 
    }


    $sql = "SELECT * FROM `vehicleStationRelation` WHERE `stationID` = '$stationID' && active = 1";
    $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $suRecords->execute();
    while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        
        $sRecords = $conn->prepare('SELECT * FROM `vehicle` WHERE `ID` = :vehicleID');
            $sRecords->bindParam(':vehicleID', $row['vehicleID']);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);

        $val = $sResults['type'];
        $vehID = $sResults['ID'];
        $num = $sResults['num'];
        $make = $sResults['make'];
        $model = $sResults['model'];
        $year = $sResults['year'];
        $note = $sResults['notes'];
        switch($val){
            case 1: $type = "Structure";break;
            case 2: $type = "Medical";break;
            case 3: $type = "Brush";break;
            case 4: $type = "Ladder";break;
            case 5: $type = "UTV";break;
            case 6: $type = "Other";break;
            default: $type = "Unknown";break;
        }

        echo "
            <tr>
                <td>$type</td>
                <td>$num</td>
                <td>$make</td>
                <td>$model</td>
                <td>$year</td>
                <td>$note</td>
                <td>
                    <a href=\"../Vehicle/vehicleMgnt.php?deptID=$deptID&stationID=$stationID&vehicleID=$vehID\">
                        <span style=\"color: rgb(67,67,67);font-size: 16px;\">
                                Manage
                        </span>
                    </a>
                </td>
                <td>
                    <a href=\"../Station/stationMgnt.php?deptID=$deptID&stationID=$stationID&removeID=$vehID\">
                        <span style=\"color: rgb(67,67,67);font-size: 16px;\">
                                Remove
                        </span>
                    </a>
                </td>
            </tr>";
    }
}

function addVehicleData($typeDD, $num, $make, $model, $year, $notes){
    require '../database.php';
    $sRecords = $conn->prepare("INSERT INTO `vehicle`(`type`, `num`, `make`, `model`, `year`,`notes`) VALUES ('$typeDD', '$num', '$make', '$model', '$year', '$notes')");
	    $sRecords->execute(); 

    $sRecords = $conn->prepare( "SELECT MAX(ID) FROM `vehicle`");
        $sRecords->execute(); 
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $vehID = $sResults['MAX(ID)'];
    $statID = $_GET["stationID"];
    $sRecords = $conn->prepare("INSERT INTO `vehicleStationRelation`(`vehicleID`, `stationID`) VALUES ('$vehID','$statID')");
	    $result = $sRecords->execute(); 
}

function loadModalData(){
    require '../database.php';
    $sRecords = $conn->prepare('SELECT `ID`, `name`, address, phoneNum FROM `station` WHERE `ID` = :stationID');
        $sRecords->bindParam(':stationID', $_GET["stationID"]);
    $sRecords->execute();
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $statName = $sResults['name'];
    $statAddr = $sResults['address'];
    $statPhoNum = $sResults['phoneNum'];
    echo "
        <div class=\"modal fade\" id=\"updateData\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\" role=\"document\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Update Station Data</h5>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                    <div class=\"modal-body\">
                        <form method=\"post\">
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"name\" name=\"statName\" placeholder=\"Station Name\" value=\"$statName\"/></div>                    
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"name\" name=\"statAddr\" placeholder=\"Address\" value=\"$statAddr\"></div>                    
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"name\" name=\"statPhone\" placeholder=\"Phone Number\" value=\"$statPhoNum\"/></div>
                    </div>
                    <div class=\"modal-footer\">
                        <button type=\"submit\" class=\"btn btn-primary\" style=\"background: rgb(133,21,21); border: none;\">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
}
?>