<?php
include '../database.php';
include 'answer.fuc.php';

$thismonth = date ( "Y-m" );
$Cmonth = isset($_GET['Cmonth'])==1?$_GET['Cmonth']:$thismonth;

$lastmonth = workOutLastMonth($Cmonth);
$last2month = workOutLastMonth($lastmonth);

$thismonthlastyear = workOutLastYear($Cmonth);
$lastmonthlastyear = workOutLastMonth($thismonthlastyear);
$last2monthlastyear = workOutLastMonth($lastmonthlastyear);

$montharr1 = Array (
		$Cmonth,
		$lastmonth,
		$last2month
);
$montharr2 = Array (
		$thismonthlastyear,
		$lastmonthlastyear,
		$last2monthlastyear
);

$sql_nc = "SELECT count(id) FROM action where isfirst = 'T' and insertmonth = '" . $Cmonth. "'";
$query_nc = mysql_query ( $sql_nc );
$rs_nc = mysql_fetch_array ( $query_nc );
$count_nc = $rs_nc [0];

$arr_T1 = Array ();
for($i=0;$i<3;$i++){
	$sql = "select count(id) from action where insertmonth = '" . $montharr1 [$i] . "'";
	$query = mysql_query ( $sql );
	$rs = mysql_fetch_array ( $query );
	$arr_T1[] = $rs [0];
}

$arr_T2 = Array ();
for($i=0;$i<3;$i++){
	$sql = "select count(id) from action where insertmonth = '" . $montharr2 [$i] . "'";
	$query = mysql_query ( $sql );
	$rs = mysql_fetch_array ( $query );
	$arr_T2[] = $rs [0];
}

$arr_M1 = Array ();
for($i=0;$i<3;$i++){
	$sql = "select count(id) from action where flag ='M' and insertMonth = '" . $montharr1 [$i] . "'";
	$query = mysql_query ( $sql );
	$rs = mysql_fetch_array ( $query );
	$arr_M1[] = $rs [0];
}

$arr_M2 = Array ();
for($i=0;$i<3;$i++){
	$sql = "select count(id) from action where flag ='M' and insertMonth = '" . $montharr2 [$i] . "'";
	$query = mysql_query ( $sql );
	$rs = mysql_fetch_array ( $query );
	$arr_M2[] = $rs [0];
}

$arr_E1=Array();
for ($i=0;$i<3;$i++){
	$sql = "select count(id) from action where flag= 'E' and insertMonth = '" .  $montharr1 [$i] . "'";
	$query = mysql_query ( $sql );
	$rs = mysql_fetch_array ( $query );
	$arr_E1[] = $rs [0];
}

$arr_E2=Array();
for ($i=0;$i<3;$i++){
	$sql = "select count(id) from action where flag= 'E' and insertMonth = '" .  $montharr2 [$i] . "'";
	$query = mysql_query ( $sql );
	$rs = mysql_fetch_array ( $query );
	$arr_E2[] = $rs [0];
}

$all = Array(
		$count_nc,
		$montharr1,
		$arr_M1,
		$arr_E1,
		$arr_T1,
		$montharr2,
		$arr_M2,
		$arr_E2,
		$arr_T2
		);

echo json_encode($all);
?>



