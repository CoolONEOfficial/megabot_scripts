<?php
/**
 * Created by PhpStorm.
 * User: coolone
 * Date: 14.04.19
 * Time: 6:39
 */

require_once './vendor/autoload.php';

DB::$user = 'a0231165_megabot_base';
DB::$password = 'megabotiscool';
DB::$dbName = 'a0231165_messages_data';
DB::$encoding = 'utf8';

header('Content-Type: application/text');
header("Access-Control-Allow-Origin: *");
echo json_encode(DB::query(
    $_GET["query"]
)
);
