<?php
include "../includes/session.php";
include_once "../classes/profilecontr.class.php";
include_once "../classes/shopscontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;

if (isset($_POST['upload'])) {
    //********************** */ Validating the data and sanitising it ******************************
    function TestInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //********************** */ Compressing images **************************************************
    function compressedImage($source, $path, $quality)
    {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);
        imagejpeg($image, $path, $quality);
    }

    $name = TestInput($_POST['name']);
    $district = TestInput($_POST['district']);
    $area = TestInput($_POST['area']);
    $quantity = (!empty($_POST['quantity']) ? TestInput($_POST['quantity']) : null);
    $price = (!empty($_POST['price']) ? TestInput($_POST['price']) : null);
    $nego = TestInput($_POST['nego']);
    $description = TestInput($_POST['description']);

    $st = $shop->uploadRandomItem($user_id, $district, $name, $area, $quantity, $nego, $price, $description);
    if ($st) {
        $imageday = time();
        foreach ($_FILES['images']['name'] as $key => $val) {

            $filename = $_FILES['images']['name'][$key];
            // Valid extension 
            $valid_ext = array('png', 'jpeg', 'jpg');
            $photoExt1 = @end(explode('.', $filename));

            //GET FILENAME WITHOUT EXTENSION
            $name_no_ext = pathinfo($filename, PATHINFO_FILENAME);
            // explode the image name to get the extension 	 
            $phototest1 = strtolower($photoExt1);
            $new_profle_pic = $name_no_ext . $imageday . '.' . $phototest1;
            // Location 
            $location = "../assets/images/products/" . $new_profle_pic;
            // file extension 
            $file_extension = pathinfo($location, PATHINFO_EXTENSION);
            $file_extension = strtolower($file_extension);

            // Check extension 
            if (in_array($file_extension, $valid_ext)) {
                // Compress Image 
                compressedImage($_FILES['images']['tmp_name'][$key], $location, 60);
                //Here i am enter the insert code in the step ........ 
            }
        }
        $item_id = $st['item_id'];
        foreach ($_FILES['images']['name'] as $key => $val) {
            $filename = $_FILES['images']['name'][$key];
            // Valid extension 
            $photoExt1 = @end(explode('.', $filename));

            //GET FILENAME WITHOUT EXTENSION
            $name_no_ext = pathinfo($filename, PATHINFO_FILENAME);
            // explode the image name to get the extension 	 
            $phototest1 = strtolower($photoExt1);
            $new_image_name = $name_no_ext . $imageday . '.' . $phototest1;

            $final = $shop->uploadItemImages($item_id, $new_image_name);
        }
        if ($final) {
            $msg = "Product added!";
        } else {
            $msg2 = "Couldn't add product, sorry!";
        }
    } else {
        $msg2 = "Couldn't add product, sorry!";
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
    <title>Upload Single Item</title>
    <link rel="stylesheet" href="../admin/css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../admin/css/feather.css">
    <link rel="stylesheet" href="../admin/css/select2.css">
    <link rel="stylesheet" href="../admin/css/dropzone.css">
    <link rel="stylesheet" href="../admin/css/uppy.min.css">
    <link rel="stylesheet" href="../admin/css/jquery.steps.css">
    <link rel="stylesheet" href="../admin/css/jquery.timepicker.css">
    <link rel="stylesheet" href="../admin/css/quill.snow.css">
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
                            <li class="nav-item active">
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
                            <div class="card-header">
                                <strong class="card-title">Upload product or Service</strong>
                            </div>
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
                                <form class="needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom3">Item | service name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control required" id="validationCustom3" placeholder="computers" required>
                                            <div class="valid-feedback"> Looks good! </div>
                                            <div class="invalid-feedback"> Item name required </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
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
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom33">Area <span class="text-danger">*</span></label>
                                            <input type="text" name="area" class="form-control required" id="validationCustom33" required>
                                            <div class="valid-feedback"> Looks good! </div>
                                            <div class="invalid-feedback"> Please provide a valid area </div>
                                        </div>
                                    </div> <!-- /.form-row -->
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="quantity">Quantity <span class="text-muted">(Optional)</span></label>
                                            <div class="input-group">
                                                <input type="number" name="quantity" class="form-control" id="quantity">
                                                <div class="input-group-append">
                                                    <div class="input-group-text" id="button-addon-date">Products</div>
                                                </div>
                                                <div class="valid-feedback"> Looks good! </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationSelect2">Is price negotiable? <span class="text-danger">*</span></label>
                                            <select class="form-control required select2" name="nego" id="selection" onchange="disablePrice(this)" required>
                                                <option value="">Please select</option>
                                                <optgroup label="Yes or No">
                                                    <option value="0">No</option>
                                                    <option value="1">Yes, no starting price</option>
                                                    <option value="2">Yes, set starting price</option>
                                                </optgroup>
                                            </select>
                                            <div class="valid-feedback"> Looks good! </div>
                                            <div class="invalid-feedback"> Please Select! </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="price">Price per product <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" name="price" class="form-control required" id="price" required>
                                                <div class="input-group-append">
                                                    <div class="input-group-text" id="button-addon-date">MWK</div>
                                                </div>
                                                <div class="valid-feedback"> Looks good! </div>
                                                <div class="invalid-feedback"> Please enter a price </div>
                                            </div>
                                        </div>
                                    </div> <!-- /.form-row -->
                                    <div class="form-row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="validationTextarea1">Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control required" name="description" id="validationTextarea1" placeholder="Describe your product i.e. size, properties etc. what makes your product stand out?" required="" rows="4"></textarea>
                                            <div class="valid-feedback"> Looks good! </div>
                                            <div class="invalid-feedback"> Please describe your product. </div>
                                        </div>
                                        <!-- .col -->
                                        <div class="col-md-6 form-group mb-3">
                                            <label for="customFile">Upload Images <span class="text-danger">*</span></label>
                                            <div class="alert alert-primary" role="alert">
                                                <span class="fe fe-alert-circle fe-16 mr-2"></span> Upload images <span class="text-danger">(one or more)</span>! (jpg, jpeg and png only)
                                            </div>
                                            <input type="file" name="images[]" accept="image/*" class="form-control" id="customFile" multiple required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" name="upload" type="submit">upload Product</button>

                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col -->
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
    <script src="../admin/js/jquery.min.js"></script>
    <script src="../admin/js/popper.min.js"></script>
    <script src="../admin/js/moment.min.js"></script>
    <script src="../admin/js/bootstrap.min.js"></script>
    <script src="../admin/js/simplebar.min.js"></script>
    <script src='../admin/js/daterangepicker.js'></script>
    <script src='../admin/js/jquery.stickOnScroll.js'></script>
    <script src="../admin/js/tinycolor-min.js"></script>
    <script src="../admin/js/config.js"></script>
    <script src="../admin/js/d3.min.js"></script>
    <script src="../admin/js/topojson.min.js"></script>
    <script src="../admin/js/datamaps.all.min.js"></script>
    <script src="../admin/js/datamaps-zoomto.js"></script>
    <script src="../admin/js/datamaps.custom.js"></script>
    <script src="../admin/js/Chart.min.js"></script>
    <script>
        /* defind global options */
        Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
        Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="../admin/js/gauge.min.js"></script>
    <script src="../admin/js/jquery.sparkline.min.js"></script>
    <script src="../admin/js/apexcharts.min.js"></script>
    <script src="../admin/js/apexcharts.custom.js"></script>
    <script src='../admin/js/jquery.mask.min.js'></script>
    <script src='../admin/js/select2.min.js'></script>
    <script src='../admin/js/jquery.steps.min.js'></script>
    <script src='../admin/js/jquery.validate.min.js'></script>
    <script src='../admin/js/jquery.timepicker.js'></script>
    <script src='../admin/js/dropzone.min.js'></script>
    <script src='../admin/js/uppy.min.js'></script>
    <script src='../admin/js/quill.min.js'></script>
    <script>
        $('.select2').select2({
            theme: 'bootstrap4',
        });
        $('.select2-multi').select2({
            multiple: true,
            theme: 'bootstrap4',
        });
        $('.drgpicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            showDropdowns: true,
            locale: {
                format: 'MM/DD/YYYY'
            }
        });
        $('.time-input').timepicker({
            'scrollDefault': 'now',
            'zindex': '9999' /* fix modal open */
        });
        /** date range picker */
        if ($('.datetimes').length) {
            $('.datetimes').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });
        }
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);
        cb(start, end);
        $('.input-placeholder').mask("00/00/0000", {
            placeholder: "__/__/____"
        });
        $('.input-zip').mask('00000-000', {
            placeholder: "____-___"
        });
        $('.input-money').mask("#.##0,00", {
            reverse: true
        });
        $('.input-phoneus').mask('(000) 000-0000');
        $('.input-mixed').mask('AAA 000-S0S');
        $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
            translation: {
                'Z': {
                    pattern: /[0-9]/,
                    optional: true
                }
            },
            placeholder: "___.___.___.___"
        });
        // editor
        var editor = document.getElementById('editor');
        if (editor) {
            var toolbarOptions = [
                [{
                    'font': []
                }],
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{
                        'header': 1
                    },
                    {
                        'header': 2
                    }
                ],
                [{
                        'list': 'ordered'
                    },
                    {
                        'list': 'bullet'
                    }
                ],
                [{
                        'script': 'sub'
                    },
                    {
                        'script': 'super'
                    }
                ],
                [{
                        'indent': '-1'
                    },
                    {
                        'indent': '+1'
                    }
                ], // outdent/indent
                [{
                    'direction': 'rtl'
                }], // text direction
                [{
                        'color': []
                    },
                    {
                        'background': []
                    }
                ], // dropdown with defaults from theme
                [{
                    'align': []
                }],
                ['clean'] // remove formatting button
            ];
            var quill = new Quill(editor, {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });
        }
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <script>
        var uptarg = document.getElementById('drag-drop-area');
        if (uptarg) {
            var uppy = Uppy.Core().use(Uppy.Dashboard, {
                inline: true,
                target: uptarg,
                proudlyDisplayPoweredByUppy: false,
                theme: 'dark',
                width: 770,
                height: 210,
                plugins: ['Webcam']
            }).use(Uppy.Tus, {
                endpoint: 'https://master.tus.io/files/'
            });
            uppy.on('complete', (result) => {
                console.log('Upload complete! We’ve uploaded these files:', result.successful)
            });
        }
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
</body>

</html>