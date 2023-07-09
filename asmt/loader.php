<script>
	function getmethod(option, id) {
		//alert (option.value + id  );
		$.ajax({
			type: 'GET',
			url: '_changestate.php',
			data: { opt: option.value, id: id },
		});
	}
</script>
<?php

//echo 'hello';
if (isset($_GET['board_data'])) {

	$boardData = explode(':',$_GET['board_data']);
	$board = $boardData[1];
	$date = $boardData[0];
	echo '<script>
	console.log("'.$board.'\n");
	console.log("'.$date.'\n");
	</script>';
	require_once("lib/config.inc.php");

	// Create connection
	$conn = new mysqli("localhost", $cfg["user"], $cfg["passwd"], $cfg["DB"]);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		$sql = "SELECT * FROM `schedule` WHERE AssessmentDate like '".$date."' AND `Board` like '" . $board . "' order by `STATUS`";

		$rs = $conn->query($sql);

		$createTable = ' <table align="center">	<tr><td colspan="2">
	<h2 align="center" style="background-color:#9999FF; font-size:100%;">List of Employees Assessment Scheduled  </h2>
			</td>	</tr> </table> ';
		$createTable .= '<div class="table-responsive"> <table align="center" class= "table">';

		$createTable .= '<tr>';
		$createTable .= '<th>Sr No</th>';
		$createTable .= '<th>Employee Name</th>';
		//	$createTable .= '<th>Category</th>';
		$createTable .= '<th>Rank</th>';
		$createTable .= '<th>Lab</th>';
		//	$createTable .= '<th>Board</th>';
		$createTable .= '<th>Assessment Date</th>';
		$createTable .= '<th>Subject</th>';
		$createTable .= '<th>Status</th>';
		$createTable .= '</tr>';
		$i = 0;

		foreach ($rs as $candidateData) {
			$createTable .= '<tr ';
			$createTable .= ($candidateData["STATUS"] == "3" ? 'class="alert alert-danger"' : ($candidateData["STATUS"] == "1" ? 'class="alert alert-primary" ' : ($candidateData["STATUS"] == "2" ? 'class="alert alert-success" ' : ''))) . ' >';

			$createTable .= '<td>' . $candidateData['Seq'] . '</td>';
			$createTable .= '<td>' . $candidateData['EmpName'] . '</td>';
			//		$createTable .= '<td>'.$candidateData['Category'].'</td>';
			$createTable .= '<td>' . $candidateData['Rank'] . '</td>';
			$createTable .= '<td>' . $candidateData['Lab'] . '</td>';
			//		$createTable .= '<td>'.$candidateData['Board'].'</td>';
			$createTable .= '<td>'.$candidateData['AssessmentDate'].'</td>';
			$createTable .= '<td>' . $candidateData['AssessmentSubject'] . '</td>';
			$createTable .= '<td>';
			$param1 = $candidateData["ID"];
			//$param2 = $candidateData["EmpName"] ;



			//	$createTable .= '<select  id="status" onChange="getmethod(this,"'.$candidateData["Seq"].'","'.$candidateData["EmpName"].'","'.$board.'");" >';
			$createTable .= '<select  id="status" onChange="getmethod(this,' . $param1 . ');"  style="width:120px;">';
			if ($candidateData["STATUS"] == "3") {
				$createTable .= '<option value="3">Not Appearing</option>
					<option value="2">Completed</option>
					<option value="0">Waiting</option>
					<option value="1">Interview Started</option>';
			} else if ($candidateData["STATUS"] == "2") {
				$createTable .= '<option value="2">Completed</option>
					<option value="0">Waiting</option>
					<option value="1">Interview Started</option>
					<option value="3">Not Appearing</option>';
			} else if ($candidateData["STATUS"] == "1") {
				$createTable .= '<option value="1">Interview Started</option>
					<option value="0">Waiting</option>
					<option value="2">Completed</option>
					<option value="3">Not Appearing</option>';
			} else {
				$createTable .= '<option value="0">Waiting</option>
					<option value="1">Interview Started</option>
					<option value="2">Completed</option>
					<option value="3">Not Appearing</option>';
			}

			$createTable .= '</td>';




			$createTable .= '</tr>';
		}

		$createTable .= '</table></div>';

		echo $createTable;

		$rs->close();

		$conn->close();



	}
}
?>