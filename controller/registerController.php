<?php

require_once("../service/registerService.php");
session_start();


if ($_POST && $_SESSION['client'] == 0) {
    $registerService = new RegisterService();

    if (!$registerService->checkUserExists($_POST)) {
        echo "An account already exists for the given email.<br/>Please try logging in instead!";
    } else {
        if ($registerService->registerNewUser($_POST)) {
            echo "Account Successfully Registered";
        } else {
            echo "Something Went Wrong";
        }
    }
} else if ($_SESSION['client'] != 0) {
    echo "You are already Logged in";
}
