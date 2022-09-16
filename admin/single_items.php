<?php
include "../includes/session.php";
include_once "../classes/manageusercontr.class.php";
include_once "../classes/profilecontr.class.php";
include_once "../classes/shopscontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;
$user = new ManageUserContr();
if (isset($_GET['del'])) {
    $result = $shop->deleteRandomProducts($_GET['del']);
    if ($result) {
        $msg = "Item deleted";
    } else {
        $msg2 = "Item can't be deleted";
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
    <link rel="icon" href="../img/black.png">
    <title>Single Items</title>
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
</head>

<body class="vertical  light  ">
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
                    <li class="nav-item w-100">
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
                    <li class="nav-item active w-100">
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
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="mb-2 page-title">Single items</h2>
                        <p class="card-text">This table shows all uploade single items. </p>
                        <div class="row my-4">
                            <!-- Small table -->
                            <div class="col-md-12">
                                <div class="card shadow">
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
                                        <!-- table -->
                                        <table class="table datatables" id="dataTable-1">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Owner</th>
                                                    <th>Location</th>
                                                    <th>Price</th>
                                                    <th>Phone</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $row = $shop->viewRandomProductsAdmin();
                                                $index = 1;
                                                foreach ($row as $rw) {
                                                    $price = number_format($rw['item_price']);
                                                    $img = $shop->viewItemImage($rw['item_id']);
                                                    $dist = $profile->viewDistrict($rw['district_id']);
                                                    $use = $user->viewsUser($rw['user_id']);
                                                    $date = strtotime($rw['item_date']);
                                                    $reg_date = date("M d, Y", $date);
                                                ?>
                                                    <tr>
                                                        <td><?php echo $index; ?></td>
                                                        <td class="font-weight-bold"><?php echo $rw['item_name']; ?></td>
                                                        <td class="font-weight-bold"><?php echo $use['first_name'] . " " . $use['last_name']  ?></td>
                                                        <td><span class="badge badge-primary"><?php echo $dist['name'] . ", " . $rw['item_area'] ?></span></td>
                                                        <?php if ($rw['item_negotiable'] == 0) { ?>
                                                            <td><span class="badge badge-warning"><?php echo $price ?> MWK</span></td>
                                                        <?php } elseif ($rw['item_negotiable'] == 1) { ?>
                                                            <td>
                                                                <p class="badge badge-info">negotiable</p>
                                                            </td>
                                                        <?php } elseif ($rw['item_negotiable'] == 2) { ?>
                                                            <td>
                                                                <h6><span class="badge badge-warning"><?php echo $price ?> MWK</span></h6>
                                                                <p class="badge badge-info">negotiable</p>
                                                            </td>
                                                        <?php } ?>
                                                        <td><?php echo $use['phone'] ?></td>
                                                        <td><?php echo $reg_date ?></td>
                                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item text-danger" href="single_items.php?del=<?php echo $rw['item_id']; ?>" onclick="return confirm('are you sure you want to delete?')"><span class="fas fa-trash-alt mr-2"></span> Remove...</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $index++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- simple table -->
                        </div> <!-- end section -->
                    </div> <!-- .col-12 -->
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
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
        </main> <!-- main -->
    </div> <!-- .wrapper -->
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