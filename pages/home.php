<?php

require_once("../components/dashboard_nav.php");
if (!isset($_SESSION['client'])) {
    header("./index.php");
} else {
}
