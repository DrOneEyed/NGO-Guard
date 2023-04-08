<?php
	include 'database_conn.php';
    include 'tot_fund.php';
	if ($_SERVER['REQUEST_METHOD']=='POST')
	{
		while($row = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" . $row['DATE_OF_TXN'] . "</td>";
		echo "<td>" . $row['LOCATION'] . "</td>";
		echo "<td>" . $row['AMOUNT'] . "</td>";
		echo "</tr>";
		}
	}
?>