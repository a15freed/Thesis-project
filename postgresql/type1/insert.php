<?php
// https://stackoverflow.com/questions/43834471/php-create-json-with-foreach
// https://stackoverflow.com/questions/6054033/pretty-printing-json-with-php
// https://stackoverflow.com/questions/8169139/adding-minutes-to-date-time-in-php
// http://www.postgresqltutorial.com/postgresql-json/
// https://datavirtuality.com/blog/json-in-postgresql/
// this will include the file dbconnect.php which contains credentials
// https://datavirtuality.com/blog/json-in-postgresql/
include "../dbconnect.php";

// variables
$inserts = 5;
$idM = 25454;
$wattsHour = 90;
$idCounter = 0;

$time = date('Y-m-d H:i:s');

// loop to create JSON data
for ($i = 1; $i <= $inserts; $i++) {
  $wattsRand = 0;
  $wattsRand = $wattsRand + rand(1,8);
  $wattsHour = $wattsHour + (60 * $wattsRand)/1000;
  $idM++;
  $idCounter++;

  $jsonArray = array(
              'smartMeter' => array(
                                  'id' => '1',
                                  'device' => 'Eliond',
                                  'sensorType' => 'Electric',
                                  'createdOn' => '20180205',
                              ),

              'measurements' => array(
                                  'id' => $idM,
                                  'date' => $time,
                                  'kWh' => $wattsHour,
                              ),
          );
  $time = date('Y-m-d H:i:s', strtotime($time.'+1 minute'));

  // encode array to string
  $jsonArrayEncoded = json_encode($jsonArray);

  // insert array to database
  $sqlQuery = "INSERT INTO json_table VALUES ('$idCounter','$jsonArrayEncoded')";

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
?>