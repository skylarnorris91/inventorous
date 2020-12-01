<?php
$stationID;

function loadTableData(){
    require 'database.php';
    $stationID = $_GET["stationID"];
    
    $sql = "SELECT * FROM `item` WHERE `stationID` = '$stationID' && `active` = 1";
    
    // Possible if statement to create accending or decending ordering
    if ($_GET['sort'] == 'desc') {
    $sql .= " ORDER BY Description";
    }
     
    $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $suRecords->execute();

    while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        addRow($row);
    }
}

function addRow($row){
    $name = $row['name'];
    $ident = $row['identifier'];
    $desc = $row['description'];
    $assignText = $row['assignText'];
    $assignDate = $row['assignDate'];

    echo "
        <tr>
            <td>$name</td>
            <td>$ident</td>
            <td>$desc</td>
            <td>$assignText</td>
            <td>$assignDate</td>
        </tr>
    ";
}

function loadModalData(){
    echo "
        <div class=\"modal fade\" id=\"addItem\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"addItemModal\" aria-hidden=\"true\">
            <div class=\"modal-dialog\" role=\"document\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <h5 class=\"modal-title\" id=\"addItemModal\">Add Vehicle</h5>
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                    <div class=\"modal-body\">
                        <form method=\"post\" >
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"text\" name=\"name\" placeholder=\"Name\" required />
                            </div>
                            <div class=\"form-group\">
                                <input class=\"form-control\" type=\"text\" name=\"ident\" placeholder=\"Identifier\" />
                            </div>
                            <div class=\"form-group\">
                                <textarea class=\"form-control\" name=\"description\" placeholder=\"Description\" rows=\"3\" maxlength=\"500\"></textarea>
                            </div>
                            <div class=\"form-group\">
                                <select name=\"assignDD\">
                                    <option value=\"\" selected disabled hidden required>Assigned Too</option>";
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
?>