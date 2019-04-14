<?php
/**
 * Created by PhpStorm.
 * User: coolone
 * Date: 14.04.19
 * Time: 5:35
 */

$file = "config.json";

$json = json_decode(file_get_contents($file),TRUE);

$json[$_GET['key']] = $_GET['value'];

file_put_contents($file, json_encode($json));
