<?php
include "initdb.php";
$query = new MongoDB\Driver\Query([]);

$rows = $mng->executeQuery("dbName.collectionName", $query);

foreach ($rows as $row)
    {
         echo "$row->data - $row->info\n";
    }
 ?>
