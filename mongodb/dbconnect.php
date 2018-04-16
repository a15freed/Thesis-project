<?php
  // connect to mongo
  $mongo = new MongoDB\Driver\Manager();
  // select the database
  $db = $mongo->exjobb;
  // select the collection
  $collection = $db->json_smartmeter_data;
?>
