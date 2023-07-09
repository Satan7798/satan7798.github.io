<<?php

if (isset($_GET['customer_id'])) {
	$board = $_GET['customer_id'];
	require_once("lib/config.inc.php");

	// Create connection
	$conn = new mysqli("localhost", $cfg["user"], $cfg["passwd"], $cfg["DB"]);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		$sql = "SELECT DISTINCT AssessmentDate from schedule WHERE Board LIKE '".$board."'";
		//echo $sql;
		$rs = $conn->query($sql);
		$output = '';
		$output .= '<option value="0">Select Date</option>';
		foreach ($rs as $date) {
			$optionVal = $date['AssessmentDate'].":".$board;
			$output .= '<option value = "' . $optionVal . '">' . $date['AssessmentDate'] . '</option>';
		}
		$output .= '';
		
		echo $output;

		$rs->close();

		$conn->close();
	}
}
?>