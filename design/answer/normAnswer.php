<?php
include '../database.php';

$flag = isset ( $_POST ['flag'] ) == 1 ? $_POST ['flag'] : 0;
$startTime = isset ( $_POST ['startTime'] ) == 1 ? $_POST ['startTime'] : "";
$endTime = isset ( $_POST ['endTime'] ) == 1 ? $_POST ['endTime'] : "";

$where = ' where 1=1 ';

if ($flag == "f1") {
	$sql = "select country,count(country) from userinfo ";
	if (setTime ( $startTime, $endTime )) {
		$where = getTime ( $where, $startTime, $endTime );
	}
	$where .= " group by country";
	$sql .= $where;
	
	$country = array ();
	$num = array ();
	$sum = array ();
	$query = mysql_query ( $sql );
	while ( $rs = mysql_fetch_array ( $query ) ) {
		if ($rs [0] != null) {
			$country [] = $rs [0];
			$num [] = $rs [1];
		}
	}
	$sum [0] = $country;
	$sum [1] = $num;
	
	$json_sum = json_encode ( $sum );
	print_r ( $json_sum );
} else if ($flag == "f2") {
	$sql = "select region,count(region) from userinfo ";
	if (setTime ( $startTime, $endTime )) {
		$where = getTime ( $where, $startTime, $endTime );
	}
	$where .= " group by region";
	$sql .= $where;
	$region = array ();
	$num = array ();
	$sum = array ();
	$query = mysql_query ( $sql );
	while ( $rs = mysql_fetch_array ( $query ) ) {
		if ($rs [0] != null) {
			$region [] = $rs [0];
			$num [] = $rs [1];
		}
	}
	$sum [0] = $region;
	$sum [1] = $num;
	
	$json_sum = json_encode ( $sum );
	print_r ( $json_sum );
} else if ($flag == "f3") {
	$numAge = Array ();
	for($i = 195; $i <= 200; $i ++) {
		$where_dump = ' where 1=1 ';
		$sql = "select count(Id) from userinfo ";
		if (setTime ( $startTime, $endTime )) {
			$where_dump = getTime ( $where_dump, $startTime, $endTime );
		}
		$where_dump .= " and birth LIKE '" . $i . "%'";
		$sql .= $where_dump;
		$query = mysql_query ( $sql );
		$rs = mysql_fetch_array ( $query );
		if ($rs [0] != null) {
			$numAge [] = $rs [0];
		}
	}
	
	$where_all = ' where 1=1 ';
	$sql5 = "select count(Id) from userinfo ";
	if (setTime ( $startTime, $endTime )) {
		$where_all = getTime ( $where_all, $startTime, $endTime );
	}
	$sql5 .= $where_all;
	$query5 = mysql_query ( $sql5 );
	$rs5 = mysql_fetch_array ( $query5 );
	if ($rs5 [0] != null) {
		$sum = array_sum ( $numAge );
		$numAge [] = $rs5 [0] - $sum;
	}
	$json_numAge = json_encode ( $numAge );
	print_r ( $json_numAge );
} else if ($flag == "f4") {
	$sql2 = "select COUNT(Id) from userinfo ";
	$where_2 = " where sex ='M' ";
	if (setTime ( $startTime, $endTime )) {
		$where_2 = getTime ( $where_2, $startTime, $endTime );
	}
	$sql2 .= $where_2;
	$query2 = mysql_query ( $sql2 );
	$rs2 = mysql_fetch_array ( $query2 );
	if ($rs2) {
		$countM = $rs2 [0];
	} else {
		$countM = 0;
	}
	
	$sql3 = "select COUNT(Id) from userinfo ";
	$where_3 = " where sex ='F' ";
	if (setTime ( $startTime, $endTime )) {
		$where_3 = getTime ( $where_3, $startTime, $endTime );
	}
	$sql3 .= $where_3;
	$query3 = mysql_query ( $sql3 );
	$rs3 = mysql_fetch_array ( $query3 );
	if ($rs3) {
		$countF = $rs3 [0];
	} else {
		$countF = 0;
	}
	
	$sex = "[{value:'" . $countM . "', name:'male'},{value:'" . $countF . "',name:'female'},]";
	$json_sex = json_encode ( $sex );
	echo $json_sex;
} else if ($flag == "f5") {
	$month = array();
	$countMonth = array();
	$sum = array();
	$sql = "select insertmonth,count(insertmonth) from action";
	if (setInsertTime($startTime, $endTime)) {
		$where = getInsertTime($where, $startTime, $endTime);
	}
	$where.=" group by insertmonth ";
	
	$sql.=$where;
	$query = mysql_query ( $sql);
	while ( $rs = mysql_fetch_array ( $query ) ) {
		if ($rs [0] != null) {
			$month [] = $rs [0];
			$countMonth [] = $rs [1];
		}
	}
	$sum [0] = $month;
	$sum [1] = $countMonth;
	
	$json_sum = json_encode ( $sum );
	print_r ( $json_sum );
}
function setTime($startTime, $endTime) {
	if ($startTime == "" && $endTime == "") {
		return false;
	} else {
		return true;
	}
}
function getTime($where, $startTime, $endTime) {
	if ($startTime != "") {
		$startTime .= "-01";
		$where .= " and confirmtime>='" . $startTime . "'";
	}
	if ($endTime != "") {
		$endTime .= "-31";
		$where .= " and confirmtime<='" . $endTime . "'";
	}
	return $where;
}
function setInsertTime($startTime, $endTime) {
	if ($startTime == "" && $endTime == "") {
		return false;
	} else {
		return true;
	}
}
function getInsertTime($where, $startTime, $endTime) {
	if ($startTime != "") {
		$where .= " and insertmonth>='" . $startTime . "'";
	}
	if ($endTime != "") {
		$where .= " and insertmonth<='" . $endTime . "'";
	}
	return $where;
}

?>