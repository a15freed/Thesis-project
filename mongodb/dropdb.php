<?php
require_once "vendor/autoload.php";
$db = (new MongoDB\Client)->exjobb;

$result = $db->drop();

var_dump($result);
?>
