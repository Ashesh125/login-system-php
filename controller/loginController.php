<?php

require_once("../service/loginService.php");
session_start();


if ($_POST && $_SESSION['client'] == 0) {
    $loginService = new LoginService();

    $arr = $loginService->checkLogin($_POST);
    if ($arr['id'] != 0) {
        $_SESSION['client'] = $arr['id'];
        $_SESSION['name'] = $arr['name'];
        header("location:../home.php");
    } else {
        header("location:../index.php?err=noAccount");
    }
} else if ($_SESSION['client'] != 0) {
    echo "You are already Logged in";
}
