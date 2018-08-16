<?php  
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/vendors/material-dashboard-pro/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/vendors/material-dashboard-pro/assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>SPDPKM | Login</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="assets/vendors/material-dashboard-pro/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendors/material-dashboard-pro/assets/css/material-dashboard.css" rel="stylesheet" />
    <link href="assets/vendors/material-dashboard-pro/assets/css/demo.css" rel="stylesheet" />
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="off-canvas-sidebar">

    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="assets/vendors/material-dashboard-pro/assets/img/login.jpeg">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form method="POST" action="cores/auth/login_process.php">
                                <div class="card card-login">
                                    <div class="card-header text-center" data-background-color="green">
                                        <h4 class="card-title">Halaman Login</h4>
                                    </div>
                                    <div style="padding-left: 20px; padding-right: 20px;">
                                        <?php include 'views/partials/notification.php'; ?>
                                    </div>
                                    <p class="category text-center">
                                        Silahkan masukkan username dan password:
                                    </p>
                                    <div class="card-content">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">person</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Username</label>
                                                <input type="text" name="username" id="username" class="form-control">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">Password</label>
                                                <input type="password" name="password" id="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer text-center">
                                        <button type="submit" class="btn btn-success btn-wd btn-lg">Masuk</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendors/material-dashboard-pro/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/material.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/jquery.tagsinput.js"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/arrive.min.js" type="text/javascript"></script>
    <script src="assets/vendors/material-dashboard-pro/assets/js/material-dashboard.js"></script>

</body>

</html>