<?php
/**
 * Created by PhpStorm.
 * User: coolone
 * Date: 14.04.19
 * Time: 5:35
 */

if($_SERVER['SERVER_ADDR'] == $_SERVER['HTTP_X_FORWARDED_FOR']) {

    $file = "config.json";

    $json = json_decode(file_get_contents($file), TRUE);

    $json[$_GET['key']] = $_GET['value'];

    file_put_contents($file, json_encode($json));
}
