<?php
include "initdb.php";
$bulk = new MongoDB\Driver\BulkWrite;
$someData = "Adam";
$someInfo = "Stenbitsgatan";
$doc = ["_id" => new MongoDB\BSON\ObjectID, "data" => $someData, "info" => $someInfo];

$bulk->insert($doc);
$mng->executeBulkWrite('dbName.collectionName', $bulk);
 ?>
