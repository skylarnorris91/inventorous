<!DOCTYPE html>
<?php    
    require '../genericDataAccess.php';
    require 'dataAccess.php';
    if(!empty($_POST['statName']) || !empty($_POST['statAddr']) || !empty($_POST['statPhone'])){
        updateStationData($_POST['statName'], $_POST['statAddr'], $_POST['statPhone']);
    }

    if($_POST['typeDD'] > 0 && !empty($_POST['number'])){
        addVehicleData($_POST['typeDD'], $_POST['number'], $_POST['make'], $_POST['model'], $_POST['year'], $_POST['comments']);
        header('Location: ../Station/stationMgnt.php?stationID='+$_GET['stationID']);
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Manage Station</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alata">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bebas+Neue">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="../assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script href="dataAccess.js"></script>
</head>

<body>
    <?php loadNav(); ?>
    <div class="container" style="background: #851515;">
        <?php userData(); ?>
    </div>
    <div class="container">
        <div class="col-md-6">
            <h2>Station Data</h2>
            <table id="stationTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    <?php loadStationData(); ?>
                </tbody>
            </table>
            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" style="background: rgb(133,21,21); border: none;" data-toggle="modal" data-target="#updateData">
                Update
            </button>
        </div>
        <hr>
        <table id="vehicleTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Number</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Comments</th>
                    <th style="width: 20px;"></th>
                    <th style="width: 20px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php loadTableData();?>
            </tbody>
        </table>
        <div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" style="background: rgb(133,21,21); border: none;" data-toggle="modal" data-target="#addVehicle">
            Add Vehicle
            </button>
        </div>
    </div>

    <?php loadModalData(); ?>

    <!-- Modal -->
    <div class="modal fade" id="addVehicle" tabindex="-1" role="dialog" aria-labelledby="addVehicleModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVehicleModal">Add Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" >
                        <div class="form-group">
                            <select name="typeDD">
                                <option value="" selected disabled hidden required>Vehicle Type</option>
                                <option value="1">Structure</option>
                                <option value="2">Medical</option>
                                <option value="3">Brush</option>
                                <option value="4">Ladder</option>
                                <option value="5">UTV</option>
                                <option value="6">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="number" placeholder="Number" required />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="make" placeholder="Vehicle Make" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="model" placeholder="Vehicle Model" />
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" name="year" placeholder="Vehicle Year" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comments" placeholder="Comments" rows="3" maxlength="500"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button name="AddVehicle" type="submit" class="btn btn-primary" style="background: rgb(133,21,21); border: none;">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
</body>

</html>