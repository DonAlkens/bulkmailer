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

?>


<!DOCTYPE html>
<html>

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
  <!-- plugins:css -->
  <div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
      <div class="nav-top flex-grow-1">
        <div class="container d-flex flex-row h-100">
          <div class="text-center navbar-brand-wrapper d-flex align-items-top">
            <!-- <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a> -->
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

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper px-3">

          <div class="card emailform">
                <div class="text-right">
                  <span class="badge badge-primary" style="cursor: pointer;" onclick="switch1();">View Status -> </i></span>
                </div>
                <div class="card-body">
                  <h4 class="card-title">E-Mail Form</h4>
                  <p class="card-description">
                    Send A Mail
                  </p> <span id="errorBox"></span>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputSubject1">Mail Subject</label>
                      <select type="text" class="form-control" id="exampleInputSubject1" placeholder="Mail Subject">
                        <option disabled selected="">Select Subject</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleBody1">Mail Body</label>
                      <textarea class="form-control" id="exampleBody1" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleEmail1">Emails</label>
                      <textarea class="form-control" id="exampleEmail1" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" id="send">Send Mail</button>
                    <button type="button" class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>

          <!-- List Table for Mail Status -->
          <div class="card listview">
            <div class="text-right">
              <span class="badge badge-primary" style="cursor: pointer;" onclick="switch2();">New E-Mail -> </span>
            </div>
            <div class="card-body">
              <h4 class="card-title">Status table</h4>
              <div class="review counter mt-3 mb-5" style="border-bottom: 1px solid #d7d7d7;">
                  <div class="row">
                    <div class="col-md-4 text-center">
                      <label>All Mails</label>
                      <h6 class="allmails">0</h6>
                    </div>
                    <div class="col-md-4 text-center">
                      <label>Sent</label>
                      <h6 class="sent">0</h6>
                    </div>
                    <div class="col-md-4 text-center">
                      <label>Unsent</label>
                      <h6 class="unsent">0</h6>
                    </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <div id="order-listing_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                    <div class="row">
                      <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="order-listing_length">
                          <label>Show 
                            <select name="order-listing_length" aria-controls="order-listing" class="form-control"><option value="5">5</option>
                              <option value="10">10</option>
                              <option value="15">15</option>
                              <option value="-1">All</option>
                            </select> entries
                          </label>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                          <div id="order-listing_filter" class="dataTables_filter">
                            <label>
                              <select name="status" id="status" aria-controls="order-listing" class="form-control"><option value="all" selected>All</option>
                              <option value="sent">Sent</option>
                              <option value="unsent">Unsent</option>
                            </select>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="order-listing" class="table dataTable no-footer" role="grid" aria-describedby="order-listing_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order #: activate to sort column descending" style="width: 71px;">No. #</th>
                        <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Purchased On: activate to sort column ascending" style="width: 120px;">Email Address</th>
                        <th class="sorting" tabindex="0" aria-controls="order-listing" rowspan="1" colspan="1" aria-label="Customer: activate to sort column ascending" style="width: 87px;">Status</th>
                      </tr>
                    </thead>
                    <tbody id="mailtable">
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-5">
                  <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div>
                </div>
                <div class="col-sm-12 col-md-7">
                  <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate"><ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="order-listing_previous">
                      <a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                    </li>
                    <li class="paginate_button page-item active">
                      <a href="#" aria-controls="order-listing" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                    </li>
                    <li class="paginate_button page-item next disabled" id="order-listing_next">
                      <a href="#" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>







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
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
