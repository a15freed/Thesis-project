<?php
$mongo = new MongoDB\Driver\Manager('mongodb://localhost:27017');

$query = new MongoDB\Driver\Query( [] );
$cursor = $mongo->executeQuery("exjobb.json_smartmeter_data", $query);

foreach($cursor as $document) {
    print_r($document);
}
 ?>
