<?php
include "../includes/session.php";
include_once "../classes/manageusercontr.class.php";
include_once "../classes/profilecontr.class.php";
include_once "../classes/shopscontr.class.php";
$profile = new ProfileContr;
$shop = new ShopsContr;
$user = new ManageUserContr;
if (isset($_POST['save'])) {
  function TestInput($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $old_password = TestInput($_POST['oldPass']);
  $new_password = TestInput($_POST['newPass']);
  $conf_password = TestInput($_POST['conPass']);

  if ($new_password != $conf_password) {
    $msg = "The two passwords did not match!";
  } elseif ($old_password == $new_password) {
    $msg = "New password can’t be the same as a previous password!";
  } else {
    // passing information
    $msg = $user->changePassword($user_id, $old_password, $new_password);
  }
}

if (isset($_POST['submit'])) {
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
  $type = TestInput($_POST['type']);
  $shop_id = TestInput($_POST['shopID']);
  $district = TestInput($_POST['district']);
  $opent = TestInput($_POST['opent']);
  $closet = TestInput($_POST['closet']);
  $area = TestInput($_POST['area']);
  $phone = TestInput($_POST['phone']);
  $phone2 = (isset($_POST['phone2']) ? TestInput($_POST['phone2']) : null);
  $address = (isset($_POST['address']) ? TestInput($_POST['address']) : null);
  $email = (isset($_POST['email']) ? TestInput($_POST['email']) : null);
  $url = (isset($_POST['url']) ? TestInput($_POST['url']) : null);


  $fb = (isset($_POST['fb']) ? TestInput($_POST['fb']) : null);
  $ig = (isset($_POST['ig']) ? TestInput($_POST['ig']) : null);
  $twitter = (isset($_POST['twitter']) ? TestInput($_POST['twitter']) : null);
  $app = (isset($_POST['app']) ? TestInput($_POST['app']) : null);

  $sun = (isset($_POST['sun']) ? $_POST['sun'] : null);
  $mon = (isset($_POST['mon']) ? $_POST['mon'] : null);
  $tue = (isset($_POST['tue']) ? $_POST['tue'] : null);
  $wed = (isset($_POST['wed']) ? $_POST['wed'] : null);
  $thu = (isset($_POST['thu']) ? $_POST['thu'] : null);
  $fri = (isset($_POST['fri']) ? $_POST['fri'] : null);
  $sat = (isset($_POST['sat']) ? $_POST['sat'] : null);

  $days = $sun . $mon . $tue . $wed . $thu . $fri . $sat;

  $image = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];


  //--------------------------------------------compressing image-----------------------------------------------------
  $valid_ext = array('png', 'jpeg', 'jpg');
  $photoExt1 = @end(explode('.', $image));

  $phototest1 = strtolower($photoExt1);
  $real_name = pathinfo($image, PATHINFO_FILENAME);
  $new_name = $real_name . time() . '.' . $phototest1;

  $location = "../assets/images/logos/" . $new_name;
  $file_extension = pathinfo($location, PATHINFO_EXTENSION);
  $file_extension = strtolower($file_extension);


  if (in_array($file_extension, $valid_ext)) {
    // Compress Image 
    compressedImage($image_tmp, $location, 60);

    $result = $shop->updateBusiness($shop_id, $district, $name, $type, $area, $opent, $closet, $days, $address, $phone, $phone2, $email, $url, $new_name, $fb, $ig, $twitter, $app);
    if ($result) {
      $msg = "Business/shop updated";
      // header("refresh:4, url=register_shop.php");
    } else {
      $msg2 = "Error, couldn't edit business/shop";
    }
  } else {
    $msg2 = "Image/logo format is not correct.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mahala M. Mkwepu">
  <link rel="icon" href="../img/black.png">
  <title>Profile</title>
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
  <script type="text/javascript">
    function checkPass() {
      //Store the password field objects into variables ...
      var password = document.getElementById('password2');
      var confirm = document.getElementById('confirm2');
      //Set the colors we will be using ...
      var good_color = "#66cc66";
      var bad_color = "#ff6666";
      if (password.value == confirm.value) {
        confirm.style.backgroundColor = good_color;
      } else {
        confirm.style.backgroundColor = bad_color;
      }
    }
  </script>
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
          <div class="col-12 col-lg-10 col-xl-10">
            <h2 class="h3 mb-4 page-title">Settings</h2>
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
            <div class="my-4">
              <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Shop Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Change Password</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="row mb-4">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="inputPassword4">Old Password</label>
                          <input type="password" name="oldPass" class="form-control" id="inputPassword5" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                        </div>
                        <div class="form-group">
                          <label for="inputPassword5">New Password</label>
                          <input type="password" name="newPass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password2" onkeyup="checkPass();" required>
                        </div>
                        <div class="form-group">
                          <label for="inputPassword6">Confirm Password</label>
                          <input type="password" name="conPass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="confirm2" onkeyup="checkPass();" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <p class="mb-2">Password requirements</p>
                        <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
                        <ul class="small text-muted pl-4 mb-0">
                          <li> Minimum 8 character </li>
                          <li>At least one special character</li>
                          <li>At least one number</li>
                          <li>Can’t be the same as a previous password </li>
                        </ul>
                      </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-info">Save Change</button>
                  </form>
                </div>

                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <?php
                  $check = $shop->checkShop($user_id);

                  if ($check > 0) {

                    $view = $shop->viewShop($user_id);
                    $type = $shop->viewCategoryWithId($view['cat_id']);

                  ?>
                    <div class="row mt-5 align-items-center">
                      <div class="col-md-3 text-center mb-5">
                        <div class="avatar avatar-xl">
                          <img src="../assets/images/logos/<?php echo $view['logo'] ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                      </div>
                      <div class="col">
                        <div class="row align-items-center">
                          <div class="col-md-7">
                            <h4 class="mb-1"><?php echo $view['shop_name'] ?></h4>
                            <p class="small mb-3"><span class="badge badge-dark"><?php echo $type['cat_name'] ?></span></p>
                          </div>
                        </div>
                        <div class="row mb-4">
                          <div class="col-md-7">
                            <p class="text-muted"> Welcome to your shop's profile page. Update or edit your shop details here </p>
                          </div>
                          <div class="col">
                            <p class="small mb-0 text-muted"><?php echo $view['email'] ?></p>
                            <p class="small mb-0 text-muted"><?php echo $view['phone'] ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr class="my-4">
                    <form class="needs-validation" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom3">Shop name*</label>
                          <input type="text" class="form-control required" name="name" id="validationCustom3" value="<?php echo $view['shop_name'] ?>" required>
                          <div class="valid-feedback"> Looks good! </div>
                          <div class="invalid-feedback"> shop name required </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="validationSelect1">Business Type <span class="text-danger">*</span></label>
                          <select class="form-control required select2" name="type" id="validationSelect1" required>
                            <option value="">Select Type</option>
                            <optgroup label="Categories">
                              <?php
                              $types = $shop->viewCategories();

                              foreach ($types as $type) {
                              ?>
                                <option value="<?php echo $type['cat_id'] ?>"><?php echo $type['cat_name'] ?></option>
                              <?php } ?>
                            </optgroup>
                          </select>
                          <div class="valid-feedback"> Looks good! </div>
                          <div class="invalid-feedback"> Business type required </div>
                        </div>
                      </div> <!-- /.form-row -->
                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <label for="validationSelect2">District*</label>
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
                          <label for="validationCustom33">Area*</label>
                          <input type="text" class="form-control required" name="area" id="validationCustom33" value="<?php echo $view['area'] ?>" required>
                          <div class="valid-feedback"> Looks good! </div>
                          <div class="invalid-feedback"> Please provide a valid area </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="quantity">Address <span class="text-muted">(Optional)</span></label>
                          <div class="input-group">
                            <div class="input-group-append">
                              <div class="input-group-text" id="button-addon-date">P. O. Box</div>
                            </div>
                            <input type="number" name="address" value="<?php echo $view['address'] ?>" class="form-control required" id="quantity">
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                        </div>
                      </div> <!-- /.form-row -->
                      <div class="form-row">
                        <div class="col-md-3 mb-3">
                          <label for="validationSelect2">Opening Time*</label>
                          <input type="time" class="form-control required" value="<?php echo $view['opening_time'] ?>" name="opent" id="validationCustom33" required>
                          <div class="valid-feedback"> Looks good! </div>
                          <div class="invalid-feedback"> Please enter valid district </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationCustom33">Closing Time*</label>
                          <input type="time" class="form-control required" value="<?php echo $view['closing_time'] ?>" name="closet" id="validationCustom33" required>
                          <div class="valid-feedback"> Looks good! </div>
                          <div class="invalid-feedback"> Please provide a valid area </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="quantity">Opening Days*</label>
                          <div class="row container">
                            <div class="form-check col-3">
                              <input type="checkbox" name="sun" value="Sunday, " class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Sun</label>
                            </div>
                            <div class="form-check col-3">
                              <input type="checkbox" name="mon" value="Monday, " class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Mon</label>
                            </div>
                            <div class="form-check col-3">
                              <input type="checkbox" name="tue" value="Tuesday, " class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Tue</label>
                            </div>
                            <div class="form-check col-3">
                              <input type="checkbox" name="wed" value="Wednesday, " class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Wed</label>
                            </div>
                            <div class="form-check col-3">
                              <input type="checkbox" name="thu" value="Thursday, " class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Thu</label>
                            </div>
                            <div class="form-check col-3">
                              <input type="checkbox" name="fri" value="Friday, " class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Fri</label>
                            </div>
                            <div class="form-check col-3">
                              <input type="checkbox" name="sat" value="Saturday, " class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Sat</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <input type="number" name="shopID" value="<?php echo $view['shop_id'] ?>" hidden>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom3">Phone*</label>
                          <input type="text" class="form-control required" name="phone" id="validationCustom3" value="<?php echo $view['phone'] ?>" required>
                          <div class="valid-feedback"> Looks good! </div>
                          <div class="invalid-feedback"> Phone number required </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom3">Phone 2 <span class="text-muted">(Optional)</span></label>
                          <input type="text" class="form-control required" name="phone2" id="validationCustom3" value="<?php echo $view['phone_2'] ?>">
                          <div class="valid-feedback"> Looks good! </div>
                        </div>
                      </div> <!-- /.form-row -->
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom3">Facebook Link <span class="text-muted">(Optional)</span></label>
                          <div class="input-group">
                            <div class="input-group-append">
                              <div class="input-group-text" id="button-addon-date"><span class="fe fe-16 fe-facebook"></span></div>
                            </div>
                            <input type="url" class="form-control" name="fb" id="validationCustom3" value="<?php echo $view['facebook'] ?>">
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom3">Instagram Link <span class="text-muted">(Optional)</span></label>
                          <div class="input-group">
                            <div class="input-group-append">
                              <div class="input-group-text" id="button-addon-date"><span class="fe fe-16 fe-instagram"></span></div>
                            </div>
                            <input type="url" class="form-control" name="ig" id="validationCustom3" value="<?php echo $view['instagram'] ?>">
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom3">Twitter Link <span class="text-muted">(Optional)</span></label>
                          <div class="input-group">
                            <div class="input-group-append">
                              <div class="input-group-text" id="button-addon-date"><span class="fe fe-16 fe-twitter"></span></div>
                            </div>
                            <input type="url" class="form-control" name="twitter" id="validationCustom3" value="<?php echo $view['twitter'] ?>">
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom3">WhatsApp Number <span class="text-muted">(Optional)</span></label>
                          <div class="input-group">
                            <div class="input-group-append">
                              <div class="input-group-text" id="button-addon-date"><span class="fe fe-12 fe-phone" style="border: 1px solid black; padding: 3px; border-radius:100% 100% 100% 0;"></span></div>
                            </div>
                            <input type="text" class="form-control" name="app" id="validationCustom3" value="<?php echo $view['whatsapp'] ?>">
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="validationCustom3">Email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control required" name="email" id="validationCustom3" value="<?php echo $view['email'] ?>">
                            <div class="valid-feedback"> Looks good! </div>
                          </div>
                          <div class="mb-3">
                            <label for="validationCustom3">Business Website <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                              <div class="input-group-append">
                                <div class="input-group-text" id="button-addon-date"><span class="fe fe-16 fe-globe"></span></div>
                              </div>
                              <input type="url" class="form-control required" name="url" id="validationCustom3" value="<?php echo $view['website'] ?>">
                              <div class="valid-feedback"> Looks good! </div>
                            </div>
                          </div>
                        </div>
                        <!-- .col -->
                        <div class="col-md-6 form-group mb-3">
                          <label for="customFile">Upload Image*</label>
                          <div class="alert alert-primary" role="alert">
                            <span class="fe fe-alert-circle fe-16 mr-2"></span> Upload the logo or photo capturing the shop or products!
                          </div>
                          <div class="row">
                            <div class="col-3">
                              <img src="../assets/images/logos/<?php echo $view['logo'] ?>" alt="..." width="100%" height="50px">
                            </div>
                            <div class="col-9">
                                <input type="file" class="form-control" name="image" id="customFile" required>
                                <div class="valid-feedback"> Looks good! </div>
                                <div class="invalid-feedback"> Image required </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <button class="btn btn-primary" name="submit" type="submit">Edit Shop</button>

                    </form>
                  <?php } else { ?>
                  <?php } ?>
                </div>
              </div>
            </div> <!-- /.card-body -->
          </div> <!-- /.col-12 -->
        </div> <!-- .row -->
      </div> <!-- .container-fluid -->
    </main>
    <!-- main -->
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