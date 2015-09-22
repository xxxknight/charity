<?php

include 'database.php';

$Id = isset ( $_POST ['Id'] ) == 1 ? $_POST ['Id'] : "";
$firstname = isset ( $_POST ['firstname'] ) == 1 ? $_POST ['firstname'] : "";
$lastname = isset ( $_POST ['lastname'] ) == 1 ? $_POST ['lastname'] : "";
$sex = isset ( $_POST ['sex'] ) == 1 ? $_POST ['sex'] : "";


$updateSql = "update solicitor set name = '" . $firstname . "' , address = '" . $lastname . "', telenumber = '" . $sex . "' where Id = " . $Id;
$resultQ = mysql_query ( $updateSql );
if ($resultQ) {
	echo 1;
} else {
	echo 0;
}
?>