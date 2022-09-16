<?php
    //Start session
    session_start();
    
    //Check whether the session variable SESS_MEMBER_ID is present or not
    if(!isset($_SESSION['user_id']) || (trim($_SESSION['user_id']) == '') || empty($_SESSION['fname'])) {
        header("location: ../login.php");
        exit();
    }
    else{
        $user_id = $_SESSION['user_id'];
        $fname = $_SESSION['fname'];
    }
?>