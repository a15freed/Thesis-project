<?php
// https://stackoverflow.com/questions/43834471/php-create-json-with-foreach
// https://stackoverflow.com/questions/6054033/pretty-printing-json-with-php
// https://stackoverflow.com/questions/8169139/adding-minutes-to-date-time-in-php
// http://www.postgresqltutorial.com/postgresql-json/
// https://datavirtuality.com/blog/json-in-postgresql/

// this will include the file dbconnect.php which contains credentials
include "../dbconnect.php";

// changable variables
$inserts = 2;         // inserts
$measureHours = 2;    // hours to measure
$watts = 90;          // start value
$lampWatts = 60;      // the watts of the lamp
$idM = 2;         // id for the meausurment

// strict variables
$customerID = 0;      // customer id
$secondsPH = 3600;    // seconds per hour
$measuresToDo = ($measureHours * $secondsPH);

$time = date('Y-m-d H:i:s');

// loop to create JSON data
for ($i = 1; $i <= $inserts; $i++) {

  $jsonArray = array();
  
  $customerID++;

  $jsonArray = array(
              'smartMeter' => array(
                                  'id' => '1',
                                  'device' => 'Eliond',
                                  'sensorType' => 'Electric',
                                  'createdOn' => '20180205',
                              ),
              );
  
  $jsonArray2 = array();

    for ($i = 0; $i <= $measuresToDo; $i++) {
      $wattsRand = 0;     // reset varable
      $wattsRand = $wattsRand + rand(1,8);    // random hour 1-8 hour that lamp is lit
      $watts = $watts + ($lampWatts * $wattsRand)/1000; // the lamps consumption /h
      
      $jsonArray2 = array(
                'measurements' => array(
                            'id' => $idM,  
                            'date' => $time,
                            'kWh' => $watts,
                          ),
      );
      $time = date('Y-m-d H:i:s', strtotime($time.'+1 seconds'));
      $idM++;
    }
  
  $jsonArrayMerge = array_merge($jsonArray, $jsonArray2);
  
  // encode array to string
  $jsonArrayEncoded = json_encode($jsonArrayMerge);

  // insert array to database
  $sqlQuery = "INSERT INTO json_table (id, data) VALUES ('$customerID','$jsonArrayEncoded')";

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
}
var_dump($result);
?>