<?php

error_reporting(0);
include 'database.php';

$output = array(
		"aaData" => array()
);

$sql = "select * from solicitor";
$result = mysql_query($sql);


while ($row = mysql_fetch_array($result)) {
	$row = array(
			"Id" => $row['Id'],
			"firstname" => $row['name'],
			"lastname" => $row['address'],
			"sex" => $row['telenumber']
		
				
	);
	$output['aaData'][] = $row;
}
mysql_close();
echo json_encode( $output );


?>
 
