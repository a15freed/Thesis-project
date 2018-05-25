<?php
// https://stackoverflow.com/questions/43834471/php-create-json-with-foreach
// https://stackoverflow.com/questions/6054033/pretty-printing-json-with-php
// https://stackoverflow.com/questions/8169139/adding-minutes-to-date-time-in-php
// http://www.postgresqltutorial.com/postgresql-json/
// https://datavirtuality.com/blog/json-in-postgresql/
// https://stackoverflow.com/questions/6245971/accurate-way-to-measure-execution-times-of-php-scripts
// https://stackoverflow.com/questions/18765899/im-using-php-and-need-to-insert-into-sql-using-a-while-loop
// http://thisinterestsme.com/php-calculate-execution-time/
// http://php.net/manual/en/mongocollection.find.php

require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->exjobb->json_data;

set_time_limit(0);

// variables
$iterations = 5;							// how many runs
$queries = 10000;     				// measures per inserts
$fileNr = 0;									// save file counter
$timeArray= [];								// array to push response time

// start iteration
$index = 1;
while($index <= $iterations){
	$timeStart2 = microtime(true);
	$index++;
	$fileNr++;

	$index2 = 1;
	while($index2 <= $queries){
		$timeStart = microtime(true);
		$index2++;

    // query the database
    $q = array('measurements.id'=> 123457);
    $cursor = $collection->findOne($q);

		$timeEnd = microtime(true);

		//Measure response time and push to array
		$timeDiff = $timeEnd - $timeStart;
		$timeDiff = number_format(($timeDiff), 6);
		array_push($timeArray, $timeDiff);
		}

		$timeEnd2 = microtime(true);

		// calc time
		$timeDiff2 = $timeEnd2 - $timeStart2;
		$timeDiff2 = number_format(($timeDiff2), 3);

		// write values from timeArray to file
		$file = 'measurements_query.txt';
		file_put_contents($file, $timeDiff2.PHP_EOL, FILE_APPEND | LOCK_EX);

		// clear DB after each iteration except after last one
		if ($index < $iterations) {
			include('initdb.php');
		}

		// write values from timeArray to file
		$file = 'measurements_plot_'.$fileNr.'.txt';
		foreach ($timeArray as $key=>$value) {
			file_put_contents($file, $value.PHP_EOL, FILE_APPEND | LOCK_EX);
			}

		//clear timeArray
		$timeArray= [];
	}
?>
