<?php 
    function updateInfo($assignText, $description, $identifier, $name){
        require '../database.php';
        $itemID = $_GET["itemID"];
        if(!empty($name)) {
            $sRecords = $conn->prepare( "UPDATE `item` SET `name` = '$name' WHERE `ID` = '$itemID'");
            $sRecords->execute();       
        }
        if(!empty($identifier)) {
        $sRecords = $conn->prepare( "UPDATE `item` SET `identifier` = '$identifier' WHERE `ID` = '$itemID'");
            $sRecords->execute(); 
        }
        if(!empty($description)) {
        $sRecords = $conn->prepare( "UPDATE `item` SET `description` = '$description' WHERE `ID` = '$itemID'");
            $sRecords->execute(); 
        }
        if(!empty($assignText)) {
        $sRecords = $conn->prepare( "UPDATE `item` SET `assignText` = '$assignText' WHERE `ID` = '$itemID'");
            $sRecords->execute(); 
        }
    }

    function loadItemData(){
        require '../database.php';
        $itemID = $_GET["itemID"];
        $sRecords = $conn->prepare('SELECT * FROM `item` WHERE `ID` = :itemID');
                $sRecords->bindParam(':itemID', $itemID);
        $sRecords->execute();
        $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $itemName = $sResults['name'];
        $itemIdent = $sResults['identifier'];
        $itemDesc = $sResults['description'];
        $itemAssignText = $sResults['assignText'];
        $itemAssignDate = $sResults['assignDate'];

        echo "
            <tr>
                <td>$itemName</td>
                <td>$itemIdent</td>
                <td>$itemDesc</td>
                <td>$itemAssignText</td>
                <td>$itemAssignDate</td>
            </tr>
        ";
    }

    function loadModalData(){
        require '../database.php';
        $itemID = $_GET["itemID"];
        $sRecords = $conn->prepare('SELECT * FROM `item` WHERE `ID` = :itemID');
                $sRecords->bindParam(':itemID', $itemID);
        $sRecords->execute();
        $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $itemName = $sResults['name'];
        $itemIdent = $sResults['identifier'];
        $itemDesc = $sResults['description'];
        $itemAssignText = $sResults['assignText'];
        $itemAssignDate = $sResults['assignDate'];
        
        echo "
            <div class=\"modal fade\" id=\"updateData\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                <div class=\"modal-dialog\" role=\"document\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\" id=\"updateItemModal\">update Vehicle Data</h5>
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                        <div class=\"modal-body\">
                            <form method=\"post\" >
                                <div class=\"form-group\">
                                    <input class=\"form-control\" type=\"text\" name=\"itemName\" placeholder=\"Name\" value=\"$itemName\" />
                                </div>
                                <div class=\"form-group\">
                                    <input class=\"form-control\" type=\"text\" name=\"identifier\" placeholder=\"Identifier\" value=\"$itemIdent\" />
                                </div>
                                <div class=\"form-group\">
                                    <input class=\"form-control\" type=\"text\" name=\"dectription\" placeholder=\"Description\" value=\"$itemDesc\" />
                                </div>
                                <div class=\"form-group\">
                                    <select name=\"assignDD\">
                                        <option value=\"\" selected disabled hidden required>$itemAssignText</option>";
                                        loadAssignData();
        echo "
                                    </select>
                                </div>
                        </div>
                        <div class=\"modal-footer\">
                            <button name=\"Update\" type=\"submit\" class=\"btn btn-primary\" style=\"background: rgb(133,21,21); border: none;\">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
    }

    function loadAssignData(){
        require '../database.php';
        $stationID = $_GET["stationID"];
        $deptID = $_GET["deptID"];
        $userID = $_SESSION['user_id'];
        
        $sql = "SELECT * FROM `vehicleStationRelation` WHERE `stationID` = '$stationID' && `active` = 1";
        $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $suRecords->execute();

        while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $vehID = $row['vehicleID'];
            $sql = "SELECT * FROM `vehicle` WHERE `ID` = '$vehID'";
            $sRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $sRecords->execute();
            $innerRow = $sRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
            $subVal = $innerRow['num'];
            $value = "Vehicle-$subVal";
            echo "<option value=\"$value\">$value</option>";
        }

        $sql = "SELECT * FROM `userDepartmentRelation` WHERE `deptID` = '$deptID' && `active` = 1";
        $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $suRecords->execute();

        while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $subVal = $row['memberNum'];
            $value = "Member-$subVal";
            echo "<option value=\"$value\">$value</option>";
        }
    }
?>