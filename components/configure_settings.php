<?php
session_start();

$current_file_path = dirname(dirname(__FILE__));

$file = $current_file_path . "/settings.json";

$file_contents = json_decode(file_get_contents($file));
$settings = $file_contents->settings;

define("NAME", $settings->name);
define("LOGO", $settings->config->logo->logo_url . "/" . $settings->config->logo->logo_name);
define("HOST", $settings->config->host_url);
