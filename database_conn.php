<?php
	if ($_SERVER['REQUEST_METHOD']=='POST')
	{
		$id = $_POST['ngo_id'];
	    $conn = mysqli_connect("localhost", "root", "", "ngo guard");
		if($conn===false)
		{
			die("ERROR: Could Not Connect To DB" . mysqli_connect_error());
		}
		$sql1= "SELECT * FROM ngo_details WHERE NGO_ID = '$id'";
		$result = mysqli_query($conn, $sql1);
		$check = mysqli_fetch_array($result);
	}
?>