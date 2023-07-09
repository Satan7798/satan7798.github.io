<?php
/*
Name       : RD DIVISION 
Description: HTML HEAD
Version    : 1.0
Released   : home.php
DESCRIPTION : HOme page after login.
: can move to city feedback form & centre feedback form
: if failed move to index.php
*/

echo '<style>
@media print{
body *{
	display:none;
}
#CandidateList, #CandidateList *{
	display:block;
}
}
</style>';


session_start();
if (!isset($_SESSION['City'])) {
	echo "session not set, Go to login Page";
	header("Location: index.php");
} else {
	require_once("lib/config.inc.php");
	//theme_tiltle('Feedback','');
	include("html_head.php");
	html_header('Home Page');

	include("_menu_bar.php");
	theme_header('home_page');
	$table = 'schedule'; //default

	// Create connection
	$conn = new mysqli("localhost", $cfg["user"], $cfg["passwd"], $cfg["DB"]);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		$sql = "SELECT DISTINCT board from schedule";
		//echo $sql;
		$result = $conn->query($sql);


		echo 'Select Board scheduled on ' . $_SESSION['Date'] . '
                    <select name="board_list" id="board_list">
					<option value="0">Select Board</option>';
		foreach ($result as $board) {

			echo '<option value = "' . $board['board'] . '">' . $board['board'] . '</option>';
		}
		$conn->close();
		//	$ip=getIPAddress();			
		echo '</select>

		Select Board date <select class="board_date" id="board_date">
		<option value = "0">Select Date</option>
		</select>
					</div>	
		<div class="CandidateList" id="CandidateList">
		</div>	';
	}


	echo '
	</body>';
	include("html_footer.php");
}
/* End of file*/