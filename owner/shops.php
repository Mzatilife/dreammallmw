<?php
include "../includes/session.php";
include_once "../classes/profilecontr.class.php";
include_once "../classes/shopscontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;

if (isset($_GET['shop_id'])) {
    $_SESSION['shop_id'] = $_GET['shop_id'];
    header("location:upload_shop.php");
}

if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $result = $shop->deleteShopProducts($id);

    if ($result) {
        $msg = "Product deleted!";
    } else {
        $msg2 = "couldn't delete Product!";
    }
}

if (isset($_POST['edit'])) {

    //********************** */ Validating the data and sanitising it ******************************
    function TestInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = $_POST['cid'];
    $name = TestInput($_POST['name']);
    $quantity = (!empty($_POST['quantity']) ? TestInput($_POST['quantity']) : null);
    $price = (!empty($_POST['price']) ? TestInput($_POST['price']) : null);
    $nego = TestInput($_POST['nego']);
    $description = TestInput($_POST['description']);

    // passing login information
    $result = $shop->editShopProduct($id, $name, $quantity, $nego, $price, $description);

    if ($result) {
        $msg = "Product edited!";
    } else {
        $msg2 = "Couldn't edit product, sorry!";
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
    <title>Shops</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="../admin/css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../admin/css/feather.css">
    <link rel="stylesheet" href="../admin/css/dataTables.bootstrap4.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="../admin/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="../admin/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="../admin/css/app-dark.css" id="darkTheme" disabled>
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
                    <li class="nav-item dropdown">
                        <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                            <i class="fe fe-upload fe-16"></i>
                            <span class="ml-3 item-text">Upload</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="tables">
                            <li class="nav-item active">
                                <a class="nav-link pl-3" href="shops.php"><span class="ml-1 item-text">Shop | Business</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="upload_item.php"><span class="ml-1 item-text">Single Items</span></a>
                            </li>
                        </ul>
                    </li>
                    </li>
                    <li class="nav-item w-100 active">
                        <a class="nav-link" href="shops.php">
                            <i class="fe fe-shopping-bag fe-16"></i>
                            <span class="ml-3 item-text">Shop | Business</span>
                        </a>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link" href="single_items.php">
                            <i class="fe fe-grid fe-16"></i>
                            <span class="ml-3 item-text">Single Items</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <?php
                    $check = $shop->checkShop($user_id);

                    if ($check > 0) {

                        $view = $shop->viewShop($user_id);
                        $type = $shop->viewCategoryWithId($view['cat_id']);
                    ?>
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-4 col-md-2 text-center">
                                            <img src="../assets/images/logos/<?php echo $view['logo'] ?>" alt="..." style="max-height: 75px;" class="w-100 rounded">
                                        </div>
                                        <div class="col">
                                            <strong class="mb-1 text-capitalize h4"><?php echo $view['shop_name'] ?></strong><span class="dot dot-lg bg-success ml-1"></span>
                                            <p class="small text-muted mb-1"><?php echo $type['cat_name'] ?></p>
                                            <?php if ($view['verified'] == 1) { ?>
                                                <span class="badge badge-warning"><span class="fe fe-16 fe-star">certified</span>
                                                <?php } ?>
                                        </div>
                                        <div class="col-md-4  col-md-auto offset-md-0 my-2">
                                            <?php if ($view['status'] == 1) { ?>
                                                <a href="shops.php?shop_id=<?php echo $view['shop_id'] ?>" class="btn btn-sm btn-secondary"><span class="fe fe-16 fe-upload"></span> Add product - service</a>
                                            <?php } elseif ($view['status'] == 0) { ?>
                                                <p class="alert alert-info"><span class="badge badge-info">Pending approval:</span> can't upload services or products!</p>
                                            <?php } elseif ($view['status'] == 2) { ?>
                                                <p class="alert alert-danger"><span class="badge badge-danger">Business declined:</span> can't upload services or products!</p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div> <!-- / .card-body -->
                            </div> <!-- / .card -->
                        </div>
                        <div class="col-12">
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
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $shop_id = $view['shop_id'];
                                                    $row = $shop->viewShopProducts($shop_id);
                                                    $index = 1;
                                                    foreach ($row as $rw) {
                                                        $price = number_format($rw['prod_price']);
                                                        $img = $shop->viewProductImage($rw['prod_id']);
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $index ?></td>
                                                            <td>
                                                                <img src="../assets/images/products/<?php echo $img['image_name'] ?>" alt="..." style="width: 70px; max-height:50px; " class="img-responsive rounded">
                                                            </td>
                                                            <td id="prod_name<?php echo $rw['prod_id'] ?>"><strong><?php echo $rw['prod_name'] ?></strong></td>
                                                            <td>
                                                                <?php if (empty($rw['prod_quantity'])) { ?>
                                                                    <p class="badge badge-info">not set</p>
                                                                <?php } else { ?>
                                                                    <h4 id="prod_quantity<?php echo $rw['prod_id'] ?>"><span class="badge badge-primary"><?php echo $rw['prod_quantity'] ?></span></h4>
                                                                <?php } ?>
                                                            </td>
                                                            <?php if ($rw['prod_negotiable'] == 0) { ?>
                                                                <td id="prod_price<?php echo $rw['prod_id'] ?>"><?php echo $price ?> MWK</td>
                                                            <?php } elseif ($rw['prod_negotiable'] == 1) { ?>
                                                                <td>
                                                                    <p class="badge badge-info">negotiable</p>
                                                                </td>
                                                            <?php } elseif ($rw['prod_negotiable'] == 2) { ?>
                                                                <td>
                                                                    <h6 id="prod_price<?php echo $rw['prod_id'] ?>"><span class="badge badge-primary"><?php echo $price ?> MWK</span></h6>
                                                                    <p class="badge badge-info">negotiable</p>
                                                                </td>
                                                            <?php } ?>
                                                            <td>
                                                                <div id="prod_description<?php echo $rw['prod_id'] ?>" style="height: 60px; overflow:auto;" class="bg-info text-white rounded"><?php echo $rw['prod_description'] ?></div>
                                                            </td>
                                                            <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <span class="text-muted sr-only">Action</span>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <button class="dropdown-item edit" value="<?php echo $rw['prod_id'] ?>">Edit</button>
                                                                    <a class="dropdown-item text-danger" href="shops.php?del_id=<?php echo $rw['prod_id'] ?>">Remove</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $index++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> <!-- simple table -->
                            </div> <!-- end section -->
                        </div> <!-- .col-12 -->
                    <?php } else { ?>
                        <div class="col-md-12 mb-4">
                            <div class="card profile shadow">
                                <div class="card-body my-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-3 text-center mb-5">
                                            <a href="#!" class="avatar avatar-xl">
                                                <img src="../img/black.png" alt="..." class="avatar-img rounded-circle">
                                            </a>
                                        </div>
                                        <div class="col">
                                            <div class="row align-items-center">
                                                <div class="col-md-7">
                                                    <h4 class="mb-1">Register your business or Shop</h4>
                                                    <p class="small mb-3"><span class="badge badge-dark">Dream<sup>Mall</sup> </span></p>
                                                </div>
                                                <div class="col">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-7">
                                                    <p class="text-muted">Dream<sup>Mall</sup>, is a web application that helps you register your business/shop and upload products that are in your shop.</p>
                                                    <p class="text-muted">"Imagine a place where all businesses come together and yours stands out."</p>
                                                </div>
                                                <div class="col">
                                                    <p class="small mb-0 text-muted">The web app is free lol</p>
                                                    <p class="small mb-0 text-muted">You can advertise your products</p>
                                                    <p class="small mb-0 text-muted">Helps you reach more customers</p>
                                                </div>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-md-7 mb-2">
                                                    <span class="small text-muted mb-0">Enjoy yourself, Amigo!</span>
                                                </div>
                                                <div class="col mb-2">
                                                    <a href="register_shop.php" class="btn btn-primary">Register</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- / .row- -->
                                </div> <!-- / .card-body - -->
                            </div> <!-- / .card- -->
                        </div> <!-- / .col- -->
                    <?php } ?>
                </div> <!-- .row -->
            </div> <!-- .container-fluid -->
        </main> <!-- main -->
    </div> <!-- .wrapper -->
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
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyModalLabel">Edit Product or service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="recipient-name" class="col-form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="quantity">Quantity <span class="text-muted">(optional)</span></label>
                                <div class="input-group">
                                    <input type="number" name="quantity" class="form-control required" id="quantity">
                                    <div class="input-group-append">
                                        <div class="input-group-text" id="button-addon-date">Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationSelect2">Is price negotiable? <span class="text-danger">*</span></label>
                                <select class="form-control required select2" name="nego" id="selection" onchange="disablePrice(this)" required>
                                    <option value="">Please select</option>
                                    <optgroup label="Yes or No">
                                        <option value="0">No</option>
                                        <option value="1">Yes, no starting price</option>
                                        <option value="2">Yes, set starting price</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="price">Price per product <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="price" class="form-control required" id="price" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text" id="button-addon-date">MWK</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Product Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Describe your product i.e. size, properties etc. what makes your product stand out?" required></textarea>
                        </div>
                        <input type="number" name="cid" id="eid" hidden>
                        <button type="submit" name="edit" class="btn mb-2 btn-info">Edit Product</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../admin/js/jquery.min.js"></script>
    <script src="../admin/js/popper.min.js"></script>
    <script src="../admin/js/moment.min.js"></script>
    <script src="../admin/js/bootstrap.min.js"></script>
    <script src="../admin/js/simplebar.min.js"></script>
    <script src='../admin/js/daterangepicker.js'></script>
    <script src='../admin/js/jquery.stickOnScroll.js'></script>
    <script src="../admin/js/tinycolor-min.js"></script>
    <script src="../admin/js/config.js"></script>
    <script src='../admin/js/jquery.dataTables.min.js'></script>
    <script src='../admin/js/dataTables.bootstrap4.min.js'></script>
    <script>
        $('#dataTable-1').DataTable({
            autoWidth: true,
            "lengthMenu": [
                [16, 32, 64, -1],
                [16, 32, 64, "All"]
            ]
        });
    </script>
    <script src="../admin/js/apps.js"></script>
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
    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit', function() {
                var id = $(this).val();
                var name = $('#prod_name' + id).text();
                var quantity = $('#prod_quantity' + id).text();
                var description = $('#prod_description' + id).text();
                var price = $('#prod_price' + id).text();
                price = parseFloat(price.replace(/,/g, ''));
                price = parseInt(price);

                $('#edit').modal('show');
                $('#name').val(name);
                $('#quantity').val(quantity);
                $('#price').val(price);
                $('#description').val(description);
                $('#eid').val(id);
            });
        });
    </script>
    <script>
        function disablePrice(nego) {
            console.log(nego.value)
            if (nego.value == 1) {
                document.getElementById('price').disabled = true;
            } else {
                document.getElementById('price').disabled = false;
            }
        }
    </script>
</body>

</html>