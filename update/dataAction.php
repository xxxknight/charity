<?php
error_reporting(0);
include 'database.php';

$output = array(
		"aaData" => array()
);

$sql = "select * from action";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result)) {
	$row = array(
			"id" => $row['id'],
			"userid" => $row['userid'],
			"flag" => $row['flag'],
			"insertmonth" => $row['insertmonth'],
			"isfirst" => $row['isfirst'],
	);
	$output['aaData'][] = $row;
}
mysql_close();
echo json_encode( $output );


?>
 
