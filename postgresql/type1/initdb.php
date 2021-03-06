<?php

	// this will include the file dbconnect.php which contains credentials
	include "../dbconnect.php";

	if(!$dbconn) {
		 echo "<span style='background-color: #f44336'>Error: Unable to open the database</span>";
	} else {
		 echo "<span style='background-color: #4CAF50'>The database was opened successfully</span><br><br>";
	}

  // init the database and create table
	$initQuery = file_get_contents("initdb.sql");

	echo "<span>Creating database..</span><br>";
	try {
		// check if error occured
		$ret = pg_query($dbconn, $initQuery);
		if(!$ret) {
		  echo pg_last_error($dbconn);
		} else {
		  echo "<span style='background-color: #4CAF50'>The table was created successfully!</span><br><br>";
		}

	} catch (PDOException $e) {
		echo "<span style='background-color: #f44336'>An error occured</span>";
	}
?>
