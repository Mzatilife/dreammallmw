<?php
session_start();
unset($_SESSION['fname']);
unset($_SESSION['user_id']);
header('location:../login.php');
