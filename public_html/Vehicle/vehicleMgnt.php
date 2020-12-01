<!DOCTYPE html>
<?php    
    require '../genericDataAccess.php';
    require 'dataAccess.php';
    
    if($_POST['typeDD'] > 0 || !empty($_POST['number']) || !empty($_POST['year']) || !empty($_POST['make']) || !empty($_POST['model']) || !empty($_POST['comments'])){
        updateInfo($_POST['typeDD'], $_POST['number'], $_POST['year'], $_POST['make'], $_POST['model'], $_POST['comments']);
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Manage Vehicle</title>
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
        <div class="filter">
                        <table id="stationTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Engine Number</th>
                        <th>Year</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php loadVehicleData(); ?>
                </tbody>
            </table>
            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" style="background: rgb(133,21,21); border: none;" data-toggle="modal" data-target="#updateData">
                Update
            </button>
        </div>
    </div>
    <?php loadModalData(); ?>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
</body>

</html>