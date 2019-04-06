<?php 
session_start();
require("inc/dbconnect.php");


if(isset($_GET["logout"])) {
  unset($_SESSION["admin"]);
  session_destroy();
}

if(isset($_SESSION["admin"])) {

} else {
  header("location:login.php");
}


$getall = $mysqli->query("SELECT * FROM mail_status");
$all_no = $getall->num_rows;


$getsent = $mysqli->query("SELECT * FROM mail_status WHERE status = '1'");
$sent_no = $getsent->num_rows;


$getnotsent = $mysqli->query("SELECT * FROM mail_status WHERE status = '0'");
$notsent_no = $getnotsent->num_rows;


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>BULK EMAIL SENDER</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/simple-line-icon/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    <nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
      <div class="nav-top flex-grow-1">
        <div class="container d-flex flex-row h-100">
          <div class="text-center navbar-brand-wrapper d-flex align-items-top">
            <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <form class="search-field" action="#">
              <div class="form-group mb-0">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="search">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="icon-magnifier"></i></span>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav navbar-nav-right mr-0">
              <li class="nav-item nav-profile">
                <a class="nav-link" href="#">
                  <span class="nav-profile-text">Hello <?php echo $_SESSION["admin"]["firstname"]; ?></span>
                  <img src="images/faces/face1.jpg" class="rounded-circle" alt="profile"/>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?logout">
                  <i class="icon-logout" title="logout"></i>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="icon-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <a class="dropdown-item py-3">
                    <p class="mb-0 font-weight-medium float-left">You have 4 new notifications
                    </p>
                    <span class="badge badge-pill badge-inverse-info float-right">View all</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-inverse-success">
                        <i class="icon-exclamation mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                      <p class="font-weight-light small-text mb-0">
                        Just now
                      </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-inverse-warning">
                        <i class="icon-bubble mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                      <p class="font-weight-light small-text mb-0">
                        Private message
                      </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-inverse-info">
                        <i class="icon-user-following mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                      <p class="font-weight-light small-text mb-0">
                        2 days ago
                      </p>
                    </div>
                  </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="icon-menu text-white"></span>
            </button>
          </div>
        </div>
      </div>
      <div class="nav-bottom">
        <div class="container">
          <ul class="nav page-navigation">
            <li class="nav-item">
              <a href="index.php" class="nav-link"><i class="link-icon icon-screen-desktop"></i><span class="menu-title">Dashboard</span></a>
            </li>
            <li class="nav-item">
              <a href="email.php" class="nav-link"><i class="link-icon icon-envelope-letter"></i><span class="menu-title">Email</span></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-primary text-white border-0">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <i class="icon-layers icon-lg"></i>
                    <div class="ml-4">
                      <h4 class="font-weight-light">Total Mail</h4>
                      <h3 class="font-weight-light mb-3"><?php echo $all_no; ?></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-success text-white border-0">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <i class="icon-check icon-lg"></i>
                    <div class="ml-4">
                      <h4 class="font-weight-light">Sent Mail</h4>
                      <h3 class="font-weight-light mb-3"><?php echo $sent_no; ?></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-danger text-white border-0">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <i class="icon-ban icon-lg"></i>
                    <div class="ml-4">
                      <h4 class="font-weight-light">Unsent Mail</h4>
                      <h3 class="font-weight-light mb-3"><?php echo $notsent_no; ?></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 grid-margin stretch-card">
              <div class="card bg-dark text-white border-0">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <i class="icon-user icon-lg"></i>
                    <div class="ml-4">
                      <h4 class="font-weight-light">New users</h4>
                      <h3 class="font-weight-light mb-3">37, 650</h3>
                      <p class="mb-0 font-weight-light">43% more this year </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create Email Title</h4>
                  <div class="add-items d-flex">
                    <input type="text" class="form-control create-title" placeholder="Email Subject/Title">
                    <button class="add btn btn-primary create-title-add-btn" id="add-title">Add</button>
                  </div>
                  <div class="list-wrapper">
                    <ul class="d-flex flex-column-reverse title-list">
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- <div class="col-md-6 grid-margin grid-margin-md-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Issue rate</h4>
                  <div class="row">
                    <div class="col-md-5 d-flex align-items-center pr-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                      <canvas id="issues-chart" width="176" height="176" class="chartjs-render-monitor" style="display: block; width: 176px; height: 176px;"></canvas>
                    </div>
                    <div class="col-md-7">
                      <div class="border-bottom pb-4 mt-2 mt-md-0">
                        <h1 class="text-center text-md-left">12,456</h1>
                        <p class="text-center text-md-left mb-0">Issues this Month</p>
                      </div>
                      <div class="pt-4">
                        <div id="issues-chart-legend" class="issues-chart-legend"><ul class="legend1"><li><span class="legend-label" style="background-color:#f3f6f9"></span>Closed<span class="legend-percentage ml-auto">60%</span></li><li><span class="legend-label" style="background-color:#0766c6"></span>In progress<span class="legend-percentage ml-auto">30%</span></li><li><span class="legend-label" style="background-color:#00b297"></span>Open<span class="legend-percentage ml-auto">10%</span></li></ul></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

          </div>
        </div>


        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="w-100 clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a href="" target="_blank">Don Alkens</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="icon-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <script src="js/mailer.js"></script>
  <!-- endinject -->
</body>

</html>
