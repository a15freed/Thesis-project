<?php
// this will include the file dbconnect.php which contains credentials
include "../dbconnect.php";

set_time_limit(0);

// variables
$iterations = 5;							// how many runs
$maxRows = 10000;							// row in db
$queries = 10000;     					// measures per inserts
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

		// choose random ID
		$randomNmb = rand(1,$maxRows);

		// query the database
		$result = pg_query($dbconn,"SELECT ID FROM json_table WHERE ID=$randomNmb");

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
