<!DOCTYPE html>
<?php    
    require '../genericDataAccess.php';
    require 'inventoryDataAccess.php';

    if(!empty($_POST['assignDD']) || !empty($_POST['description']) || !empty($_POST['ident']) || !empty($_POST['iName'])){
        addItem($_POST['assignDD'], $_POST['description'], $_POST['ident'], $_POST['iName']);
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
        <table id="itemTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Identifier</th>
                    <!-- Adding sort feature, IDK how to make the deptID and Station ID self generate. href="inventory.php?sort=desc&deptID=5&stationID=4"-->
                    <th>Description</th>
                    <th>Assigned To</th>
                    <th>Assigned Date</th>
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
            <button type="button" class="btn btn-primary" style="background: rgb(133,21,21); border: none;" data-toggle="modal" data-target="#addItem">
            Add Item
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