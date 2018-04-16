<?php
include "initdb.php";

$query = new MongoDB\Driver\Query( [] );
$cursor = $mongo->executeQuery("exjobb.json_smartmeter_data", $query);

foreach($cursor as $document) {
    print_r($document);
}
 ?>
