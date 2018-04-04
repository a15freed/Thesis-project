<?php
// https://stackoverflow.com/questions/43834471/php-create-json-with-foreach
// https://stackoverflow.com/questions/6054033/pretty-printing-json-with-php
// https://stackoverflow.com/questions/8169139/adding-minutes-to-date-time-in-php
// http://www.postgresqltutorial.com/postgresql-json/
// https://datavirtuality.com/blog/json-in-postgresql/
// https://stackoverflow.com/questions/6245971/accurate-way-to-measure-execution-times-of-php-scripts
// http://php.net/manual/en/function.array-fill-keys.php

// this will include the file dbconnect.php which contains credentials
include "../dbconnect.php";

$jsonArray = array();
$Data = array();

for ($i=0; $i <=5 ; $i++) { 
	
	$jsonArray = array(

	'smartMeter' => array(

	      'id' => '1',
	      'device' => 'Eliond',
	      'sensorType' => 'Electric',
	      'createdOn' => '20180205',
	  	),

	'measurements' => array(),	
	);
	
	for ($i=0; $i <5 ; $i++) { 

		$Data = array(
	        'id' => 12,  
	        'date' => 45,
	        'kWh' => 67,
      	);
		array_push($jsonArray['measurements'], $Data);
		//array_fill_keys($jsonArray['measurements'] => $Data);
	}
	header('Content-Type: application/json');
	echo json_encode($jsonArray, JSON_PRETTY_PRINT);
}

//echo json_encode($jsonArray);

?>