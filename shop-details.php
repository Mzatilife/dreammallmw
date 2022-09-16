<?php
session_start();
include_once "classes/profilecontr.class.php";
include_once "classes/shopscontr.class.php";
include_once "classes/manageusercontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;
$user = new ManageUserContr();

if (isset($_SESSION['shop_id'])) {
    $shop_id = $_SESSION['shop_id'];
} else {
    header("location:shops.php");
}

if (isset($_GET['prod_id'])) {
    $_SESSION['prod_id'] = $_GET['prod_id'];
    header("location:prod-details.php");
}

if (isset($_POST['search'])) {
    $search_name = $_POST['name'];
}

$row = $shop->viewShopUsingShopID($shop_id);
// $price = number_format($row['item_price']);
// $img = $shop->viewItemImages($row['item_id']);
$dist = $profile->viewDistrict($row['district_id']);
$us = $user->viewsUser($row['user_id']);
$type = $shop->viewCategoryWithId($row['cat_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Dreamcode's Mall">
    <meta name="keywords" content="DreamcodeMw, Mall, Mahala">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="img/black.png">
    <title>Shop Details</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
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
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
        </ul>
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
                            <li class="active"><a href="./shops.php">Shops</a></li>
                            <li><a href="./products.php">Products</a></li>
                            <li><a href="./blog.php">Blog</a></li>
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
                        <ul class="header__right__widget">
                            <li><span class="icon_search search-switch"></span></li>
                        </ul>
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
                        <a href="./shops.php"> Shops</a>
                        <span><?php echo $row['shop_name'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4><?php echo $row['shop_name'] ?>
                                </h4>
                            </div>
                            <div class="">
                                <p class="text-danger"><i><span class="fa fa-heart"></span> <?php echo $type['cat_name'] ?></i></p>
                                <img src="assets/images/logos/<?php echo $row['logo'] ?>" style="max-height: 150px" alt="shop image" class="rounded w-50">
                                <?php if ($row['verified'] == 1) { ?>
                                    <p><span class="badge badge-warning">certified by dream<sup>Mall</sup></span></p>
                                <?php } ?>
                                <p class="mt-3"><?php echo $dist['name'] . ", " . $row['area'] ?></p>
                                <?php
                                if (!empty($row['address'])) {
                                    echo "<p>P. O. Box " . $row['address'] . "</p>";
                                }
                                ?>
                                <p><span class="fa fa-phone"></span> <a href="tel:<?php echo $row['phone'] ?>"><?php echo $row['phone'] ?></a> ~ <a href="tel:<?php echo $row['phone_2'] ?>"><?php echo $row['phone_2'] ?></a></p>
                                <?php if (!empty($row['email'])) { ?>
                                    <p><span class="fa fa-envelope"></span> <a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a></p>
                                <?php } ?>
                            </div>
                            <hr>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading active">
                                            <a data-toggle="collapse" data-target="#collapseOne">Opening Time</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p><?php echo date('H:i a', strtotime($row['opening_time'])) ?> - <?php echo date('H:i a', strtotime($row['closing_time'])) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading active">
                                            <a data-toggle="collapse" data-target="#collapseTwo">Opening Days</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <p><?php echo $row['opening_days'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <?php if (!empty($row['whatsapp'])) { ?>
                                    <div class="col-3">
                                        <a href="https://wa.me/<?php echo $row['whatsapp']; ?>" class="bg-secondary p-2 text-white" style="border-radius: 25%;"><i class="fa fa-whatsapp"></i></a>
                                    </div>
                                <?php }
                                if (!empty($row['facebook'])) { ?>
                                    <div class="col-3">
                                        <a href="<?php echo $row['facebook']; ?>" class="bg-secondary p-2 text-white" style="border-radius: 25%;"><i class="fa fa-facebook"></i></a>
                                    </div>
                                <?php }
                                if (!empty($row['instagram'])) { ?>
                                    <div class="col-3">
                                        <a href="<?php echo $row['instagram']; ?>" class="bg-secondary p-2 text-white" style="border-radius: 25%;"><i class="fa fa-instagram"></i></a>
                                    </div>
                                <?php }
                                if (!empty($row['twitter'])) { ?>
                                    <div class="col-3">
                                        <a href="<?php echo $row['twitter']; ?>" class="bg-secondary p-2 text-white" style="border-radius: 25%;"><i class="fa fa-twitter"></i></a>
                                    </div>
                                <?php } ?>
                            </div>
                            <hr>
                            <div style="overflow: auto;" class="nice-scroll">
                                <p><a href="<?php echo $row['website'] ?>"><?php echo $row['website'] ?></a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <?php
                        //displaying the data ---------------------------------------------------------------------------------------->
                        @$page = $_GET["page"];

                        if ($page == "" || $page == "1") {

                            $page1 = 0;
                        } else {

                            $page1 = ($page * 8) - 8;
                        }
                        if (isset($search_name)) {
                            $prods = $shop->searchShopProduct($shop_id, $search_name, $page1, 8);
                        } else {
                            $prods = $shop->viewShopProductsWithLimit($shop_id, $page1, 8);
                        }
                        if (!empty($prods)) {
                            foreach ($prods as $prod) {
                                $price = number_format($prod['prod_price']);
                                $img = $shop->viewProductImage($prod['prod_id']);
                        ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="assets/images/products/<?php echo $img['image_name'] ?>">
                                            <?php if ($prod['prod_negotiable'] == 2) { ?>
                                                <div class="label new">Negotiable</div>
                                            <?php } ?>
                                            <ul class="product__hover">
                                                <li><a href="assets/images/products/<?php echo $img['image_name'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li><a href="shop-details.php?prod_id=<?php echo $prod['prod_id'] ?>"><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="shop-details.php?prod_id=<?php echo $prod['prod_id'] ?>"><?php echo $prod['prod_name'] ?></a></h6>
                                            <div class="rating">
                                                <?php if (isset($prod['prod_quantity'])) { ?>
                                                    <i><?php echo $prod['prod_quantity'] ?> items</i>
                                                <?php } else { ?>
                                                    <i>check it out</i>
                                                <?php } ?>
                                            </div>
                                            <?php if ($prod['prod_negotiable'] == 0 || $prod['prod_negotiable'] == 2) { ?>
                                                <div class="product__price"><?php echo $price ?> MWK</div>
                                            <?php } elseif ($prod['prod_negotiable'] == 1) { ?>
                                                <p class="badge badge-info">Price's negotiable</p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else {  ?>
                            <div class="container">
                                <div class="discount__text">
                                    <div class="discount__text__title">
                                        <h5>Oops!</h5>
                                        <h3>couldn't find the products/services!</h3>
                                        <p>Service or product might not have been added by the business owner.</p>
                                        <img src="./img/empty.svg" width="200px" alt="" srcset="">
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        if (isset($search_name)) {
                            $cout = $shop->countSearchShopProduct($shop_id, $search_name);
                        } else {
                            $cout = $shop->countShopProducts($shop_id);
                        }
                        $a = $cout / 8;

                        $a = ceil($a);
                        ?>
                        <div class="col-lg-12 text-center">
                            <div class="pagination__option">
                                <?php for ($b = 1; $b <= $a; $b++) {  ?>
                                    <a href="shop-details.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a>
                                <?php } ?>
                                <a href="#"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

    <!-- Footer Section Begin -->
    <?php include "./footer.php" ?>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="search-model-form">
                <input type="text" id="search-input" name="name" placeholder="Search shop.....">
                <input type="submit" name="search" hidden>
            </form>
        </div>
    </div>
    <!-- Search End -->
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