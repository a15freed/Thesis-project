<?php
	
	include_once "postgresql/dbconnect.php"; // this will include the file dbconnect.php
   
	// create table
    $sql =<<<EOF
    drop table if exists TESTTABELL cascade;
	CREATE TABLE TESTTABELL
      (ID INT PRIMARY KEY 	NOT NULL,
      TESTTEXT TEXT 		NOT NULL);
EOF;

   $ret = pg_query($db, $sql);
   if(!$ret) {
      echo pg_last_error($db);
   } else {
      echo "The table in the database was created with success!\n";
   }
   pg_close($db);
?>