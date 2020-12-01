<?php 
    function addStation($StationName, $StationAddr, $StationPhone){
	    require 'database.php';
        $mRecords = $conn->prepare('INSERT INTO station (name, address, phoneNum) 
                                      VALUES (:StationName, :StationAddr, :StationPhone)');
	        $mRecords->bindParam(':StationName', $StationName);
	        $mRecords->bindParam(':StationAddr', $StationAddr);
	        $mRecords->bindParam(':StationPhone', $StationPhone);
            $mRecords->execute();
    
        $uRecords = $conn->prepare('SELECT ID FROM station 
                                      WHERE name = :StationName && address = :StationAddr');
	        $uRecords->bindParam(':StationName', $StationName);
	        $uRecords->bindParam(':StationAddr', $StationAddr);
            $uRecords->execute();
	        $uResults = $uRecords->fetch(PDO::FETCH_ASSOC);

        $accesslvl = 1;
        $stationID = $uResults['ID'];
        $userID = $_SESSION['user_id'];
	
        $usRecords = $conn->prepare('INSERT INTO `userStationRelation`(`userID`, `stationID`, `accessLvL`) 
                                        VALUES (:userID, :stationID, :accessLvL)');
	        $usRecords->bindParam(':userID', $userID);
            $usRecords->bindParam(':stationID', $stationID);
            $usRecords->bindParam(':accessLvL', $accesslvl);
            $usRecords->execute();
    }

    function registerUser($email, $passowrd, $firstName, $lastName){
        require 'database.php';
        echo $email + $passowrd + $firstName + $lastName;
        $rsEmails = $conn->prepare("SELECT * FROM member WHERE email = :email");
            $rsEmails->bindParam(':email', $email);
    
        $numEmails = mysqli_num_rows($rsEmails);

        if($numEmails > 0) {
            echo "User already exists";
        } else {
            $mRecords = $conn->prepare('INSERT INTO member (email, password) VALUES (:email, :password)');
	        $mRecords->bindParam(':email', $email);
	        $mRecords->bindParam(':password', password_hash($passowrd, PASSWORD_BCRYPT));

            if($mRecords->execute()){
                $miEmails = $conn->prepare("SELECT * FROM member WHERE email = :email");
    	        $miEmails->bindParam(':email', $email);
              $miEmails->execute();
              $miResult = $miEmails->fetch(PDO::FETCH_ASSOC);
              
            $uRecords = $conn->prepare('INSERT INTO user (memberID ,fName, lName) VALUES (:memberID, :fname, :lname)');
                $uRecords->bindParam(':memberID', $miResult['ID']);
	            $uRecords->bindParam(':fname', $firstName);
	            $uRecords->bindParam(':lname', $lastName);
            }
        }
    }

?>