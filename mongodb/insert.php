<?php
$mongo = new MongoDB\Driver\Manager('mongodb://localhost:27017');

$bulkWrite = new MongoDB\Driver\BulkWrite;
$bulkWrite->insert(['name' => 'Ceres', 'size' => 946, 'distance' => 2.766]);
$bulkWrite->insert(['name' => 'Vesta', 'size' => 525, 'distance' => 2.362]);

$mongo->executeBulkWrite("exjobb.json_smartmeter_data", $bulkWrite);
?>
