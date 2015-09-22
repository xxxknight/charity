<?php
include 'database.php';

$Id = isset ( $_POST ['Id'] ) == 1 ? $_POST ['Id'] : "";
$firstname = isset ( $_POST ['firstname'] ) == 1 ? $_POST ['firstname'] : "";
$lastname = isset ( $_POST ['lastname'] ) == 1 ? $_POST ['lastname'] : "";
$sex = isset ( $_POST ['sex'] ) == 1 ? $_POST ['sex'] : "";
$birth = isset ( $_POST ['birth'] ) == 1 ? $_POST ['birth'] : "";
$country = isset ( $_POST ['country'] ) == 1 ? $_POST ['country'] : "";
$region = isset ( $_POST ['region'] ) == 1 ? $_POST ['region'] : "";
$confirmtime = isset ( $_POST ['confirmtime'] ) == 1 ? $_POST ['confirmtime'] : "";
$eligible = isset ( $_POST ['eligible'] ) == 1 ? $_POST ['eligible'] : "";
$altername = isset ( $_POST ['altername'] ) == 1 ? $_POST ['altername'] : "";
$newin = isset( $_POST ['newin'] ) == 1 ? $_POST ['newin'] : "";
$solicitorid = isset( $_POST ['solicitorid'] ) == 1 ? $_POST ['solicitorid'] : "";
$basicnote = isset ( $_POST ['basicnote'] ) == 1 ? $_POST ['basicnote'] : "";
$updateSql = "update userinfo set firstname = '" . $firstname . "' , lastname = '" . $lastname . "', sex = '" . $sex . "',birth = '" . $birth . "', country = '" . $country . "', region = '" . $region . "', confirmtime = '" . $confirmtime . "', eligible = '" . $eligible . "', altername = '" . $altername . "',newin = '" . $newin . "',solicitorid = '" . $solicitorid . "', basicnote = '" . $basicnote . "' where Id = " . $Id;
$resultQ = mysql_query ( $updateSql );
if ($resultQ) {
	echo 1;
} else {
	echo 0;
}
?>