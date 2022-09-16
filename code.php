<?php
include_once 'classes/manageusercontr.class.php';

session_start();

function TestInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  return $data;
}

$reset = $_SESSION['resetcode'];
if (isset($_POST['submit'])) {
  $code = TestInput($_POST['code']);

  if ($code != $reset) {
    $msg2 = "Invalid code";
  } else {
    header("location: new_password.php");
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
  <title>Code</title>
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
        <div class="mx-auto text-center my-4">
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.php">
            <h1><img src="img/black.png" width="40px" height="35px" alt="logo">ream<sup>Mall</sup></h1>
          </a>
          <h4 class="my-3">Enter reset code!</h4>
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
        <div class="alert alert-success" role="alert"> An email has been sent to your email <strong><?php echo $_SESSION['email']; ?></strong>. Please check your email to get reset code </div>
        <div class="form-group">
          <label for="inputEmail" class="sr-only">Code</label>
          <input type="text" name="code" id="inputEmail" class="form-control form-control-lg" placeholder="Enter Code" required="" autofocus="">
        </div>
        <button class="btn btn-lg btn-secondary text-white btn-block" name="submit" type="submit">confirm</button>
        <p class="mt-5 mb-3 text-muted">
          Copyright &copy;<script>
            document.write(new Date().getFullYear());
          </script> All rights reserved | Developed By <a href="https://dreamcodemw.com" target="_blank">DreamCodeMw</a>
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