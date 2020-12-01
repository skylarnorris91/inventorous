<?php
function loadDeptTabs(){    
    require 'database.php';  
    $userID = $_SESSION['user_id'];
    $sql = "SELECT `deptID` FROM `userDepartmentRelation` WHERE (`userID` = '$userID' && `active` = '1')";
    $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $suRecords->execute();
    $active = "active";
    while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $sRecords = $conn->prepare('SELECT `ID`, `name` FROM `department` WHERE `ID` = :deptID');
            $sRecords->bindParam(':deptID', $row['deptID']);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $name = $sResults['name'];
        $deptID = $row['deptID'];
        echo "
            <li class=\"nav-item\" role=\"presentation\">
                <a class=\"nav-link nav-link-tabs $active\" role=\"tab\" data-toggle=\"tab\" href=\"#depttab-$deptID\" >";
        echo $sResults['name'];
        echo "
                </a>
            </li>";
        $active = "";
    }
}

function loadDeptTabData(){
    require 'database.php';  
    $userID = $_SESSION['user_id'];
    $sql = "SELECT `deptID` FROM `userDepartmentRelation` WHERE (`userID` = '$userID' && `active` = '1')";
    $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $suRecords->execute();
    $active = "active";
    while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $sRecords = $conn->prepare('SELECT `ID`, `name` FROM `department` WHERE `ID` = :deptID');
            $sRecords->bindParam(':deptID', $row['deptID']);
	    $sRecords->execute();
	    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
        $name = $sResults['name'];
        $deptID = $row['deptID'];
        echo "
              <div class=\"tab-pane $active\" role=\"tabpanel\" id=\"depttab-$deptID\">
                  <ul class=\"nav nav-tabs\" role=\"tablist\">";
                      loadStationTabs($deptID);
        echo "
                  </ul>
                  <div class=\"tab-content\">";
                      loadStationTabData($deptID);
        echo "
                  </div>
            </div>";
      $active = "";
    }
}

function loadStationTabs($dept){
    require 'database.php';  
    $userID = $_SESSION['user_id'];

    $sRecords = $conn->prepare('SELECT * FROM `userDepartmentRelation` WHERE (`userID` = :userID && `deptID` = :deptID && `active` = 1)');
        $sRecords->bindParam(':userID', $userID);
        $sRecords->bindParam(':deptID', $dept);
    $sRecords->execute();
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $allStations = $sResults['allStations'];
    $accessLvL = $sResults['accessLvL'];
    $active = "active";
    if($allStations == 1 )
    {
        $sqlStat ="SELECT `ID`, `name` FROM `station` WHERE `deptID` = '$dept' && `active` = 1";
            $sRecords = $conn->prepare($sqlStat, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $sRecords->execute();
        while($innerRow = $sRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $name = $innerRow['name'];
            $statID = $innerRow['ID'];
            echo "
                <li class=\"nav-item\" role=\"presentation\">
                    <a class=\"nav-link nav-link-tabs $active\" role=\"tab\" data-toggle=\"tab\" href=\"#tab-$statID\" >";
            echo $name;
            echo "
                    </a>
                </li>";
            $active = "";
        }
    }
    else if ($accessLvL > 0)
    {
        $sql = "SELECT `stationID` FROM `userStationRelation` WHERE (`userID` = '$userID' && `deptID` = '$dept' && `active` = 1)";
        $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $suRecords->execute();

        while($row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $statID = $row['stationID'];
            $sqlStat ="SELECT `ID`, `name` FROM `station` WHERE `ID` = '$statID'";
            $sRecords = $conn->prepare($sqlStat, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $sRecords->execute();
            $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);

            $name = $sResults['name'];
            $statID = $sResults['ID'];
            echo "
                <li class=\"nav-item\" role=\"presentation\">
                    <a class=\"nav-link nav-link-tabs $active\" role=\"tab\" data-toggle=\"tab\" href=\"#tab-$statID\" >";
            echo $name;
            echo "
                    </a>
                </li>";
            $active = "";
        }
    }
}

function loadStationTabData($dept){
    require 'database.php';  
    $userID = $_SESSION['user_id'];

    $sRecords = $conn->prepare('SELECT * FROM `userDepartmentRelation` WHERE (`userID` = :userID && `deptID` = :deptID)');
        $sRecords->bindParam(':userID', $userID);
        $sRecords->bindParam(':deptID', $dept);
    $sRecords->execute();
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $allStations = $sResults['allStations'];
    $accessLvL = $sResults['accessLvL'];
    $active = "active";
        if($accessLvL == 5){
            echo "
                <div class=\"row\">
                    <div class=\"col\" style=\"text-align: center;min-height: 200px;padding-top: 20px;padding-bottom: 20px;\">
                        <a href=\"Department/deptMgnt.php?deptID=$dept\">
                            <i class=\"fa fa-building\" style=\"text-align: center;font-size: 100px;color: rgb(133,21,21);padding-top: 20px;\"></i>
                            <div class=\"row\">
                                <div class=\"col\">
                                    <span style=\"color: rgb(67,67,67);font-size: 20px;\">
                                        Manage Department
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>";
        }
    if($allStations == 1 )
    {
        $sqlStat ="SELECT `ID`, `name` FROM `station` WHERE `deptID` = '$dept'";
            $sRecords = $conn->prepare($sqlStat, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $sRecords->execute();
        while($innerRow = $sRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
            $name = $innerRow['name'];
            $statID = $innerRow['ID'];
            echo "
                <div class=\"tab-pane $active\" role=\"tabpanel\" id=\"tab-$statID\">";
                  loadStationTabInnerData($statID, $accessLvL, $dept);
            echo "
                </div>";
            $active = "";
        }
    }
    else
    {
        $sql = "SELECT `stationID` FROM `userStationRelation` WHERE (`userID` = '$userID' && `deptID` = '$dept')";
        $suRecords = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $suRecords->execute();
        $active = "active";
        $row = $suRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

        $statID = $row['stationID'];
        $sqlStat ="SELECT `ID`, `name` FROM `station` WHERE `ID` = '$statID'";
        $sRecords = $conn->prepare($sqlStat, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $sRecords->execute();
        $innerRow = $sRecords->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $name = $innerRow['name'];
        $statID = $innerRow['ID'];
        echo "
            <div class=\"tab-pane $active\" role=\"tabpanel\" id=\"tab--$statID\">";
                loadStationTabInnerData($statID, $accessLvL, $dept);
        echo "
            </div>";
        $active = "";
    }
}


function loadStationTabInnerData($stationID, $accessLvL, $deptID){
  if($accessLvL == 1 || $accessLvL == 5){
      echo "
      <div class=\"row\">";
        echo "
            <div class=\"col\" style=\"text-align: center;min-height: 200px;padding-top: 20px;padding-bottom: 20px;\">
                <a href=\"Station/stationMgnt.php?deptID=$deptID&stationID=$stationID\">
                    <i class=\"fa fa-truck\" style=\"text-align: center;font-size: 100px;color: rgb(133,21,21);padding-top: 20px;\"></i>
                    <div class=\"row\">
                        <div class=\"col\">
                            <span style=\"color: rgb(67,67,67);font-size: 20px;\">
                                Manage Station
                            </span>
                        </div>
                    </div>
                </a>
            </div>
          <div class=\"col\" style=\"text-align: center;min-height: 200px;padding-top: 20px;padding-bottom: 20px;\">
              <a href=\"Member/memberMgnt.php?deptID=$deptID&stationID=$stationID\">
                  <i class=\"fa fa-users\" style=\"font-size: 100px;text-align: center;padding-top: 20px;color: rgb(133,21,21);\"></i>
                  <div class=\"row\">
                      <div class=\"col\" style=\"color: rgb(67,67,67);\">
                          <span style=\"color: rgb(67,67,67);font-size: 20px;\">
                              Manage Members
                          </span>
                      </div>
                  </div>
              </a>
          </div>
          <div class=\"col\" style=\"text-align: center;min-height: 200px;padding-top: 20px;padding-bottom: 20px;\">
                <a href=\"Inventory/inventory.php?deptID=$deptID&stationID=$stationID\">
                  <i class=\"fa fa-fire-extinguisher\" style=\"font-size: 100px;text-align: center;color: rgb(133,21,21);padding-top: 20px;\"></i>
                  <div class=\"row\">
                      <div class=\"col\">
                          <span style=\"color: rgb(67,67,67);font-size: 20px;\">
                              Manage Inventory
                          </span>
                      </div>
                  </div>
              </a>
          </div>
      </div>
      <div class=\"row\">";
  }
  else{
      echo "<div class=\"row\">
       <div class=\"col\" style=\"text-align: center;min-height: 200px;padding-top: 20px;padding-bottom: 20px;\">
            <a href=\"Inventory/inventory.php?deptID=$deptID&stationID=$stationID\">
                <i class=\"fa fa-fire-extinguisher\" style=\"font-size: 100px;text-align: center;color: rgb(133,21,21);padding-top: 20px;\"></i>
                <div class=\"row\">
                    <div class=\"col\">
                        <span style=\"color: rgb(67,67,67);font-size: 20px;\">
                            Manage Inventory
                        </span>
                    </div>
                </div>
            </a>
        </div>";
  }
  echo "
    </div>";
}

function addDeptData($deptName, $email, $passwordReg, $comments){
    require 'database.php';
    $fName = "root";
    
    $sRecords = $conn->prepare("INSERT INTO `member`(`email`, `password`) VALUES ('$email', '$passwordReg')");
	$sRecords->execute(); 

    $sRecords = $conn->prepare( "SELECT MAX(ID) FROM `member`");
        $sRecords->execute(); 
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $memID = $sResults['MAX(ID)'];

    $sRecords = $conn->prepare("INSERT INTO `user`(`memberID`, `fName`, `lName`) VALUES ('$memID', '$fName', '$deptName')");
	    $result = $sRecords->execute(); 

    $sRecords = $conn->prepare( "SELECT MAX(ID) FROM `user`");
        $sRecords->execute(); 
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $userID = $sResults['MAX(ID)'];

    $sRecords = $conn->prepare("INSERT INTO `department`(`name`) VALUES ('$deptName')");
	    $result = $sRecords->execute(); 

    $sRecords = $conn->prepare( "SELECT MAX(ID) FROM `department`");
        $sRecords->execute(); 
    $sResults = $sRecords->fetch(PDO::FETCH_ASSOC);
    $deptID = $sResults['MAX(ID)'];

    $sRecords = $conn->prepare("INSERT INTO `userDepartmentRelation`(`userID`, `deptID`, `allStations`, `accessLvL`, `memberNum`) 
                                    VALUES ($userID, $deptID, 1, 5, 'Root')");
	    $result = $sRecords->execute(); 
}

?>