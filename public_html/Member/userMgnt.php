<!DOCTYPE html>
<?php    
    require '../genericDataAccess.php';
    require 'userDataAccess.php';
    if(!empty($_POST['oldPass']) || !empty($_POST['newPass'])){
        updatePass($_POST['oldPass'], password_hash($_POST['newPass'], PASSWORD_BCRYPT));
    }
    if(!empty($_POST['lname']) || !empty($_POST['fname']) || !empty($_POST['memID']) 
    || !empty($_POST['email'])){
        updateInfo($_POST['lname'], $_POST['fname'], $_POST['memID'], $_POST['email']
            , $_POST['comments'], $_POST['roleDD'], $_POST['allAccessDD']);
    }
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Manage Member</title>
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
        <table id="memberTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>ID Number</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php loadUserData();?>
            </tbody>
        </table>
        
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" style="background: rgb(133,21,21); border: none;" data-toggle="modal" data-target="#updateData">
            Update User Data
        </button>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" style="background: rgb(133,21,21); border: none;" data-toggle="modal" data-target="#updatePassword">
            Update Password
        </button>
    </div>

    <div>
        <!-- Modal -->
        <div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update User Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <input class="form-control" type="password" name="oldPass" placeholder="Old Password" required /></div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="newPass" placeholder="New Password" required /></div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="newPass-repeat" placeholder="New Password (repeat)" required /></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="background: rgb(133,21,21); border: none;">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="updateData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Uder Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <input class="form-control" type="name" name="fname" placeholder="First Name" /></div>
                            <div class="form-group">
                                <input class="form-control" type="name" name="lname" placeholder="Last Name" /></div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="memID" placeholder="Member ID" /></div>
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="Email" /></div>
                            <div class="form-group">
                                <select name="roleDD">
                                    <option value="" selected disabled hidden required>User Role</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Officer</option>
                                    <option value="3">Member</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="allAccessDD">
                                    <option value="" selected disabled hidden required>Access All Department Stations</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
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
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
</body>

</html>