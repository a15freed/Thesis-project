<meta http-equiv="pragma" content="no-cache" />
<?php
	
	// this will include the file dbconnect.php which contains credentials
	include_once "postgresql/dbconnect.php";

	
	tryu {
        // init the database and create table
		$initQuery = file_get_contents("postgresql/initdb.sql");
		
		print_r($initQuery);

		// check if error occured
		$ret = pg_query($dbconn, $initQuery);
		if(!$ret) {
		  echo pg_last_error($db);
		} else {
		  echo "The table in the database was created with success!\n";
		}
			
	} catch (PDOException $e) {
		$errors++;
		echo "<span id='failText' />Failed initialization of database because of query (in init_db.sql): </span><br>";
	}
	
	pg_close($dbconn);
?>