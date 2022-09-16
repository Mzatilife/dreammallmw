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

if (isset($_POST['search'])) {
    $_SESSION['search_district'] = $_POST['district'];
    $_SESSION['search_name'] = $_POST['name'];
    header("location:search-item.php");
}

if (isset($_SESSION['search_district'], $_SESSION['search_name'])) {
    $district = $_SESSION['search_district'];
    $name = $_SESSION['search_name'];
} else {
    header("location:products.php");
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
    <title>Search results</title>

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
                            <li><a href="./shops.php">Shops</a></li>
                            <li class="active"><a href="./products.php">Products</a></li>
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
                        <span>Search Results</span>
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
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <?php
                        //displaying the data ---------------------------------------------------------------------------------------->
                        @$page = $_GET["page"];

                        if ($page == "" || $page == "1") {

                            $page1 = 0;
                        } else {

                            $page1 = ($page * 12) - 12;
                        }
                        $prods = $shop->searchRandomItem($district, $name, $page1, 12);
                        if (!empty($prods)) {
                            foreach ($prods as $prod) {
                                $price = number_format($prod['item_price']);
                                $img = $shop->viewItemImage($prod['item_id']);
                                $dist = $profile->viewDistrict($prod['district_id']);
                        ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="assets/images/products/<?php echo $img['image_name'] ?>">
                                            <!-- <div class="label new">New</div> -->
                                            <ul class="product__hover">
                                                <li><a href="assets/images/products/<?php echo $img['image_name'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                                <li><a href="products.php?itemId=<?php echo $prod['item_id'] ?>&views=<?php echo $prod['views']; ?>"><span class="icon_bag_alt"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <h6><a href="products.php?itemId=<?php echo $prod['item_id'] ?>&views=<?php echo $prod['views']; ?>"><?php echo $prod['item_name'] ?></a></h6>
                                            <div class="rating">
                                                <i><?php echo $dist['name'] . ", " . $prod['item_area'] ?></i>
                                            </div>
                                            <div class="product__price"><?php echo $price ?> MWK</div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } else {  ?>
                            <div class="container">
                                <div class="discount__text">
                                    <div class="discount__text__title">
                                        <h5>Oops!</h5>
                                        <h3>couldn't find what you are looking for!</h3>
                                        <?php
                                        $dist = $profile->viewDistrict($district);
                                        ?>
                                        <p class="mt-3">Nothing found by the name "<?php echo $name ?>" in <?php echo $dist['name'] ?></p>
                                        <img src="./img/oops.png" width="200px" alt="" srcset="">
                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        $cout = $shop->countSearchRandomItem($district, $name);

                        $a = $cout / 12;

                        $a = ceil($a);
                        ?>
                        <div class="col-lg-12 text-center">
                            <div class="pagination__option">
                                <?php for ($b = 1; $b <= $a; $b++) {  ?>
                                    <a href="search-item.php?page=<?php echo $b; ?>"><?php echo $b . " "; ?></a>
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="col-lg-12 col-md-12 col-sm-12 align-items-center justify-content-center row">
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
                    <label for="validationCustom33">Item/shop Name</label>
                    <input type="text" class="form-control required" name="name" placeholder="i.e. shoes" id="validationCustom33" required>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" name="search" type="submit"><span class="fa fa-search"></span> Search</button>
                </div>
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