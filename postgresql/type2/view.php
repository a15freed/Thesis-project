<?php
	header('Content-Type: application/json');
	
	// this will include the file dbconnect.php which contains credentials
	include "../dbconnect.php";

	// query the database and print the content on screen
	$result = pg_query($dbconn,"SELECT * FROM json_table");
	
	var_dump(pg_fetch_all($result));
?>