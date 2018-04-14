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

set_time_limit(7200);

// variables
$iterations = 10;							// how many runs
$inserts = 1000;      				// inserts to do (customers)
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
		$timeEnd = microtime(true);

		// encode array to string
		$jsonArrayEncoded = json_encode($jsonArray);

		// insert array to database
		$sqlQuery = "INSERT INTO json_table (data) VALUES ('$jsonArrayEncoded')";
		$runQuery = pg_query($dbconn, $sqlQuery);

		//Measure response time and push to array
		$timeDiff = $timeEnd - $timeStart;
		$timeDiff = number_format(($timeDiff), 4);
		array_push($timeArray, $timeDiff);
	}

	// write values from timeArray to file
	$file = 'measurements_plot_'.$fileNr.'.txt';
	foreach ($timeArray as $key=>$value) {
		file_put_contents($file, $value.PHP_EOL, FILE_APPEND | LOCK_EX);
		}

	//clear timeArray
	$timeArray= [];

	// clear DB after each iteration except after last one
		include('initdb.php');
}
?>
