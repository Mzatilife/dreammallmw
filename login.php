<?php
session_start();
unset($_SESSION['fname']);
unset($_SESSION['user_id']);
include_once "classes/manageusercontr.class.php";

if (isset($_POST['login'])) {

  //********************** */ Validating the data and sanitising it ******************************
  function TestInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $email = TestInput($_POST['email']);
  $password = TestInput($_POST['password']);

  // passing login information
  $login = new ManageUserContr;
  $msg2 = $login->userLogin($email, $password);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="img/black.png">
  <title>Login</title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="admin/css/simplebar.css">
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="admin/css/feather.css">
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="admin/css/daterangepicker.css">
  <!-- App CSS -->
  <link rel="stylesheet" href="admin/css/app-light.css" id="lightTheme">
  <link rel="stylesheet" href="admin/css/app-dark.css" id="darkTheme" disabled>
</head>

<body class="light bg-secondary">
  <div class="wrapper" style="height:500px">
    <div class="row align-items-center h-100">
      <form class="col-lg-3 col-md-4 col-10 mx-auto text-center bg-light rounded" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.php">
          <h1><img src="img/black.png" width="40px" height="35px" alt="logo">ream<sup>Mall</sup></h1>
        </a>
        <h1 class="h6 mb-3">Sign in</h1>
        <?php
        if (isset($msg)) { ?>
          <div class="alert alert-success text-center fade show mt-3" role="alert">
            <?php echo $msg; ?>
          </div>
        <?php
        } elseif (isset($msg2)) { ?>
          <div class="alert alert-danger text-center fade show mt-3" role="alert">
            <?php echo $msg2; ?>
          </div>
        <?php } else {
        } ?>
        <div class="form-group">
          <label for="inputEmail" class="sr-only">Email or Phone Number</label>
          <input type="text" name="email" id="inputEmail" class="form-control form-control-lg" placeholder="Email or Number" required="" autofocus="">
        </div>
        <div class="form-group">
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" name="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required="">
        </div>
        <button class="btn btn-lg btn-secondary btn-block text-white" type="submit" name="login">Let me in</button>
        <div class="checkbox mb-3">
          <a href="forgot_password.php">forgot Password?</a><br>
          <a href="register.php">Don't have an account, register?</a>
        </div>
        <p class="mt-5 mb-3 text-muted">
          Copyright &copy;<script>
            document.write(new Date().getFullYear());
          </script> All rights reserved | Developed By <a href="https://dreamcodemw.com" target="_blank">DreamcodeMw</a>
        </p>
      </form>
    </div>
  </div>
  <script src="admin/js/jquery.min.js"></script>
  <script src="admin/js/popper.min.js"></script>
  <script src="admin/js/moment.min.js"></script>
  <script src="admin/js/bootstrap.min.js"></script>
  <script src="admin/js/simplebar.min.js"></script>
  <script src='admin/js/daterangepicker.js'></script>
  <script src='admin/js/jquery.stickOnScroll.js'></script>
  <script src="admin/js/tinycolor-min.js"></script>
  <script src="admin/js/config.js"></script>
  <script src="admin/js/apps.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
  </script>
</body>

</html>
</body>

</html>