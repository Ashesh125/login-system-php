<?php

require_once("../components/configure_settings.php");
require_once("../service/productService.php");

$productService = new productService();
if ($_POST) {
    if ($productService->operateProduct($_POST)) {
        header("location:../pages/products.php");
    } else {
        exit("Something Went Wrong");
    }
} else if ($_GET) {
    switch ($_GET['type']) {
        case "fetchAll":
            echo json_encode($productService->fetchAllLaptops());
            break;

        default:
            break;
    }
} else {
    echo "Something Went Wrong!";
}
