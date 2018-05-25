<?php
// this will include the file dbconnect.php which contains credentials
include "../dbconnect.php";

set_time_limit(0);

// variables
$iterations =5;							// how many runs
$inserts = 5000;      				// inserts to do (customers)
$measures = 1440;     				// measures per inserts
$fileNr = 0;									// save file counter
$idM = 123456;        				// random measurements ID
$deviceWatt = 60;     				// the device watts
$startWatt = 25;      				// starting watts value for device
$time = date('Y-m-d H:i:s');	// get time
$timeArray= [];								// array to push response time

// start iteration
$index = 1;
while($index <= $iterations){
	$timeStart2 = microtime(true);
	$index++;
	$fileNr++;

	// generate json data
	$index2 = 1;
	while($index2 <= $inserts){
		$timeStart = microtime(true);
		$index2++;
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
	    $startWatt = $startWatt + ($deviceWatt * $wattsRand)/1000;
	    $startWatt = number_format(($startWatt), 2);
	    $time = date('Y-m-d H:i:s', strtotime($time.'+1 minute'));

			$Data = array(
		        'id' => $idM,
		        'date' => $time,
		        'kWh' => $startWatt,
	      	);
			array_push($jsonArray['measurements'], $Data);
		}
		// encode php array to string
    $jsonArrayEncoded = json_encode($jsonArray);

    $sqlQuery = "INSERT INTO json_table (data) VALUES ('$jsonArrayEncoded')";
    $runQuery = pg_query($dbconn, $sqlQuery);

		$timeEnd = microtime(true);

		//Measure response time and push to array
		$timeDiff = $timeEnd - $timeStart;
		$timeDiff = number_format(($timeDiff), 6);
		array_push($timeArray, $timeDiff);
	}
	$timeEnd2 = microtime(true);

	// write values from timeArray to file
	$file = 'measurements_plot_'.$fileNr.'.txt';
	foreach ($timeArray as $key=>$value) {
		file_put_contents($file, $value.PHP_EOL, FILE_APPEND | LOCK_EX);
		}

	//clear timeArray
	$timeArray= [];

	// calc time
  $timeDiff2 = $timeEnd2 - $timeStart2;
  $timeDiff2 = number_format(($timeDiff2), 3);

  // write values from timeArray to file
  $file = 'measurements.txt';
  file_put_contents($file, $timeDiff2.PHP_EOL, FILE_APPEND | LOCK_EX);

	// clear DB after each iteration except after last one
	if ($index < $iterations) {
		include('initdb.php');
	}
}
?>
