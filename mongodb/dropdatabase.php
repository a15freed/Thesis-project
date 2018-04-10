<?php
$db = (new MongoDB\Driver\Manager)->dbName;

$result = $db->dropCollection('collectionName');

var_dump($result);
 ?>
