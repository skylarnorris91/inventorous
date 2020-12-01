<!DOCTYPE html>
<?php    
    require '../genericDataAccess.php';
    require 'dataAccess.php';
    if(!empty($_POST['deptName'])){
        updateDeptData($_POST['deptName']);
    }

    if(!empty($_POST['stationName']) && !empty($_POST['address']) && !empty($_POST['phone'])){
        addStationData($_POST['stationName'], $_POST['address'], $_POST['phone'], $_POST['comments']);
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Manage Department</title>
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
            <h2>Department Data</h2>
            <table id="stationTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php loadDeptData(); ?>
                </tbody>
            </table>
            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" style="background: rgb(133,21,21); border: none;" data-toggle="modal" data-target="#updateData">
                Update
            </button>
        </div>
        <hr>
        <div class="filter">
            <?php //loadFilterData(); ?>
        </div>
        <table id="stationTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
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
            <button type="button" class="btn btn-primary" style="background: rgb(133,21,21); border: none;" data-toggle="modal" data-target="#addStation">
            Add Station
            </button>

            <?php loadModalData();?>

            <!-- Modal -->
            <div class="modal fade" id="addStation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Station</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                <div class="form-group">
                                    <input class="form-control" type="name" name="stationName" placeholder="Station Name" required /></div>
                                <div class="form-group">
                                    <input class="form-control" type="address" name="address" placeholder="Address" required /></div>
                                <div class="form-group">
                                    <input class="form-control" type="tel" name="phone" placeholder="Phone Number" required /></div>
                                <div class="form-group">
                                    <textarea class="form-control" name="comments" placeholder="Comments" rows="3" maxlength="500"></textarea></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="background: rgb(133,21,21); border: none;">Save changes</button>
                            </form>
                        </div>
                    </div>
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