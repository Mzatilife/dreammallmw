<?php
session_start();
include_once "classes/profilecontr.class.php";
include_once "classes/shopscontr.class.php";
include_once "classes/manageusercontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;
$user = new ManageUserContr();

if (isset($_SESSION['prod_id'])) {
    $prod_id = $_SESSION['prod_id'];
} else {
    header("location:shop-details.php");
}

if (isset($_GET['shop_id'])) {
    $_SESSION['shop_id'] = $_GET['shop_id'];
    $views = $_GET['views'] + 1;
    $shop->changeViews('shops', 'shop_id', $_GET['shop_id'], $views);
    header("location:shop-details.php");
}

if (isset($_GET['prod_id'])) {
    $_SESSION['prod_id'] = $_GET['prod_id'];
    header("location:prod-details.php");
}

$row = $shop->viewProductDetails($prod_id);
$price = number_format($row['prod_price']);
$imgs = $shop->viewProductImages($row['prod_id']);
$sp = $shop->viewShopUsingShopID($row['shop_id']);
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
    <title>Product Details</title>

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
                        <a href="./prod-details.php?shop_id=<?php echo $sp['shop_id'] ?>&views=<?php echo $sp['views']; ?>"><?php echo $sp['shop_name'] ?> </a>
                        <span><?php echo $row['prod_name'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll" style="height: 300px;">
                            <?php
                            foreach ($imgs as $img) {
                            ?>
                                <a class="pt" href="#product-<?php echo $img['image_id'] ?>">
                                    <img src="assets/images/products/<?php echo $img['image_name'] ?>" alt="" />
                                </a>
                            <?php } ?>
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                <?php
                                foreach ($imgs as $img) {
                                ?>
                                    <img data-hash="product-<?php echo $img['image_id'] ?>" class="product__big__img img-reponsive" style="height: 300px;" src="assets/images/products/<?php echo $img['image_name'] ?>" alt="" />
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>
                            <?php echo $row['prod_name'] ?>
                        </h3>
                        <?php if ($row['prod_negotiable'] == 0) { ?>
                            <div class="product__details__price">
                                <?php echo $price ?> MWK
                            </div>
                        <?php } elseif ($row['prod_negotiable'] == 1) { ?>
                            <p class="badge badge-info">Price's negotiable</p>
                        <?php } elseif ($row['prod_negotiable'] == 2) { ?>
                            <div class="product__details__price">
                                <?php echo $price ?> MWK
                            </div>
                            <span class="badge badge-info">Price's negotiable</span>
                        <?php } ?>
                        <h6>Description</h6>
                        <p class="text-justify">
                            <?php echo $row['prod_description'] ?>
                        </p>
                        <div class="product__details__widget">
                            <ul>
                                <?php if (isset($row['prod_quantity'])) { ?>
                                    <li>
                                        <span>Availability:</span>
                                        <p>
                                            <?php echo $row['prod_quantity'] ?> In Stock
                                        <p>
                                    </li>
                                <?php } else {
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $prods = $shop->viewRelated('shop_products', 'prod_name', 'prod_id', $row['prod_name'], $row['prod_id'], 0, 4);
            if (empty($prods)) {
            } else {
            ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="related__title">
                            <h5>RELATED PRODUCTS</h5>
                        </div>
                    </div>
                    <?php
                    //displaying the data ---------------------------------------------------------------------------------------->         
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
                                        <li><a href="prod-details.php?prod_id=<?php echo $prod['prod_id'] ?>"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="prod-details.php?prod_id=<?php echo $prod['prod_id'] ?>"><?php echo $prod['prod_name'] ?></a></h6>
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
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- Product Details Section End -->

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