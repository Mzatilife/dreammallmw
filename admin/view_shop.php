<?php
include "../includes/session.php";
include_once "../classes/manageusercontr.class.php";
include_once "../classes/shopscontr.class.php";
include_once "../classes/profilecontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;
$user = new ManageUserContr();

$view = $_SESSION['view_shop'];

$row = $shop->viewShopUsingShopID($view);
$dist = $profile->viewDistrict($row['district_id']);
$us = $user->viewsUser($row['user_id']);
$type = $shop->viewCategoryWithId($row['cat_id']);

if (isset($_GET['approve'])) {
    $upload = $_GET['approve'];
    $result = $shop->changeStatusOrVerification('status', $upload, 1);

    if ($result) {
        if (!empty($row['email'])) {
            include "./approve_email.php";
        }
        $msg = "Shop approved!";
    } else {
        $msg2 = "Operation Failed!";
    }
} elseif (isset($_POST['reject'])) {
    $reject_id = $_GET['rejid'];

    $result = $shop->changeStatusOrVerification('status', $reject_id, 2);

    if ($result) {
        if (!empty($row['email'])) {
            include "./decline_email.php";
        }
        $msg = "Shop declined!";
    } else {
        $msg2 = "Operation failed!";
    }
} elseif (isset($_GET['verify'])) {
    $result = $shop->changeStatusOrVerification('verified', $_GET['verify'], 1);

    if ($result) {
        $msg = "Shop verified";
    } else {
        $msg2 = "Operation failed";
    }
} elseif (isset($_GET['unverify'])) {
    $result = $shop->changeStatusOrVerification('verified', $_GET['unverify'], 0);

    if ($result) {
        $msg = "Shop Unverified";
    } else {
        $msg2 = "Operation failed";
    }
}

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $result = $blog->deleteComment($id);

    if ($result) {
        $msg = "comment deleted!";
    } else {
        $msg2 = "couldn't delete comment!";
    }
}

if ($row['status'] == 0) {
    $status = "Pending";
    $badge = "info";
} elseif ($row['status'] == 1) {
    $status = "approved";
    $badge = "success";
} elseif ($row['status'] == 2) {
    $status = "declined";
    $badge = "danger";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Mahala M. Mkwepu" />
    <link rel="icon" href="../img/black.png">
    <title>View Blog</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
    <style>
        .widget .panel-body {
            padding: 0px;
        }

        .widget .list-group {
            margin-bottom: 0;
        }

        .widget .panel-title {
            display: inline
        }

        .widget .label-info {
            float: right;
        }

        .widget li.list-group-item {
            border-radius: 0;
            border: 0;
            border-top: 1px solid #ddd;
        }

        .widget li.list-group-item:hover {
            background-color: rgba(86, 61, 124, .1);
        }

        .widget .mic-info {
            color: #666666;
            font-size: 11px;
        }

        .widget .action {
            margin-top: 5px;
        }

        .widget .comment-text {
            font-size: 12px;
        }

        .widget .btn-block {
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
        }
    </style>
</head>

<body class="vertical light">
    <div class="wrapper">
        <nav class="topnav navbar navbar-light">
            <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                <i class="fe fe-menu navbar-toggler-icon"></i>
            </button>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                        <i class="fe fe-sun fe-16"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="circle circle-sm bg-info">
                            <i class="fe fe-16 fe-user text-white mb-0"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="profile.php">Profile</a>
                        <button type="button" class="dropdown-item text-danger" data-toggle="modal" data-target=".modal-full">Logout</button>
                    </div>
                </li>
            </ul>
        </nav>
        <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
            <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                <i class="fe fe-x"><span class="sr-only"></span></i>
            </a>
            <nav class="vertnav navbar navbar-light">
                <!-- nav bar -->
                <div class="w-100 mb-4 d-flex">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.php">
                        <img src="../img/black.png" width="25px" height="20px" alt="logo">ream<sup>Mall</sup>
                    </a>
                </div>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item w-100">
                        <a class="nav-link" href="index.php">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Operations</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item w-100">
                        <a class="nav-link" href="users.php">
                            <i class="fe fe-users fe-16"></i>
                            <span class="ml-3 item-text">users</span>
                        </a>
                    </li>
                    <li class="nav-item active w-100">
                        <a class="nav-link" href="shops.php">
                            <i class="fe fe-shopping-bag fe-16"></i>
                            <span class="ml-3 item-text">Shops</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link" href="shop_categories.php">
                            <i class="fe fe-layers fe-16"></i>
                            <span class="ml-3 item-text">Shop Categories</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link" href="single_items.php">
                            <i class="fe fe-grid fe-16"></i>
                            <span class="ml-3 item-text">Single Items</span>
                        </a>
                    </li>
                </ul>
                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Blog Operations</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">
                    <li class="nav-item w-100">
                        <a class="nav-link" href="categories.php">
                            <i class="fe fe-layers fe-16"></i>
                            <span class="ml-3 item-text">Categories</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link" href="blogs.php">
                            <i class="fe fe-book-open fe-16"></i>
                            <span class="ml-3 item-text">Blogs</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
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
                        <div class="col-lg-12">
                            <div class="single-post">
                                <div class="blog_details row">
                                    <div class="col-md-4">
                                        <h4>
                                            <?php echo $row['shop_name']; ?> <span class="badge badge-primary"><?php echo $type['cat_name'] ?></span>
                                        </h4>
                                        <img class="mr-3 img-thumbnail img-responsive" style="max-height: 200px;" src="../assets/images/logos/<?php echo $row['logo']; ?>" alt="image">
                                        <div class="text-center">
                                            <span class="badge badge-<?php echo $badge ?> m-3"><?php echo $status ?></span>
                                            <?php if ($row['verified'] == 1) { ?>
                                                <span class="badge badge-warning m-3">Certified</span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Details</h6>
                                        <p class="mt-3"><i class="fe fe-globe fe-16"></i> <?php echo $dist['name'] . ", " . $row['area'] ?>
                                            <?php
                                            if (!empty($row['address'])) {
                                                echo ". P. O. Box " . $row['address'];
                                            }
                                            ?>
                                        </p>
                                        <p><span class="fe fe-phone"></span> <a href="tel:<?php echo $row['phone'] ?>"><?php echo $row['phone'] ?></a> ~ <a href="tel:<?php echo $row['phone_2'] ?>"><?php echo $row['phone_2'] ?></a></p>
                                        <?php if (!empty($row['email'])) { ?>
                                            <p><span class="fe fe-mail"></span> <a href="mailto:<?php echo $row['email'] ?>"><?php echo $row['email'] ?></a></p>
                                        <?php } ?>
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
                                        <div style="overflow: auto;" class="nice-scroll mt-3">
                                            <p><a href="<?php echo $row['website'] ?>"><?php echo $row['website'] ?></a></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header active">
                                                <h6>Opening Time</h6>
                                            </div>
                                            <div class="card-body">
                                                <p><?php echo date('H:i a', strtotime($row['opening_time'])) ?> - <?php echo date('H:i a', strtotime($row['closing_time'])) ?></p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header active">
                                                <h6>Opening Days</h6>
                                            </div>
                                            <div class="card-body">
                                                <p><?php echo $row['opening_days'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mt-3">
                                        <?php if ($row['status'] == 1) { ?>
                                            <button class="btn btn-sm btn-danger m-3" data-toggle="modal" data-target="#reason">Decline</button>
                                        <?php } elseif ($row['status'] == 2) { ?>
                                            <a href="view_shop.php?approve=<?php echo $row['shop_id'] ?>" class="btn btn-sm btn-success m-3 ">Approve</a>
                                        <?php } else { ?>
                                            <a href="view_shop.php?approve=<?php echo $row['shop_id'] ?>" class="btn btn-sm btn-success m-3 ">Approve</a>
                                            <button class="btn btn-sm btn-danger m-3" data-toggle="modal" data-target="#reason">Decline</button>
                                        <?php } ?>

                                        <?php if ($row['verified'] != 1) { ?>
                                            <a href="view_shop.php?verify=<?php echo $row['shop_id'] ?>" class="btn btn-sm btn-info m-3">Certify</a>
                                        <?php } else { ?>
                                            <a href="view_shop.php?unverify=<?php echo $row['shop_id'] ?>" class="btn btn-sm btn-danger m-3">Uncertify</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div> <!-- .container-fluid -->
    </main>
    <!-- main -->
    </div>

    <!-- Reasons Modal-->
    <div class="modal fade" id="reason" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Upload Reasons for declining</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?rejid=<?php echo $row['shop_id']; ?>" method="POST" class="needs-validation" novalidate>
                        <div class="col-sm-12">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea name="reason" class="form-control" id="reason" cols="30" rows="10" required></textarea>
                            <div class="invalid-feedback">
                                Please enter a valid reason.
                            </div>
                        </div>

                        <button class="w-100 btn btn-primary btn-md mt-3" type="submit" name="reject">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- .wrapper -->
    <div class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
        <button aria-label="" type="button" class="close px-2" data-dismiss="modal" aria-hidden="true">
            <span aria-hidden="true">×</span>
        </button>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h3> Are you sure you want to log out?</h3>
                    <button aria-label="" type="button" class="btn btn-primary btn-lg mb-2 my-2 my-sm-0" data-dismiss="modal">cancel</button>
                    <a href="logout.php" class="btn btn-danger btn-lg mb-2 my-2 my-sm-0" type="submit">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src='js/jquery.dataTables.min.js'></script>
    <script src='js/dataTables.bootstrap4.min.js'></script>
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>
    <script src="js/apps.js"></script>
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