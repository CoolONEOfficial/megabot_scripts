<?php
/**
 * Created by PhpStorm.
 * User: coolone
 * Date: 14.04.19
 * Time: 11:00
 */

//if($_SERVER['SERVER_ADDR'] == $_SERVER['HTTP_X_FORWARDED_FOR']) {

$file = "config.json";

$json = json_decode(file_get_contents($file), TRUE);

$json[$_GET['key']] = $_GET['value'];

header('Content-Type: application/text');
header("Access-Control-Allow-Origin: *");

echo json_encode($json);
//}
