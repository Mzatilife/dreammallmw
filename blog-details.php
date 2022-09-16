<?php
session_start();
include_once "classes/profilecontr.class.php";
include_once "classes/shopscontr.class.php";
include_once "classes/blogcontr.class.php";
$blog = new BlogContr;
$profile = new ProfileContr;
$shop = new ShopsContr;
$blog_id = $_SESSION['blog_id'];

$row = $blog->viewBlogById($blog_id);
$date = strtotime($row['date']);

$comments = $blog->countComments($blog_id);

if (isset($_POST['comment'])) {
  //********************** */ Validating the data and sanitising it ******************************
  function TestInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $name = TestInput($_POST['name']);
  $email = TestInput($_POST['email']);
  $comment = TestInput($_POST['details']);

  $result = $blog->commentBlog($blog_id, $name, $email, $comment);

  if ($result) {
    $msg = "Comment submitted";
  } else {
    $msg2 = "Error, couldn't submit comment";
  }
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
  <title>Blog Details</title>

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
            <a href="./blog.php">Blog</a>
            <span><?php echo $row['title'] ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb End -->

  <!-- Blog Details Section Begin -->
  <section class="blog-details spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
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
          }
          ?>
          <div class="blog__details__content">
            <div class="blog__details__item">
              <img class="img-fluid" src="img/blog/<?php echo $row['image'] ?>" alt="" />
              <div class="blog__details__item__title">
                <span class="tip"><?php echo $row['category_name'] ?></span>
                <h4>
                  <?php echo $row['title'] ?>
                </h4>
                <ul>
                  <li>by <span><?php echo $row['author'] ?></span></li>
                  <li><?php echo date("M d, Y", $date) ?></li>
                  <li><?php echo $comments ?> Comments</li>
                </ul>
              </div>
            </div>
            <div class="blog__details__desc">
              <p class="text-justify">
                <?php echo $row['content'] ?>
              </p>
            </div>
            <div class="blog__details__comment">
              <h5><?php echo $comments ?> Comments</h5>
              <a href="#leavecomment" class="leave-btn">Leave a comment</a>
              <?php
              //displaying the data ---------------------------------------------------------------------------------------->
              @$page = $_GET["page"];

              if ($page == "" || $page == "1") {

                $page1 = 0;
              } else {

                $page1 = ($page * 4) - 4;
              }
              $row = $blog->viewComments($blog_id, $page1, 4);
              foreach ($row as $rw) {
                $date = strtotime($rw['date']);
              ?>
                <div class="blog__comment__item">
                  <div class="blog__comment__item__text">
                    <h6><?php echo $rw['name'] ?></h6>
                    <p>
                      <?php echo $rw['comment'] ?>
                    </p>
                    <ul>
                      <li><i class="fa fa-clock-o"></i> <?php echo date("M d, Y", $date) ?></li>
                    </ul>
                  </div>
                </div>
              <?php }

              $cout = $blog->countComments($blog_id);

              $a = $cout / 4;

              $a = ceil($a);
              ?>
              <div class="col-lg-12 text-center">
                <?php for ($b = 1; $b <= $a; $b++) {  ?>
                  <a href="blog-details.php?page=<?php echo $b; ?>" class="primary-btn load-btn"><?php echo $b . " "; ?></a>
                <?php } ?>
              </div>
            </div>

            <div class="contact__form" id="leavecomment">
              <h5 class="mb-1 mt-5">Leave a comment</h5>
              <form class="form-contact comment_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="commentForm">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <textarea class="form-control w-100" name="details" id="comment" cols="30" rows="9" placeholder="Write Comment" required></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input class="form-control" name="name" id="name" type="text" placeholder="Name" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input class="form-control" name="email" id="email" type="email" placeholder="Email" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="comment" class="site-btn">comment</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="blog__sidebar">
            <div class="blog__sidebar__item">
              <div class="section-title">
                <h4>Categories</h4>
              </div>
              <ul>
                <?php
                $row = $blog->viewCategories();
                foreach ($row as $rw) {
                  $cat_id = $rw['category_id'];
                  $blogs = $blog->countBlogAndCategory($cat_id);
                ?>
                  <li>
                    <a href="blog.php?cat_id=<?php echo $cat_id ?>" class="text-capitalize"><?php echo $rw['category_name'] ?> <span>(<?php echo $blogs; ?>)</span></a>
                  </li>
                <?php } ?>
              </ul>
            </div>
            <div class="blog__sidebar__item">
              <div class="section-title">
                <h4>Recent posts</h4>
              </div>
              <?php
              $row = $blog->viewBlogWithLimit(0, 4);
              $index = 1;
              foreach ($row as $rw) {
                $date = strtotime($rw['date']);
              ?>
                <a href="blog.php?blog_id=<?php echo $rw['blog_id'] ?>" class="blog__feature__item">
                  <div class="blog__feature__item__pic">
                    <img src="img/blog/<?php echo $rw['image'] ?>" class="img-responsive" style="max-height: 100px; max-width:100px;" />
                  </div>
                  <div class="blog__feature__item__text">
                    <h6><?php echo $rw['title'] ?>...</h6>
                    <span><?php echo date("M d, Y", $date) ?></span>
                  </div>
                </a>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Blog Details Section End -->

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