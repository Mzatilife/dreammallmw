<?php
include "../includes/session.php";
include_once "../classes/profilecontr.class.php";
include_once "../classes/shopscontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;


if (isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    $result = $shop->deleteRandomProducts($id);

    if ($result) {
        $msg = "Product deleted!";
    } else {
        $msg2 = "couldn't delete product!";
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
    $district = TestInput($_POST['district']);
    $area = TestInput($_POST['area']);
    $quantity = (!empty($_POST['quantity']) ? TestInput($_POST['quantity']) : null);
    $price = (!empty($_POST['price']) ? TestInput($_POST['price']) : null);
    $nego = TestInput($_POST['nego']);
    $description = TestInput($_POST['description']);

    // passing login information
    $result = $shop->editRandomProduct($id, $district, $name, $area, $quantity, $nego, $price, $description);

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
    <title>Single Items</title>
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
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="shops.php"><span class="ml-1 item-text">Shop | Business</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="upload_item.php"><span class="ml-1 item-text">Single Items</span></a>
                            </li>
                        </ul>
                    </li>
                    </li>
                    <li class="nav-item w-100">
                        <a class="nav-link" href="shops.php">
                            <i class="fe fe-shopping-bag fe-16"></i>
                            <span class="ml-3 item-text">Shop | Business</span>
                        </a>
                    </li>
                    <li class="nav-item active w-100">
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
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-4 col-md-2 text-center">
                                        <a href="profile-posts.html" class="avatar avatar-md">
                                            <img src="../img/black.png" alt="..." class="avatar-img rounded-circle">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <strong class="mb-1">Upload Single Item</strong><span class="dot dot-lg bg-success ml-1"></span>
                                        <p class="small text-muted mb-1">This shows all single items that are being sold but not necessarily as a shop. For new item hit the upload new button.</p>
                                    </div>
                                    <div class="col-4 col-md-auto offset-4 offset-md-0 my-2">
                                        <a href="upload_item.php" class="btn btn-sm btn-secondary"><span class="fe fe-16 fe-upload"></span> upload new</a>
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
                                                    <th>Location</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $row = $shop->viewRandomProducts($user_id);
                                                $index = 1;
                                                foreach ($row as $rw) {
                                                    $price = number_format($rw['item_price']);
                                                    $img = $shop->viewItemImage($rw['item_id']);
                                                    $dist = $profile->viewDistrict($rw['district_id']);
                                                ?>
                                                    <tr>
                                                        <td><?php echo $index ?></td>
                                                        <td>
                                                            <img src="../assets/images/products/<?php echo $img['image_name'] ?>" alt="..." style="width: 70px; height:50px;" class="img-responsive rounded">
                                                        </td>
                                                        <td id="item_name<?php echo $rw['item_id'] ?>"><strong><?php echo $rw['item_name'] ?></strong></td>
                                                        <td><?php echo $dist['name'] ?>, <span id="item_area<?php echo $rw['item_id'] ?>"><?php echo $rw['item_area'] ?></span></td>
                                                        <td>
                                                            <?php if (empty($rw['item_quantity'])) { ?>
                                                                <p class="badge badge-info">not set</p>
                                                            <?php } else { ?>
                                                                <h4 id="item_quantity<?php echo $rw['item_id'] ?>"><span class="badge badge-primary"><?php echo $rw['item_quantity'] ?></span></h4>
                                                            <?php } ?>
                                                        </td>
                                                        <?php if ($rw['item_negotiable'] == 0) { ?>
                                                            <td id="item_price<?php echo $rw['item_id'] ?>"><?php echo $price ?> MWK</td>
                                                        <?php } elseif ($rw['item_negotiable'] == 1) { ?>
                                                            <td>
                                                                <p class="badge badge-info">negotiable</p>
                                                            </td>
                                                        <?php } elseif ($rw['item_negotiable'] == 2) { ?>
                                                            <td>
                                                                <h6 id="item_price<?php echo $rw['item_id'] ?>"><span class="badge badge-primary"><?php echo $price ?> MWK</span></h6>
                                                                <p class="badge badge-info">negotiable</p>
                                                            </td>
                                                        <?php } ?>
                                                        <td>
                                                            <div id="item_description<?php echo $rw['item_id'] ?>" style="height: 60px; overflow:auto;" class="bg-info text-white rounded"><?php echo $rw['item_description'] ?></div>
                                                        </td>
                                                        <td><button class="btn btn-sm dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="text-muted sr-only">Action</span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <button class="dropdown-item edit" value="<?php echo $rw['item_id'] ?>">Edit</button>
                                                                <a class="dropdown-item text-danger" href="single_items.php?del_id=<?php echo $rw['item_id'] ?>">Remove</a>
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
                    <h5 class="modal-title" id="varyModalLabel">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="recipient-name" class="col-form-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationSelect2">District <span class="text-danger">*</span></label>
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
                                <div class="valid-feedback"> Looks good! </div>
                                <div class="invalid-feedback"> Please enter valid district </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="area">Area <span class="text-danger">*</span></label>
                                <input type="text" name="area" class="form-control required" id="area" required>
                                <div class="valid-feedback"> Looks good! </div>
                                <div class="invalid-feedback"> Please provide a valid area </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="quantity">Quantity <span class="text-muted">(optional)</span></label>
                                <div class="input-group">
                                    <input type="number" name="quantity" class="form-control" id="quantity">
                                    <div class="input-group-append">
                                        <div class="input-group-text" id="button-addon-date">Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
                var name = $('#item_name' + id).text();
                var quantity = $('#item_quantity' + id).text();
                var area = $('#item_area' + id).text();
                var description = $('#item_description' + id).text();
                var price = $('#item_price' + id).text();
                price = parseFloat(price.replace(/,/g, ''));
                price = parseInt(price);

                $('#edit').modal('show');
                $('#name').val(name);
                $('#quantity').val(quantity);
                $('#area').val(area);
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