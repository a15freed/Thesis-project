<html>
<head>
</head>
<body>
<h3>Listing the contents in database</h3>
<?php
	// this will include the file dbconnect.php which contains credentials
	include "dbconnect.php";

	$result = pg_query($dbconn,"SELECT * FROM testtabell");
	echo "<table>";
	echo "<th>ID</th><th>DATA</th>";
	while($row=pg_fetch_assoc($result)){
		echo "<tr>";
		echo "<td align='center' width='200'>" . $row['id'] . "</td>";
		echo "<td align='center' width='200'>" . $row['data'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
?>
</div>
</body>
</html>
