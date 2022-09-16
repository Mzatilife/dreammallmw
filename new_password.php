<?php
include_once 'classes/manageusercontr.class.php';

session_start();

if (isset($_POST['reset'])) {
    function TestInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $fname = $_SESSION['fname'];
    $email = $_SESSION['email'];
    $password1 = TestInput($_POST['password']);
    $password2 = TestInput($_POST['password2']);

    $uppercase = preg_match('@[A-Z]@', $password1);
    $lowercase = preg_match('@[a-z]@', $password1);
    $number    = preg_match('@[0-9]@', $password1);
    $specialChars = preg_match('@[^\w]@', $password1);

    if (empty($password1) && empty($password2)) {
        $msg2 = "All fields are required";
    } elseif ($password1 != $password2) {
        $msg2 = "Passwords do not match";
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password1) < 8) {
        $msg2 = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    } else {

        $code = new ManageUserContr();
        $result = $code->resetPassword($fname, $email, $password1);

        if ($result) {
            $msg = "Your password has been reset";
            header("refresh:4, url= login.php");
        } else {
            $msg2 = "Cannot reset password";
        }
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
    <link rel="icon" href="img/black.png">
    <title>Forgot Password</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="admin/css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="admin/css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="admin/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="admin/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="admin/css/app-dark.css" id="darkTheme" disabled>
    <script type="text/javascript">
        function checkPass() {
            //Store the password field objects into variables ...
            var password = document.getElementById('password');
            var confirm = document.getElementById('password2');
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

<body class="light bg-secondary">
    <div class="wrapper" style="height:500px">
        <div class="row align-items-center h-100">
            <form class="col-lg-6 col-md-6 col-10 mx-auto text-center bg-light rounded" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="mx-auto text-center my-4">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.php">
                        <h1><img src="img/black.png" width="40px" height="35px" alt="logo">ream<sup>Mall</sup></h1>
                    </a>
                    <h2 class="my-3">Reset Password</h2>
                </div>
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
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password" onkeyup="checkPass();">
                        </div>
                        <div class="form-group">
                            <label for="password2">Confirm Password</label>
                            <input type="password" name="password2" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" onkeyup="checkPass();" id="password2">
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
                <button class="btn btn-lg btn-secondary text-white btn-block" name="reset" type="submit">Reset Password</button>
                <p class="mt-5 mb-3 text-muted">
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | Developed By <a href="https://dreamcodemw.com" target="_blank">DreamCodeMw</a>
                </p>
            </form>
        </div>
    </div>
    <script src="admin/js/jquery.min.js"></script>
    <script src="admin/js/popper.min.js"></script>
    <script src="admin/js/moment.min.js"></script>
    <script src="admin/js/bootstrap.min.js"></script>
    <script src="admin/js/simplebar.min.js"></script>
    <script src='admin/js/daterangepicker.js'></script>
    <script src='admin/js/jquery.stickOnScroll.js'></script>
    <script src="admin/js/tinycolor-min.js"></script>
    <script src="admin/js/config.js"></script>
    <script src="admin/js/apps.js"></script>
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
</body>

</html>