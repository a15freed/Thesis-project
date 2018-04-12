<?php
// https://stackoverflow.com/questions/43834471/php-create-json-with-foreach
// https://stackoverflow.com/questions/6054033/pretty-printing-json-with-php
// https://stackoverflow.com/questions/8169139/adding-minutes-to-date-time-in-php
// http://www.postgresqltutorial.com/postgresql-json/
// https://datavirtuality.com/blog/json-in-postgresql/
// https://stackoverflow.com/questions/6245971/accurate-way-to-measure-execution-times-of-php-scripts
// https://stackoverflow.com/questions/18765899/im-using-php-and-need-to-insert-into-sql-using-a-while-loop
// http://thisinterestsme.com/php-calculate-execution-time/

// this will include the file dbconnect.php which contains credentials
include "../dbconnect.php";

// variables
$inserts = 1000;      // inserts to do (customers)
$measures = 1440;     // Measures per sensor/inserts and day
$idM = 123456;        // random measurements ID
$lampWatt = 60;       // the device watts
$wattsHour = 25;      // starting watts value for device
$time = date('Y-m-d H:i:s');

// generate json data
$index = 1;
while($index <= $inserts){

	$jsonArray = array(

	'smartMeter' => array(

	      'id' => '1',
	      'device' => 'Eliond',
	      'sensorType' => 'Electric',
	      'createdOn' => '20180205',
	  	),

	'measurements' => array(),
	);

	for ($i=0; $i <$measures ; $i++) {
    $idM++;

    // to simulate the consumption in watt for the device
    $wattsRand = 0;
    $wattsRand = $wattsRand + rand(0,8); // device is on between 0-8 hours/day
    $wattsHour = $wattsHour + ($lampWatt * $wattsRand)/1000;
    $wattsHour = number_format(($wattsHour), 2);
    $time = date('Y-m-d H:i:s', strtotime($time.'+1 minute'));

		$Data = array(
	        'id' => $idM,
	        'date' => $time,
	        'kWh' => $wattsHour,
      	);
		array_push($jsonArray['measurements'], $Data);
	}

	// encode array to string
	$jsonArrayEncoded = json_encode($jsonArray);

	// insert array to database
	$sqlQuery = "INSERT INTO json_table (data) VALUES ('$jsonArrayEncoded')";
	$runQuery = pg_query($dbconn, $sqlQuery);

  // increase counter for while loop
	$index++;

	// calculate execution time
	$exeTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

	// write values of exeTime to file
	$file = 'measurements_plot.txt';
	file_put_contents($file, number_format(($exeTime), 2).PHP_EOL, FILE_APPEND | LOCK_EX);
}
// calculate execution time
$exeTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

// write values of exeTime to file
$file = 'measurements_total.txt';
file_put_contents($file, number_format(($exeTime), 2).PHP_EOL, FILE_APPEND | LOCK_EX);
?>
