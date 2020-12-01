<?php
    function updateInfo($type, $num, $year, $make, $model, $comments){
        require '../database.php';
        $vehicleID = $_GET["vehicleID"];
        if($type>0) {
            $sRecords = $conn->prepare( "UPDATE `vehicle` SET `type`= $type WHERE `ID` = '$vehicleID'");
            $sRecords->execute();       
        }
        if(!empty($num)) {
        $sRecords = $conn->prepare( "UPDATE `vehicle` SET `num` = '$num' WHERE `ID` = '$vehicleID'");
            $sRecords->execute(); 
        }
        if(!empty($year)) {
        $sRecords = $conn->prepare( "UPDATE `vehicle` SET `year` = '$year' WHERE `ID` = '$vehicleID'");
            $sRecords->execute(); 
        }
        if(!empty($make)) {
        $sRecords = $conn->prepare( "UPDATE `vehicle` SET `make` = '$make' WHERE `ID` = '$vehicleID'");
            $sRecords->execute(); 
        }
        if(!empty($model)) {
        $sRecords = $conn->prepare( "UPDATE `vehicle` SET `model` = '$model' WHERE `ID` = '$vehicleID'");
            $sRecords->execute(); 
        }
        if(!empty($comments)) {
        $sRecords = $conn->prepare( "UPDATE `vehicle` SET `notes` = '$comments' WHERE `ID` = '$vehicleID'");
            $sRecords->execute(); 
        }
        if(!empty($year)) {
        $sRecords = $conn->prepare( "UPDATE `vehicle` SET `year` = '$year' WHERE `ID` = '$vehicleID'");
            $sRecords->execute(); 
        }
    }

    function loadVehicleData(){
        require '../database.php';
        $sRecords = $conn->prepare('SELECT * FROM `vehicle` WHERE `ID` = :vehicleID');
                $sRecords->bindParam(':vehicleID', $_GET["vehicleID"]);
            $sRecords->execute();
            $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
            $type = $sResults['type'];
            $num = $sResults['num'];
            $year = $sResults["year"];        
            $make = $sResults["make"];        
            $model = $sResults["model"];
            $comments = $sResults["notes"];

            switch($type){
                case 1: $typeText = "Structure";break;
                case 2: $typeText = "Medical";break;
                case 3: $typeText = "Brush";break;
                case 4: $typeText = "Ladder";break;
                case 5: $typeText = "UTV";break;
                default: $typeText = "Unknown";break;
            }

        $vehicleID = $_GET["vehicleID"];
        echo "
            <tr>
                <td>$typeText</td>
                <td>$num</td>
                <td>$year</td>
                <td>$make</td>
                <td>$model</td>
                <td>$comments</td>
            </tr>
        ";
    }

    function loadModalData(){
    require '../database.php';
        $sRecords = $conn->prepare('SELECT * FROM `vehicle` WHERE `ID` = :vehicleID');
            $sRecords->bindParam(':vehicleID', $_GET["vehicleID"]);
        $sRecords->execute();
        $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $type = $sResults['type'];
        $num = $sResults['num'];
        $year = $sResults["year"];        
        $make = $sResults["make"];        
        $model = $sResults["model"];
        $comments = $sResults["notes"];

        switch($type){
            case 1: $typeText = "Structure";break;
            case 2: $typeText = "Medical";break;
            case 3: $typeText = "Brush";break;
            case 4: $typeText = "Ladder";break;
            case 5: $typeText = "UTV";break;
            default: $typeText = "Unknown";break;
        }
    echo "
        <div class=\"modal fade\" id=\"updateData\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
            <div class=\"modal-dialog\" role=\"document\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h5 class=\"modal-title\" id=\"addVehicleModal\">update Vehicle Data</h5>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                    <div class=\"modal-body\">
                        <form method=\"post\" >
                            <div class=\"form-group\">
                                <select name=\"typeDD\">
                                    <option value=\"$type\" selected disabled hidden required>$typeText</option>
                                    <option value=\"1\">Structure</option>
                                    <option value=\"2\">Medical</option>
                                    <option value=\"3\">Brush</option>
                                    <option value=\"4\">Ladder</option>
                                    <option value=\"5\">UTV</option>
                                    <option value=\"6\">Other</option>
                                </select>
                            </div>
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"text\" name=\"number\" placeholder=\"Number\" value=\"$num\"/>
                            </div>
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"text\" name=\"make\" placeholder=\"Vehicle Make\" value=\"$make\"/>
                            </div>
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"text\" name=\"model\" placeholder=\"Vehicle Model\" value=\"$model\"/>
                            </div>
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"text\" name=\"year\" placeholder=\"Vehicle Year\" value=\"$year\" />
                            </div>
                            <div class=\"form-group\">
                                <textarea class=\"form-control\" name=\"comments\" placeholder=\"Comments\" rows=\"3\" maxlength=\"500\" value=\"$comments\"></textarea>
                            </div>
                    </div>
                    <div class=\"modal-footer\">
                        <button name=\"AddVehicle\" type=\"submit\" class=\"btn btn-primary\" style=\"background: rgb(133,21,21); border: none;\">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    }
?>