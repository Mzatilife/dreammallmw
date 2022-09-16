<?php
session_start();
include_once "classes/profilecontr.class.php";
include_once "classes/shopscontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;
if (isset($_GET['itemId'])) {
    $_SESSION['item_id'] = $_GET['itemId'];
    $views = $_GET['views'] + 1;
    $shop->changeViews('random_items', 'item_id', $_GET['itemId'], $views);
    header("location:product-details.php");
}
if (isset($_GET['shop_id'])) {
    $_SESSION['shop_id'] = $_GET['shop_id'];
    $views = $_GET['views'] + 1;
    $shop->changeViews('shops', 'shop_id', $_GET['shop_id'], $views);
    header("location:shop-details.php");
}
if (isset($_POST['search'])) {
    $_SESSION['search_district'] = $_POST['district'];
    $_SESSION['search_name'] = $_POST['name'];
    $type = $_POST['type'];

    if ($type == 'shop') {
        $_SESSION['search_cat'] = $_POST['cat'];
        header("location:search-shop.php");
    } elseif ($type == 'item') {
        header("location:search-item.php");
    }
}
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
    <title>Dream Mall</title>

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
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="./shops.php">Shops</a></li>
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

    <!-- Shop Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row property__gallery">
                <?php
                $row = $shop->viewRandomShopWithLimit(1, 0, 12);
                foreach ($row as $rw) {
                    $count = $shop->countShopProducts($rw['shop_id']);
                    $dist = $profile->viewDistrict($rw['district_id']);
                    $type = $shop->viewCategoryWithId($rw['cat_id']);
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="assets/images/logos/<?php echo $rw['logo'] ?>">
                                <?php if ($rw['verified'] == 1) { ?>
                                    <div class="label new">certified</div>
                                <?php } ?>
                                <ul class="product__hover">
                                    <li>
                                        <a href="assets/images/logos/<?php echo $rw['logo'] ?>" class="image-popup"><span class="arrow_expand"></span></a>
                                    </li>
                                    <li>
                                        <a href="shops.php?shop_id=<?php echo $rw['shop_id'] ?>&views=<?php echo $rw['views']; ?>"><span class="icon_bag_alt"></span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="shops.php?shop_id=<?php echo $rw['shop_id'] ?>&views=<?php echo $rw['views']; ?>"><?php echo $rw['shop_name'] ?></a></h6>
                                <div class="rating">
                                    <i><?php echo $type['cat_name'] ?></i>
                                </div>
                                <p><?php echo $dist['name'] . ", " . $rw['area'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-12 text-center">
                    <a href="./shops.php" class="btn btn-sm btn-primary col-md-4">more...</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Shops Section End -->

    <!-- Product Section Begin -->
    <?php
    $prods = $shop->viewRandomProductsWithLimit(0, 8);
    if (!empty($prods)) {
    ?>
        <section class="product spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="section-title">
                            <h4>New products</h4>
                        </div>
                    </div>
                </div>
                <div class="row property__gallery">
                    <?php
                    foreach ($prods as $prod) {
                        $price = number_format($prod['item_price']);
                        $img = $shop->viewItemImage($prod['item_id']);
                        $dist = $profile->viewDistrict($prod['district_id']);
                    ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="assets/images/products/<?php echo $img['image_name'] ?>">
                                    <?php if ($prod['item_negotiable'] == 2) { ?>
                                        <div class="label new">Negotiable</div>
                                    <?php } ?>
                                    <ul class="product__hover">
                                        <li><a href="assets/images/products/<?php echo $img['image_name'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                        <li><a href="index.php?itemId=<?php echo $prod['item_id'] ?>&views=<?php echo $prod['views']; ?>"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="index.php?itemId=<?php echo $prod['item_id'] ?>&views=<?php echo $prod['views']; ?>"><?php echo $prod['item_name'] ?></a></h6>
                                    <div class="rating">
                                        <i><?php echo $dist['name'] . ", " . $prod['item_area'] ?></i>
                                    </div>
                                    <?php if ($prod['item_negotiable'] == 0 || $prod['item_negotiable'] == 2) { ?>
                                        <div class="product__price"><?php echo $price ?> MWK</div>
                                    <?php } elseif ($prod['item_negotiable'] == 1) { ?>
                                        <p class="badge badge-info">Price's negotiable</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- Product Section End -->

    <!-- Shop Categories begin -->
    <section>
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>Shop Categories</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <p class="text-justify">
                    <?php
                    $cats = $shop->viewCategories();
                    foreach ($cats as $cat) {
                    ?>
                        <a href="shops.php?cat_id=<?php echo $cat['cat_id'] ?>" class="btn btn-sm btn-primary m-1"><?php echo $cat['cat_name'] ?></a>
                    <?php } ?>
                </p>
            </div>
            <hr>
        </div>
    </section>
    <!-- Shop Categories End -->

    <!-- Banner Section Begin -->
    <section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Dreamcode Malawi</span>
                                <h2>Have a personal portifolio or website!</h2>
                                <a href="https://dreamcodemw.com">visit website</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Dream<sup>Mall</sup></span>
                                <h2>Register to advertise your business</h2>
                                <a href="register.php">register now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>Dream<sup>Mall</sup></span>
                                <h2>Login to your account</h2>
                                <a href="login.php">sign in</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Trend Section Begin -->
    <section class="trend spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Trending Shops</h4>
                        </div>
                        <?php
                        $three = $shop->viewShopWithViewsDesc(1, 0, 3);
                        foreach ($three as $key) {
                            $count = $shop->countShopProducts($key['shop_id']);
                            $type = $shop->viewCategoryWithId($key['cat_id']);
                        ?>
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="assets/images/logos/<?php echo $key['logo'] ?>" width="90px" height="90px" alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6><?php echo $key['shop_name'] ?></h6>
                                    <div class="rating">
                                        <i><?php echo $type['cat_name'] ?></i>
                                    </div>
                                    <a href="index.php?shop_id=<?php echo $key['shop_id'] ?>&views=<?php echo $key['views']; ?>" class="btn btn-sm btn-danger">view</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Trending Products</h4>
                        </div>
                        <?php
                        $three = $shop->viewItemsWithViewsDesc(0, 3);
                        foreach ($three as $prod) {
                            $price = number_format($prod['item_price']);
                            $img = $shop->viewItemImage($prod['item_id']);
                        ?>
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    <img src="assets/images/products/<?php echo $img['image_name'] ?>" width="90px" height="90px" alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6><?php echo $prod['item_name'] ?></h6>
                                    <div class="rating">
                                        <?php if ($prod['item_negotiable'] == 0) { ?>
                                            <i><?php echo $price ?> MWK</i>
                                        <?php } elseif ($prod['item_negotiable'] == 1) { ?>
                                            <i>Price's negotiable</i>
                                        <?php } elseif ($prod['item_negotiable'] == 2) { ?>
                                            <i><?php echo $price ?> MWK (negotiable)</i>
                                        <?php } ?>
                                    </div>
                                    <a href="index.php?itemId=<?php echo $prod['item_id'] ?>&views=<?php echo $prod['views']; ?>" class="btn btn-sm btn-danger">view</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>DreamcodeMW Services</h4>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="./img/software.jpg" width="90px" height="90px" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Software Development</h6>
                                <div>
                                    <p style="text-align: justify;">
                                        We develop user friendly web, stand alone
                                        and mobile apps.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="./img/hosting.jpg" width="90px" height="90px" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Hosting Services</h6>
                                <div>
                                    <p style="text-align: justify;">
                                        A cPanel where you can manage your database and storage.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="trend__item">
                            <div class="trend__item__pic">
                                <img src="./img/security.jpeg" width="90px" height="90px" alt="">
                            </div>
                            <div class="trend__item__text">
                                <h6>Computer Security</h6>
                                <div>
                                    <p style="text-align: justify;">
                                        Protection from data breaches, malware and cyber crime.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trend Section End -->

    <!-- Discount Section Begin -->
    <section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="discount__pic">
                        <img src="./img/dreamcode.jpeg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>We are</span>
                            <h3>DreamcodeMW</h3>
                            <h5><span>visit</span> us</h5>
                        </div>
                        <div class="discount__countdown">
                            <div class="countdown__item">
                                <span>7</span>
                                <p>clients</p>
                            </div>
                            <div class="countdown__item">
                                <span>12</span>
                                <p>websites</p>
                            </div>
                            <div class="countdown__item">
                                <span>4</span>
                                <p>services</p>
                            </div>
                            <div class="countdown__item">
                                <span>24</span>
                                <p>hrs</p>
                            </div>
                        </div>
                        <a href="https://dreamcodemw.com">Official Website</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-laptop"></i>
                        <h6>Software Development</h6>
                        <p>Web, mobile, stand alone.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-globe"></i>
                        <h6>Hosting Services</h6>
                        <p>We provide hosting space</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-lock"></i>
                        <h6>Computer Security</h6>
                        <p>Protect your business</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-server"></i>
                        <h6>Data Storage</h6>
                        <p>Stored on cloud servers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Footer Section Begin -->
    <?php include "./footer.php" ?>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="col-lg-12 col-md-12 col-sm-12 align-items-center justify-content-center row">
                <div class="col-md-3 mb-3">
                    <label for="validationSelect2">What you need?</label>
                    <select class="form-control required select2" name="type" onchange="disablePrice(this)" id="validationSelect2" required>
                        <option value="">Select</option>
                        <optgroup label="choose one">
                            <option value="shop">Shop</option>
                            <option value="item">Random Item</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-3 mb-3" id="ca">
                    <label for="cat">Shop Category</label>
                    <select class="form-control required select2" name="cat" id="cat" required>
                        <option value="">Select category</option>
                        <optgroup label="Business Category">
                            <?php
                            $categs = $shop->viewCategories();

                            foreach ($categs as $cat) {
                            ?>
                                <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_name'] ?></option>
                            <?php } ?>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationSelect2">District</label>
                    <select class="form-control required select2" name="district" id="validationSelect2" required>
                        <option value="">Select District</option>
                        <optgroup label="Malawi Districts">
                            <?php
                            $districts = $profile->viewDistricts();

                            foreach ($districts as $dist) {
                            ?>
                                <option value="<?php echo $dist['district_id'] ?>"><?php echo $dist['name'] ?></option>
                            <?php } ?>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="validationCustom33">Item | shop Name</label>
                    <input type="text" class="form-control required" name="name" placeholder="i.e. shoes" id="validationCustom33" required>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary col-12" name="search" type="submit"><span class="fa fa-search"></span> Search</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Search End -->
    <?php include "./donate.php"; ?>
    <!-- Js Plugins -->
    <script>
        function disablePrice(nego) {
            console.log(nego.value)
            if (nego.value == 'item') {
                document.getElementById('ca').hidden = true;
                document.getElementById('cat').disabled = true;
            } else {
                document.getElementById('ca').hidden = false;
                document.getElementById('cat').disabled = false;
            }
        }
    </script>
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