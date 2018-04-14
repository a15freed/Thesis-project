<?php
	// this will include the file dbconnect.php which contains credentials
	include "../dbconnect.php";

	$iterations = 10;
	$queries = 1000;
	$maxRows = 1000;
	$fileNr = 0;
	$queryArray= [];

	$index = 1;
	while($index <= $iterations){
		$fileNr++;
		$index++;
		while ($index2 <= $queries) {
			$timeStart = microtime(true);
			$index2++;

			// choose random ID
			$randomNmb = rand(1,$maxRows);

			// query the database
			try {
			$result = pg_query($dbconn,"SELECT ID FROM json_table WHERE ID=$randomNmb");	
			} catch (\Exception $e) {

			}

			// calculate execution time
			$timeEnd = microtime(true);
			$timeDiff = $timeEnd - $timeStart;
			$timeDiff = number_format(($timeDiff), 6);

			array_push($queryArray, $timeDiff);

		}
		// write values of timeArray to file
		$file = 'measurements_query_'.$fileNr.'.txt';
		foreach ($queryArray as $key=>$value) {
			file_put_contents($file, $value.PHP_EOL, FILE_APPEND | LOCK_EX);
			}
	}

	echo "Select done!";
?>
