<?php
   $host        = "host = localhost";
   $port        = "port = 5432";
   $dbname      = "dbname = test1";
   $credentials = "user = userName password=pass123";

   $dbconn = pg_connect( "$host $port $dbname $credentials"  );
?>
