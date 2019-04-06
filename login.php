<?php 
session_start();
require("inc/dbconnect.php");

if(isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = md5($_POST["password"]);

  $getadmin = $mysqli->query("SELECT * FROM admin WHERE email = '$email' and password = '$password'");
  if($getadmin->num_rows == 1) {
    $_SESSION["admin"] = $getadmin->fetch_assoc();
    header("location:index.php");
  }
}

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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100 mx-auto">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper">
              <form action="" method="post">
                <div class="form-group">
                  <label class="label">Email</label>
                  <div class="input-group">
                    <input type="email" name="email" class="form-control" placeholder="Email address">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="icon-check"></i></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input type="password" name="password" class="form-control" placeholder="*********">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="icon-check"></i></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block" name="login">Login</button>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked>
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="register.html" class="text-black text-small">Create new account</a>
                </div>
              </form>
            </div>
            <ul class="auth-footer">
              <li><a href="#">Conditions</a></li>
              <li><a href="#">Help</a></li>
              <li><a href="#">Terms</a></li>
            </ul>
            <p class="footer-text text-center">copyright © 2018 Urbanui. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/template.js"></script>
  <!-- endinject -->
</body>

</html>
