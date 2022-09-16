<?php
include_once 'classes/manageusercontr.class.php';

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';

$me = '';
$resetcode = '';

if (isset($_POST['continue'])) {
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
  $name = TestInput($_POST['fname']);
  if (empty($email)) {
    echo " ";
  } else {
    $_SESSION['fname'] = $name;
    $_SESSION['email'] = $email;

    $code = new ManageUserContr();
    $ans = $code->checkUser($name, $email);

    if ($ans) {

      $Generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $resetcode = substr(str_shuffle($Generator), 0, 4);
      //echo $resetcode;

      $mail = new PHPMailer(true);

      try {
        //Server settings
        $mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                     
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'projectmahala@gmail.com';
        $mail->Password   = 'jatpxeomxxghwssf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        //Recipients
        $mail->setFrom('projectmahala@gmail.com');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Dream Mall :  Recovery Code";
        $mail->Body    = "
                <div style = 'border-bottom: 2px solid #57648C; color:#57648C; padding:10px; border-radius: 10%; text-align:center; letter-spacing: 3px; line-height: 2.0;'>
                <p> Recovery Code: <b>$resetcode</b><br> Enter it in the field to reset your password </p>
                </div>
                ";

        $mail->send();
        $msg = 'We have sent a reset code to your email';

        $_SESSION['resetcode'] = $resetcode;
        header("refresh:2, url=code.php");
      } catch (Exception $e) {
        $msg2 = "Message could not be sent. Check internet connection";
      }
    } else {
      $msg2 = "Email and username not found";
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
  <title>Forgot Password</title>
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
      <form class="col-lg-6 col-md-8 col-10 mx-auto text-center bg-light rounded" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="mx-auto text-center my-4">
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.php">
            <h1><img src="img/black.png" width="40px" height="35px" alt="logo">ream<sup>Mall</sup></h1>
          </a>
          <h2 class="my-3">Reset Password</h2>
        </div>
        <p class="text-muted">We get it, stuff happens. Just enter your email address below
          and we'll send you a code to reset your password!</p>
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
          <label for="inputEmail" class="sr-only">First Name</label>
          <input type="text" name="fname" id="inputEmail" class="form-control form-control-lg" placeholder="First Name" required="" autofocus="">
        </div>
        <div class="form-group">
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" name="email" id="inputEmail" class="form-control form-control-lg" placeholder="Email address" required="" autofocus="">
        </div>
        <button class="btn btn-lg btn-secondary btn-block text-white" name="continue" type="submit">Reset Password</button>
        <div class="checkbox mb-3">
          <a href="forgot_password.php">forgot Password?</a><br>
          <a href="register.php">Don't have an account, register?</a>
        </div>
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