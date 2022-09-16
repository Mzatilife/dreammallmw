<?php
session_start();
include_once "classes/profilecontr.class.php";
include_once "classes/shopscontr.class.php";
include_once "classes/blogcontr.class.php";
$blog = new BlogContr;
$profile = new ProfileContr;
$shop = new ShopsContr;
if (isset($_GET['blog_id'])) {
  $_SESSION['blog_id'] = $_GET['blog_id'];
  header("location:blog-details.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="description" content="Dreamcode's Mall" />
  <meta name="keywords" content="DreamcodeMw, Mall, Mahala" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="icon" href="img/black.png">
  <title>Blog</title>

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
              <li class="active"><a href="./blog.php">Blog</a></li>
              <li><a href="./contact.php">Contact</a></li>
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
            <span>Blog</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb End -->

  <!-- Blog Section Begin -->
  <section class="blog spad">
    <div class="container">
      <div class="row">

        <?php
        //displaying the data ---------------------------------------------------------------------------------------->
        @$page = $_GET["page"];

        if ($page == "" || $page == "1") {

          $page1 = 0;
        } else {

          $page1 = ($page * 6) - 6;
        }
        if (isset($_GET['cat_id'])) {
          $category_id = $_GET['cat_id'];
          $row = $blog->viewBlogAndCategory($category_id, $page1, 6);
        } else {
          $row = $blog->viewBlogWithLimit($page1, 6);
        }
        $index = 1;
        foreach ($row as $rw) {
          $date = strtotime($rw['date']);
          $comments = $blog->countComments($rw['blog_id']);
        ?>
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="blog__item">
              <div class="blog__item__pic set-bg" data-setbg="img/blog/<?php echo $rw['image'] ?>"></div>
              <div class="blog__item__text">
                <h6>
                  <a href="blog.php?blog_id=<?php echo $rw['blog_id'] ?>"><?php echo $rw['title'] ?>...</a>
                </h6>
                <ul>
                  <li>by <span><?php echo $rw['author'] ?></span></li>
                  <li><?php echo date("M d, Y", $date) ?></li>
                </ul>
              </div>
            </div>
          </div>
        <?php
        }

        if (isset($_GET['cat_id'])) {
          $category_id = $_GET['cat_id'];
          $cout = $blog->countBlogAndCategory($category_id);
        } else {
          $cout = $blog->countBlog();
        }
        $a = $cout / 6;

        $a = ceil($a);
        ?>
        <div class="col-lg-12 text-center">
          <?php for ($b = 1; $b <= $a; $b++) {  ?>
            <a href="blog.php?page=<?php echo $b; ?>" class="primary-btn load-btn"><?php echo $b . " "; ?></a>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
  <!-- Blog Section End -->

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