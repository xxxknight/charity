<?php
error_reporting(0);
include 'database.php';

$output = array(
		"aaData" => array()
);

$sql = "select * from userinfo";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result)) {
	$row = array(
			"Id" => $row['Id'],
			"firstname" => $row['firstname'],
			"lastname" => $row['lastname'],
			"sex" => $row['sex'],
			"birth" => $row['birth'],
			"country" => $row['country'],
			"region" => $row['region'],
			"eligible"=>$row['eligible'],
			"confirmtime" => $row['confirmtime'],
			"altername" => $row['altername'],
			"newin" => $row['newin'],
			"solicitorid" => $row['solicitorid'],
			"bnote" => $row['basicnote']
			
			
	);
	$output['aaData'][] = $row;
}
mysql_close();
echo json_encode( $output );


?>
 
