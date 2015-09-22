<?php
include 'database.php';
// $Id = isset ( $_POST ['Id'] ) == 1 ? $_POST ['Id'] : "";
$firstname = isset ( $_POST ['firstname'] ) == 1 ? $_POST ['firstname'] : "";
$lastname = isset ( $_POST ['lastname'] ) == 1 ? $_POST ['lastname'] : "";
$sex = isset ( $_POST ['sex'] ) == 1 ? $_POST ['sex'] : "";


$insertSql = "insert into solicitor (name,address,telenumber) " . "values('" . $firstname . "','" . $lastname . "','" . $sex . "')";
$result = mysql_query ( $insertSql );
//echo $insertSql;
if ($result) {
	echo 1;
} else {
	echo 0;
}

?>