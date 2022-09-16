<?php
include "../includes/session.php";
include_once "../classes/manageusercontr.class.php";
include_once "../classes/profilecontr.class.php";
include_once "../classes/shopscontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;
$user = new ManageUserContr();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mahala M. mkwepu">
  <link rel="icon" href="../img/black.png">
  <title>Admin Dashboard</title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="css/simplebar.css">
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="css/feather.css">
  <link rel="stylesheet" href="css/select2.css">
  <link rel="stylesheet" href="css/dropzone.css">
  <link rel="stylesheet" href="css/uppy.min.css">
  <link rel="stylesheet" href="css/jquery.steps.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">
  <link rel="stylesheet" href="css/quill.snow.css">
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
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="row align-items-center mb-2">
              <div class="col">
                <h2 class="h5 page-title">Welcome!</h2>
              </div>
            </div>
            <!-- widgets -->
            <div class="row my-4">
              <div class="col-md-4">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <small class="text-muted mb-1">Users</small>
                        <?php
                        $users = $user->countsUsers("owner");
                        ?>
                        <h3 class="card-title mb-0"><?php echo $users ?></h3>
                        <p class="small text-muted mb-0"><a href="users.php"><span class="fe fe-users fe-12 text-danger"></span> <span class="text-secondary">view users</span></a></p>
                      </div>
                      <div class="col-4 text-right">
                        <span class="fe fe-users fe-24"></span>
                      </div>
                    </div> <!-- /. row -->
                  </div> <!-- /. card-body -->
                </div> <!-- /. card -->
              </div> <!-- /. col -->
              <div class="col-md-4">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <small class="text-muted mb-1">Shops</small>
                        <?php
                        $shops = $shop->countShops(1);
                        $shps = $shop->countShops(0);
                        $sps = $shop->countShops(2);
                        ?>
                        <h3 class="card-title mb-0">
                          <span class="text-success"><?php echo $shops ?></span>,
                          <span class="text-info"><?php echo $shps ?></span>,
                          <span class="text-danger"><?php echo $sps ?></span>
                        </h3>
                        <p class="small text-muted mb-0"><a href="shops.php"><span class="fe fe-shopping-bag fe-12 text-warning"></span> <span class="text-secondary">view shops</span></a></p>
                      </div>
                      <div class="col-4 text-right">
                        <span class="fe fe-shopping-bag fe-24"></span>
                      </div>
                    </div> <!-- /. row -->
                  </div> <!-- /. card-body -->
                </div> <!-- /. card -->
              </div> <!-- /. col -->
              <div class="col-md-4">
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col">
                        <small class="text-muted mb-1">Single Items</small>
                        <?php
                        $items = $shop->countRandomItems();
                        ?>
                        <h3 class="card-title mb-0"><?php echo $items ?></h3>
                        <p class="small text-muted mb-0"><a href="single_items.php"><span class="fe fe-grid fe-12 text-success"></span> <span class="text-secondary">view single items</span></a></p>
                      </div>
                      <div class="col-4 text-right">
                        <span class="fe fe-grid fe-24"></span>
                      </div>
                    </div> <!-- /. row -->
                  </div> <!-- /. card-body -->
                </div> <!-- /. card -->
              </div> <!-- /. col -->
            </div> <!-- end section -->
            <div class="row">
              <div class="col-md-6">
                <div class="card shadow mb-4">
                  <div class="card-header">
                    <strong>Shops</strong>
                    <a class="float-right small text-muted" href="shops.php">View all</a>
                  </div>
                  <div class="card-body px-4">
                    <table class="table table-borderless mb-1 mx-n1 table-sm">
                      <thead>
                        <tr>
                          <th class="w-50">Shop Name</th>
                          <th class="text-right">Shop Type</th>
                          <th class="text-right">Products</th>
                          <th class="text-right">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $row = $shop->viewShopAdminWithLimit(0, 6);
                        foreach ($row as $rw) {
                          $prods = $shop->countShopProducts($rw['shop_id']);
                          $type = $shop->viewCategoryWithId($rw['cat_id']);
                          if ($rw['status'] == 0) {
                            $status = "Pending";
                            $badge = "info";
                        } elseif ($rw['status'] == 1) {
                            $status = "approved";
                            $badge = "success";
                        } elseif ($rw['status'] == 2) {
                            $status = "declined";
                            $badge = "danger";
                        }
                        ?>
                          <tr>
                            <td><strong><?php echo $rw['shop_name'] ?></strong></td>
                            <td class="text-right"><span class="badge badge-info badge-md"><?php echo $type['cat_name'] ?></span></td>
                            <td class="text-right"><?php echo $prods ?></td>
                            <td class="text-right"><span class="badge badge-sm badge-<?php echo $badge ?>"><?php echo $status ?></span></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div> <!-- .card-body -->
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
                      $row = $shop->viewRandomProductsAdminWithLimit(0, 4);
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
                      <?php } ?>
                    </div> <!-- / .list-group -->
                  </div> <!-- / .card-body -->
                </div> <!-- .card -->
              </div> <!-- .col -->
            </div> <!-- .row -->
          </div> <!-- /.col -->
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
  <script src="js/d3.min.js"></script>
  <script src="js/topojson.min.js"></script>
  <script src="js/datamaps.all.min.js"></script>
  <script src="js/datamaps-zoomto.js"></script>
  <script src="js/datamaps.custom.js"></script>
  <script src="js/Chart.min.js"></script>
  <script>
    /* defind global options */
    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
    Chart.defaults.global.defaultFontColor = colors.mutedColor;
  </script>
  <script src="js/gauge.min.js"></script>
  <script src="js/jquery.sparkline.min.js"></script>
  <script src="js/apexcharts.min.js"></script>
  <script src="js/apexcharts.custom.js"></script>
  <script src='js/jquery.mask.min.js'></script>
  <script src='js/select2.min.js'></script>
  <script src='js/jquery.steps.min.js'></script>
  <script src='js/jquery.validate.min.js'></script>
  <script src='js/jquery.timepicker.js'></script>
  <script src='js/dropzone.min.js'></script>
  <script src='js/uppy.min.js'></script>
  <script src='js/quill.min.js'></script>
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