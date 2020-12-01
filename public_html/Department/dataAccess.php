<?php
function loadDeptData(){
    require '../database.php';
    $sRecords = $conn->prepare('SELECT `ID`, `name`FROM `department` WHERE `ID` = :deptID');
            $sRecords->bindParam(':deptID', $_GET["deptID"]);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $name = $sResults['name'];
        $deptID = $_GET["deptID"];
    echo "
        <tr>
            <td>$name</td>
        </tr>";
}

function updateDeptData($newName){
    require '../database.php';
    $deptID = $_GET["deptID"];
    if(!empty($newName)) {
          $sRecords = $conn->prepare( "UPDATE `department` SET `name` = '$newName' WHERE `ID` = '$deptID'");
	    $sRecords->execute();       
    }
}

function loadTableData(){
    require '../database.php';
    $deptID = $_GET["deptID"];

    $removeID = $_GET["removeID"];
    if($removeID > 0){
        $sRecords = $conn->prepare( "UPDATE `station` SET `active` = 0 WHERE `ID` = '$removeID'");
	    $sRecords->execute(); 
    }
    
    $sql = "SELECT * FROM `station` WHERE `deptID` = '$deptID' && `active` = 1 ORDER BY `ID` ASC";
    $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $suRecords->execute();

    while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $typeFilter = $_POST['typeDD'];
        $name = $row['name'];
        $addr = $row['address'];
        $phone = $row['phoneNum'];
        $statID = $row['ID'];
        if($name != "All Stations"){
            echo "
                <tr>
                    <td>$name</td>
                    <td>$addr</td>
                    <td>$phone</td>
                    <td>
                        <a href=\"../Station/stationMgnt.php?deptID=$deptID&stationID=$statID\">
                            <span style=\"color: rgb(67,67,67);font-size: 16px;\">
                                    Manage
                            </span>
                        </a>
                    </td>
                    <td>
                        <a href=\"../Department/deptMgnt.php?deptID=$deptID&removeID=$statID\">
                            <span style=\"color: rgb(67,67,67);font-size: 16px;\">
                                    Remove
                            </span>
                        </a>
                    </td>
                </tr>";
        }
    }
}

function addStationData($stationName, $address, $phone, $note){
    require '../database.php';
    $deptID = $_GET["deptID"];

    $sRecords = $conn->prepare("INSERT INTO `station`(`deptID`, `name`, `address`, `phoneNum`, `notes`) VALUES ('$deptID', '$stationName', '$address', '$phone', '$note')");
	    $sRecords->execute(); 
}

function loadModalData(){
    require '../database.php';
    $sRecords = $conn->prepare('SELECT `ID`, `name`FROM `department` WHERE `ID` = :deptID');
        $sRecords->bindParam(':deptID', $_GET["deptID"]);
    $sRecords->execute();
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $name = $sResults['name'];

    echo "
        <div class=\"modal fade\" id=\"updateData\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\" role=\"document\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h5 class=\"modal-title\" id=\"exampleModalLabel\">Update Department Data</h5>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                    <div class=\"modal-body\">
                        <form method=\"post\">
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"name\" name=\"deptName\" placeholder=\"Department Name\"/ value=\"$name\"></div>
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