<?php
$starttime = "10:49:53";
$endtime = "11:20:50";

$start_timestamp = strtotime($starttime);
$end_timestamp = strtotime($endtime);

$time_difference = $end_timestamp - $start_timestamp;

echo "Time difference: " . gmdate("H:i:s", $time_difference);

$start_time = explode(":",$starttime);
$end_time = explode(":",$endtime);
$hours = (int)$end_time[0]-(int)$start_time[0];
$mins = (int)$end_time[1]-(int)$start_time[1];
$sec = (int)$end_time[2]-(int)$start_time[2];

if ($mins<0){
    $mins+=60;
    $hours--;
}
if ($sec<0){
    $sec+=60;
    $mins--;
}

echo "<br>".str_pad($hours,2,"0",STR_PAD_LEFT).":".str_pad($mins,2,"0",STR_PAD_LEFT).":".str_pad($sec,2,"0",STR_PAD_LEFT);
?>
