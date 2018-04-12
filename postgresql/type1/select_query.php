<?php
	// this will include the file dbconnect.php which contains credentials
	include "../dbconnect.php";

	$queries = 1000;
	$maxRows = 1000;

	for ($i=0; $i <=$queries ; $i++) {

		// choose random ID
		$randomNmb = rand(1,$maxRows);

		// query the database
		$result = pg_query($dbconn,"SELECT ID FROM json_table WHERE ID=$randomNmb");

		// calculate execution time
		$exeTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

		// write values of exeTime to file
		$file = 'measurements_query.txt';
		file_put_contents($file, number_format(($exeTime), 2).PHP_EOL, FILE_APPEND | LOCK_EX);
	}
?>
