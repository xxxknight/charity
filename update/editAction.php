<?php
include 'database.php';

$id = isset ( $_POST ['id'] ) == 1 ? $_POST ['id'] : "";
$userid = isset ( $_POST ['userid'] ) == 1 ? $_POST ['userid'] : "";
$flag = isset ( $_POST ['flag'] ) == 1 ? $_POST ['flag'] : "";
$insertmonth = isset ( $_POST ['insertmonth'] ) == 1 ? $_POST ['insertmonth'] : "";
$isfirst = isset ( $_POST ['isfirst'] ) == 1 ? $_POST ['isfirst'] : "";

$updateSql = "update action set userid = '" . $userid . "' , flag = '" . $flag . "', insertmonth = '" . $insertmonth . "',isfirst = '" . $isfirst . "' where id = " . $id;
$resultQ = mysql_query ( $updateSql );
if ($resultQ) {
	echo 1;
} else {
	echo 0;
}
?>