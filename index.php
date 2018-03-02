<?php
$dbusername = '';
$dbpass = '';

try{
	$pdo = new PDO('pqsql:host=localhost;dbname=test1', $dbusername, $dbpass);
	
	$sqlquery = "SELECT * FROM test1";
	foreach($pdo)->query(sqlquery) as $row) {
		echo $row[0], ': *, $row[1],j '<br>';
	}
	$pdo = null;
} catch (PDOException $e) {
	echo "Error!: ", $e->getMessage(), '<br>';
	die();
}
?>
<html>
<body>
test
</body>
</html>