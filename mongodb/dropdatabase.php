<?php
include "initdb.php";
$mng->executeCommand('dbName', new \MongoDB\Driver\Command(["drop" => "collectionName"]));
 ?>
