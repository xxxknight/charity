<?php

include 'database.php';

$Id = $_POST ['Id'];
$resultQ = "";
if (is_array ( $Id )) {
	$str = implode ( ",", $Id );
	$query = "delete from solicitor where Id in ( " . $str . " )";
	$resultQ = mysql_query ( $query );
} else {
	$query = "delete from solicitor where Id = " . $Id;
	$resultQ = mysql_query ( $query );
}

if ($resultQ) {
	echo 1;
} else {
	echo 0;
}

?>