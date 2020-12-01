<?php
    $stationID;

    function addItem($assignText, $description, $identifier, $name){
        require '../database.php';
        $stationID = $_GET["stationID"];
        $sRecords = $conn->prepare("INSERT INTO `item`(`stationID`, `name`, `identifier`, `description`, `assignText`) VALUES ('$stationID', '$name', '$identifier', '$description', '$assignText')");
            $sRecords->execute(); 
    }

    function loadTableData(){
        require '../database.php';
        $stationID = $_GET["stationID"];

        $removeID = $_GET["removeID"];
        if($removeID > 0){
            $sRecords = $conn->prepare( "UPDATE `item` SET `active` = 0 WHERE `ID` = '$removeID'");
            $sRecords->execute(); 
        }
        
        $sql = "SELECT * FROM `item` WHERE `stationID` = '$stationID' && `active` = 1";
        $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $suRecords->execute();

        while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            addRow($row);
        }
    }

    function addRow($row){
        $itemID = $row['ID'];
        $name = $row['name'];
        $ident = $row['identifier'];
        $desc = $row['description'];
        $assignText = $row['assignText'];
        $assignDate = $row['assignDate'];
        $stationID = $_GET["stationID"];
        $deptID = $_GET["deptID"];

        echo "
            <tr>
                <td>$name</td>
                <td>$ident</td>
                <td>$desc</td>
                <td>$assignText</td>
                <td>$assignDate</td>
                <td>
                    <a href=\"../Inventory/item.php?deptID=$deptID&stationID=$stationID&itemID=$itemID\">
                        <span style=\"color: rgb(67,67,67);font-size: 16px;\">
                                Manage
                        </span>
                    </a>
                </td>
                <td>
                    <a href=\"../Inventory/inventory.php?deptID=$deptID&stationID=$stationID&removeID=$itemID\">
                        <span style=\"color: rgb(67,67,67);font-size: 16px;\">
                                Remove
                        </span>
                    </a>
                </td>
            </tr>
        ";
    }

    function loadModalData(){
        echo "
            <div class=\"modal fade\" id=\"addItem\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"addItemModal\" aria-hidden=\"true\">
                <div class=\"modal-dialog\" role=\"document\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\" id=\"addItemModal\">Add Item</h5>
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                                <span aria-hidden=\"true\">&times;</span>
                            </button>
                        </div>
                        <div class=\"modal-body\">
                            <form method=\"post\" >
                                <div class=\"form-group\">
                                    <input class=\"form-control\" type=\"text\" name=\"iName\" placeholder=\"Name\" required />
                                </div>
                                <div class=\"form-group\">
                                    <input class=\"form-control\" type=\"text\" name=\"ident\" placeholder=\"Identifier\" />
                                </div>
                                <div class=\"form-group\">
                                    <textarea class=\"form-control\" name=\"description\" placeholder=\"Description\" rows=\"3\" maxlength=\"500\"></textarea>
                                </div>
                                <div class=\"form-group\">
                                    <select name=\"assignDD\">
                                        <option value=\"\" selected disabled hidden required>Assigned To</option>";
                                        loadAssignData();
        echo "
                                    </select>
                                </div>
                        </div>
                        <div class=\"modal-footer\">
                            <button name=\"AddItem\" type=\"submit\" class=\"btn btn-primary\" style=\"background: rgb(133,21,21); border: none;\">Save changes</button>
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