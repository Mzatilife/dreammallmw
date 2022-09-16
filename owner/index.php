<?php
include "../includes/session.php";
include_once "../classes/profilecontr.class.php";
include_once "../classes/shopscontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../img/black.png">
  <title>Dashboard</title>
  <!-- Simple bar CSS -->
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
          <li class="nav-item active w-100">
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
          <div class="col-12">
            <div class="row align-items-center mb-2">
              <div class="col">
                <h2 class="h5 page-title">Welcome!</h2>
              </div>
            </div>
            <?php
            $check = $shop->checkShop($user_id);
            $count = $shop->countRandomProducts($user_id);

            if ($check <= 0 && $count == 0) { ?>
              <div class="col-md-12 mb-4">
                <div class="card profile shadow">
                  <div class="card-body my-4">
                    <div class="row align-items-center">
                      <div class="col-md-3 text-center mb-5">
                        <img src="../img/cta.png" alt="..." class="w-100 rounded-circle">
                      </div>
                      <div class="col">
                        <div class="row align-items-center">
                          <div class="col-md-7">
                            <h4 class="mb-1">Register your business or Shop</h4>
                            <p class="small mb-3"><span class="badge badge-primary">Dream<sup>Mall</sup> </span></p>
                          </div>
                          <div class="col">
                          </div>
                        </div>
                        <div class="row mb-4">
                          <div class="col-md-7">
                            <p class="text-muted">Dream<sup>Mall</sup>, Register your business then <b>upload the services</b> that you provide!</p>
                            <p class="text-muted">After business registration please <b>don't forget</b> to upload <b>business sservices</b> or <b>shop products</b>.</p>
                            <a href="register_shop.php" class="btn btn-primary btn-sm">Register business</a>
                          </div>
                          <div class="col">
                            <p class="small mb-0 text-muted">You can also <b>upload random items</b> that are not in a shop.</p>
                            <p class="small mb-0 text-muted">You might be selling or renting a single item that isn't necessarily a shop</p>
                            <p class="small mb-0 text-muted">We help you reach more customers</p>
                            <a href="./upload_item.php" class="btn btn-primary btn-sm mt-3">Upload Item</a>
                          </div>
                        </div>
                      </div>
                    </div> <!-- / .row- -->
                  </div> <!-- / .card-body - -->
                </div> <!-- / .card- -->
              </div>
            <?php
            } else {
            ?>
              <!-- widgets -->
              <div class="row my-4">
                <div class="col-md-6 mb-4">
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <?php

                          if ($check > 0) {

                            $view = $shop->viewShop($user_id);
                            $type = $shop->viewCategoryWithId($view['cat_id']);
                            if ($view['status'] == 0) {
                              $status = "Pending approval";
                              $badge = "info";
                            } elseif ($view['status'] == 1) {
                              $status = "approved";
                              $badge = "success";
                            } elseif ($view['status'] == 2) {
                              $status = "declined";
                              $badge = "danger";
                            }
                          ?>
                            <span class="h2 mb-0"><?php echo $view['shop_name'] ?></span>
                            <p class="small text-muted mb-0"><?php echo $type['cat_name'] ?> <span class="badge badge-pill badge-<?php echo $badge ?>"><?php echo $status ?></span></p>
                            <a href="./shops.php" class="btn btn-sm btn-pill btn-primary">Add service ~ product</a>
                          <?php } else { ?>
                            <span class="h2 mb-0">0</span>
                            <p class="small text-muted mb-0">Shops</p>
                            <a href="./shops.php" class="btn btn-sm btn-pill btn-primary">Register Shop</a>
                          <?php } ?>
                        </div>
                        <div class="col-auto">
                          <span class="fe fe-32 fe-shopping-bag text-muted mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <span class="h2 mb-0"><?php echo $count; ?></span>
                          <p class="small text-muted mb-0">Single Items</p>
                          <a href="./upload_item.php" class="btn btn-sm btn-pill btn-primary">upload item</a>
                        </div>
                        <div class="col-auto">
                          <span class="fe fe-32 fe-grid text-muted mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- end section -->
              <div class="row">
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Shop Items</strong>
                      <a class="float-right small text-muted" href="shops.php">View all</a>
                    </div>
                    <div class="card-body">
                      <div class="list-group list-group-flush my-n3">
                        <?php
                        if (isset($view['shop_id'])) {
                          $shop_id = $view['shop_id'];
                          $row = $shop->viewShopProducts2($shop_id, 0, 4);
                          if (!empty($row)) {
                            foreach ($row as $rw) {
                              $price = number_format($rw['prod_price']);
                              $img = $shop->viewProductImage($rw['prod_id']);
                        ?>
                              <div class="list-group-item">
                                <div class="row align-items-center">
                                  <div class="col-3 col-md-2">
                                    <img src="../assets/images/products/<?php echo $img['image_name'] ?>" alt="..." class="thumbnail-sm">
                                  </div>
                                  <div class="col-6">
                                    <strong><?php echo $rw['prod_name'] ?></strong>
                                    <div class="my-0 text-muted small">Available: <?php echo $rw['prod_quantity'] ?></div>
                                  </div>
                                  <div class="col-mb-4">
                                    <?php if ($rw['prod_negotiable'] == 0) { ?>
                                      <strong><?php echo $price ?> MWK</strong>
                                    <?php } elseif ($rw['prod_negotiable'] == 1) { ?>
                                      <p class="badge badge-info">negotiable</p>
                                    <?php } elseif ($rw['prod_negotiable'] == 2) { ?>
                                      <span class="badge badge-primary"><?php echo $price ?> MWK</span>
                                      <span class="badge badge-info">negotiable</span>
                                    <?php } ?>
                                  </div>
                                </div>
                              </div>
                            <?php }
                          } else {  ?>
                            <div class="container text-center">
                              <img src="../img/empty.svg" width="120px" class="m-3" alt="" srcset="">
                            </div>
                        <?php }
                        } ?>
                      </div> <!-- / .list-group -->
                    </div> <!-- / .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Random Items</strong>
                      <a class="float-right small text-muted" href="single_items.php">View all</a>
                    </div>
                    <div class="card-body">
                      <div class="list-group list-group-flush my-n3">
                        <?php
                        $row = $shop->viewRandomProducts2($user_id, 0, 4);
                        if (!empty($row)) {
                          foreach ($row as $rw) {
                            $price = number_format($rw['item_price']);
                            $img = $shop->viewItemImage($rw['item_id']);
                            $dist = $profile->viewDistrict($rw['district_id']);
                        ?>
                            <div class="list-group-item">
                              <div class="row align-items-center">
                                <div class="col-3 col-md-2">
                                  <img src="../assets/images/products/<?php echo $img['image_name'] ?>" alt="..." class="thumbnail-sm">
                                </div>
                                <div class="col-6">
                                  <strong><?php echo $rw['item_name'] ?></strong>
                                  <div class="my-0 text-muted small"><?php echo $dist['name'] . ", " . $rw['item_area'] ?></div>
                                </div>
                                <div class="col-mb-4">
                                  <?php if ($rw['item_negotiable'] == 0) { ?>
                                    <strong><?php echo $price ?> MWK</strong>
                                  <?php } elseif ($rw['item_negotiable'] == 1) { ?>
                                    <p class="badge badge-info">negotiable</p>
                                  <?php } elseif ($rw['item_negotiable'] == 2) { ?>
                                    <span class="badge badge-primary"><?php echo $price ?> MWK</span>
                                    <span class="badge badge-info">negotiable</span>
                                  <?php } ?>
                                </div>
                              </div>
                            </div>
                          <?php }
                        } else {  ?>
                          <div class="container text-center">
                            <img src="../img/empty.svg" width="120px" class="m-3" alt="" srcset="">
                          </div>
                        <?php } ?>
                      </div> <!-- / .list-group -->
                    </div> <!-- / .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
              </div> <!-- .row -->
            <?php } ?>
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