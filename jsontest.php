<?php
// https://stackoverflow.com/questions/43834471/php-create-json-with-foreach
// https://stackoverflow.com/questions/6054033/pretty-printing-json-with-php
// https://stackoverflow.com/questions/8169139/adding-minutes-to-date-time-in-php
// http://www.postgresqltutorial.com/postgresql-json/

// this will include the file dbconnect.php which contains credentials
include "postgresql/dbconnect.php";

$inserts = 154;
$idM = 25454;
$wattsHour = 90;

$time = date('Y-m-d H:i:s');

for ($i = 1; $i <= $inserts; $i++) {
    $wattsRand = 0;
    $wattsRand = $wattsRand + rand(1,8);
    $wattsHour = $wattsHour + (60 * $wattsRand)/1000;
    $idM++;

    $sqlQuery = "INSERT INTO testtabell VALUES (1, '{"smartMeter": "Paint", "tags": ["Improvements", "Color"], "finished": true}')";

    array_push($jsonArray, array(
                'smartMeter' => array(
                                    'id' => $row['1'],
                                    'device' => $row['Eliond'],
                                    'sensorType' => $row['Electric'],
                                    'createdOn' => $row['20180205'],
                                ),

                'measurements' => array(
                                    'id' => $row[$idM],
                                    'date' => $row[$time],
                                    'kWh' => $row[$wattsHour],
                                )
            ),
    $time = date('Y-m-d H:i:s', strtotime($time.'+1 minute'));


}

header('Content-Type: application/json');
echo json_encode($jsonArray, JSON_PRETTY_PRINT);

// $json_decode = json_decode($jsonArray);

$sqlQuery = "INSERT INTO testtabell (data) VALUES ('$json_decode')";

try {
  // check if error occured
  $ret = pg_query($dbconn, $sqlQuery);
  if(!$ret) {
    echo pg_last_error($dbconn);
  } else {
    echo "<span style='background-color: #4CAF50'>The insert was successfully</span><br><br>";
  }

} catch (PDOException $e) {
  echo "<span style='background-color: #f44336'>An error occured</span>";
}


?>
