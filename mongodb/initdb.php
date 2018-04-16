<?php
$mongo = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$mongo->executeCommand('exjobb', new \MongoDB\Driver\Command(["drop" => "json_smartmeter_data"]));
 ?>
