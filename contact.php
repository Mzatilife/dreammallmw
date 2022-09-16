<?php
include_once "classes/profilecontr.class.php";
include_once "classes/shopscontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';

if (isset($_POST['submit'])) {
  //********************** */ Validating the data and sanitising it ******************************
  function TestInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $from = TestInput($_POST['email']);
  $name = TestInput($_POST['name']);
  $subject = TestInput($_POST['subject']);
  $cmessage = TestInput($_POST['message']);

  $mail = new PHPMailer(true);

  //email confirmation
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
    $mail->addAddress('dreamcodemw@gmail.com');

    $mail->isHTML(true);

    $mail->Subject = "Message from dreammall.dreamcodemw.com.";

    $mail->Body = "
	<div style = 'border-bottom: 2px solid #57648C; color:#57648C; padding:10px; border-radius: 10%; text-align:center; letter-spacing: 3px; line-height: 2.0;'>
    <h2>{$name}</h2>
    <p><strong>Email:</strong> {$from}</p>
    <p><strong>Subject:</strong> {$subject}</p>
    <p>{$cmessage}</p>	
    </div>
	";

    $result = $mail->send();
    if ($result) {
      echo "<script>alert('Message sent successfully')</script>";
      echo "<script>window.open('contact.php', '_self')</script>";
    } else {
      echo "<script>alert('Message could not be sent')</script>";
      echo "<script>window.open('contact.php', '_self')</script>";
    }
  } catch (Exception $e) {
    echo "<script>alert('Message could not be sent')</script>";
    echo "<script>window.open('contact.php', '_self')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8" />
  <meta name="description" content="Dreamcode's Mall" />
  <meta name="keywords" content="DreamcodeMw, Mall, Mahala" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="icon" href="img/black.png">
  <title>Contact</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Css Styles -->
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/elegant-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
  <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />
  <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css" />
  <link rel="stylesheet" href="css/slicknav.min.css" type="text/css" />
  <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Offcanvas Menu Begin -->
  <div class="offcanvas-menu-overlay"></div>
  <div class="offcanvas-menu-wrapper">
    <div class="offcanvas__close">+</div>
    <div class="offcanvas__logo">
      <a href="./index.php" class="row">
        <img src="img/black.png" width="30px" height="25px" alt="logo">
        <h4>ream<sup>Mall</sup></h4>
      </a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__auth">
      <a href="./login.php">Login</a>
      <a href="./tsandcs.php">Register</a>
    </div>
  </div>
  <!-- Offcanvas Menu End -->

  <!-- Header Section Begin -->
  <header class="header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-3 col-lg-2">
          <div class="header__logo">
            <a href="./index.php">
              <h4><img src="img/black.png" width="30px" height="25px" alt="logo">ream<sup>Mall</sup></h4>
            </a>
          </div>
        </div>
        <div class="col-xl-6 col-lg-7">
          <nav class="header__menu">
            <ul>
              <li><a href="./index.php">Home</a></li>
              <li><a href="./shops.php">Shops</a></li>
              <li><a href="./products.php">Products</a></li>
              <li><a href="./blog.php">Blog</a></li>
              <li class="active"><a href="./contact.php">Contact</a></li>
              <li><button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target=".modal-full">Donate <span class="fa fa-money"></span></button></li>
            </ul>
          </nav>
        </div>
        <div class="col-lg-3">
          <div class="header__right">
            <div class="header__right__auth">
              <a href="./login.php">Login</a>
              <a href="./tsandcs.php">Register</a>
            </div>
          </div>
        </div>
      </div>
      <div class="canvas__open">
        <i class="fa fa-bars"></i>
      </div>
    </div>
  </header>
  <!-- Header Section End -->

  <!-- Breadcrumb Begin -->
  <div class="breadcrumb-option">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb__links">
            <a href="./index.php"><i class="fa fa-home"></i> Home</a>
            <span>Contact</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb End -->

  <!-- Contact Section Begin -->
  <section class="contact spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="contact__content">
            <div class="contact__address">
              <h5>Contact info</h5>
              <ul>
                <li>
                  <h6><i class="fa fa-map-marker"></i> Address</h6>
                  <p>
                    Dreamcode, Maselema, Blantyre 8, P. O. Box 80123
                  </p>
                </li>
                <li>
                  <h6><i class="fa fa-phone"></i> Phone</h6>
                  <p><span>+256 (0) 999 74 69 41</span><span>+256 (0) 888 74 70 52</span></p>
                </li>
                <li>
                  <h6><i class="fa fa-headphones"></i> Support</h6>
                  <p>dreamcodemw@gmail.com</p>
                </li>
              </ul>
            </div>
            <div class="contact__form">
              <h5>SEND MESSAGE</h5>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="text" name="subject" placeholder="Subject" required />
                <textarea placeholder="Message" name="message" required></textarea>
                <button type="submit" name="submit" class="site-btn">Send Message</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="contact__map">
            <iframe src="https://www.google.com/maps/d/viewer?mid=1tnnmkcqgxhFi_qoWhtjBz-xa4kk&ll=-15.786340512875896%2C35.00984399999998&z=12" height="780" style="border: 0" allowfullscreen="">
            </iframe>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Contact Section End -->

  <!-- Footer Section Begin -->
  <?php include "./footer.php" ?>
  <!-- Footer Section End -->

  <?php include "./donate.php"; ?>
  <!-- Js Plugins -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/mixitup.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.slicknav.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.nicescroll.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>