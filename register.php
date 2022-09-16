<?php
session_start();
unset($_SESSION['fname']);
unset($_SESSION['user_id']);
include_once "classes/manageusercontr.class.php";

if (isset($_POST['register'])) {
  //********************** */ Validating the data and sanitising it ******************************
  function TestInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $fname = TestInput($_POST['fname']);
  $lname = TestInput($_POST['lname']);
  $phone = TestInput($_POST['num1']);
  $phone2 = (!empty($_POST['num2']) ? TestInput($_POST['num2']) : null);
  $email = (!empty($_POST['email']) ? TestInput($_POST['email']) : null);
  $pass1 = TestInput($_POST['password']);
  $pass2 = TestInput($_POST['password2']);

  $register = new ManageUserContr;

  //email validation-------------------------------------------------------------------------------------------------->
  if (!empty($_POST['email']) && filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    $msg2 = " Invalid email address!";
  }
  //if confirmation pwd == main pwd ---------------------------------------------------------------------------------->
  elseif ($pass1 != $pass2) {
    $msg2 = " The two passwords did not match!";
  } else {
    $result = $register->registerUser($fname, $lname, $phone, $phone2, $email, $pass1, "owner");
    if ($result) {
      $msg2 = $result;
    }
  }
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
  <title>Register</title>
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

  <script type="text/javascript">
    function checkPass() {
      //Store the password field objects into variables ...
      var password = document.getElementById('password');
      var confirm = document.getElementById('password2');
      //Set the colors we will be using ...
      var good_color = "#66cc66";
      var bad_color = "#ff6666";
      if (password.value == confirm.value) {
        confirm.style.backgroundColor = good_color;
      } else {
        confirm.style.backgroundColor = bad_color;
      }
    }
  </script>
</head>

<body class="light  bg-secondary">
  <div class="wrapper vh-100">
    <div class="row align-items-center h-100">
      <form class="col-lg-8 col-md-8 col-10 mx-auto bg-light rounded" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mx-auto text-center my-4">
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.php">
            <h1><img src="img/black.png" width="40px" height="35px" alt="logo">ream<sup>Mall</sup></h1>
          </a>
          <h5 class="my-3">Create an account</h5>
        </div>
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

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="firstname">Phone <b class="text-danger">*</b></label>
            <input type="text" name="num1" pattern="[0-9]{10,10}" title="phone number must be 10 digits" placeholder="i.e 088X XXX XXX" id="firstname" class="form-control" required>
          </div>
          <div class="form-group col-md-6">
            <label for="lastname">Phone 2 <span class="text-muted">(optional)</span></label>
            <input type="text" name="num2" pattern="[0-9]{10,10}" title="phone number must be 10 digits" placeholder="i.e 099X XXX XXX" id="lastname" class="form-control">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email <span class="text-muted">(optional)</span></label>
            <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="example@company.com">
          </div>
          <div class="form-group col-md-3">
            <label for="firstname">Firstname <b class="text-danger">*</b></label>
            <input type="text" name="fname" pattern="[a-zA-Z ]+" title="first name can't have digits!" placeholder="i.e John" id="firstname" class="form-control" required>
          </div>
          <div class="form-group col-md-3">
            <label for="lastname">Lastname <b class="text-danger">*</b></label>
            <input type="text" name="lname" pattern="[a-zA-Z ]+" title="last name can't have digits!" placeholder="i.e Doe" id="lastname" class="form-control" required>
          </div>
        </div>
        <hr class="my-3">
        <div class="row mb-4">
          <div class="col-md-6">
            <div class="form-group">
              <label for="password">New Password <b class="text-danger">*</b></label>
              <input type="password" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password" onkeyup="checkPass();">
            </div>
            <div class="form-group">
              <label for="password2">Confirm Password <b class="text-danger">*</b></label>
              <input type="password" name="password2" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup="checkPass();" id="password2">
            </div>
          </div>
          <div class="col-md-6">
            <p class="mb-2">Password requirements</p>
            <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
            <ul class="small text-muted pl-4 mb-0">
              <li> Minimum 8 character </li>
              <li>At least one special character</li>
              <li>Atleast one uppercase letter </li>
              <li>At least one number</li>
            </ul>
          </div>
        </div>
        <button class="btn btn-md btn-secondary btn-block text-white" type="submit" name="register">Sign up</button>
        <div class="mx-auto text-center mt-3">
          <a href="forgot_password.php">forgot Password?</a><br>
          <a href="login.php">Already have an account, Login?</a>
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