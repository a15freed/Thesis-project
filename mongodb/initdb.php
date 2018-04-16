<?php
include "dbconnect.php";
$mongo->executeCommand('exjobb', new \MongoDB\Driver\Command(["drop" => "json_smartmeter_data"]));
 ?>
