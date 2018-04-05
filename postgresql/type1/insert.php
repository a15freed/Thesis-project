<?php
// https://stackoverflow.com/questions/43834471/php-create-json-with-foreach
// https://stackoverflow.com/questions/6054033/pretty-printing-json-with-php
// https://stackoverflow.com/questions/8169139/adding-minutes-to-date-time-in-php
// http://www.postgresqltutorial.com/postgresql-json/
// https://datavirtuality.com/blog/json-in-postgresql/
// https://stackoverflow.com/questions/6245971/accurate-way-to-measure-execution-times-of-php-scripts
// https://stackoverflow.com/questions/18765899/im-using-php-and-need-to-insert-into-sql-using-a-while-loop
// Accurate way to measure execution times of php scripts

// this will include the file dbconnect.php which contains credentials
include "../dbconnect.php";

$inserts = 10;
$measures = 10;
$index = 1;
while($index <= $inserts){
    	
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

		$Data = array(
	        'id' => 12,  
	        'date' => 45,
	        'kWh' => 67,
      	);
		array_push($jsonArray['measurements'], $Data);
	}
	
	// encode array to string
	$jsonArrayEncoded = json_encode($jsonArray);

	// insert array to database
	$sqlQuery = "INSERT INTO json_table (data) VALUES ('$jsonArrayEncoded')";
	try {
    // check if error occured
    $ret = pg_query($dbconn, $sqlQuery);
    if(!$ret) {
      echo pg_last_error($dbconn);
    } else {
      echo "<span style='background-color: #4CAF50'>The insert was successfully";
    }

  } catch (PDOException $e) {
    echo "<span style='background-color: #f44336'>An error occured</span>";
  }
$index++;}
?>