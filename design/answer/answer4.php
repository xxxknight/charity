<?php
include '../database.php';
include 'answer.fuc.php';

$type = isset ( $_POST ['type'] ) == 1 ? $_POST ['type'] : "";
$question = isset ( $_POST ['question'] ) == 1 ? $_POST ['question'] : "";
$sex = isset ( $_POST ['sex'] ) == 1 ? $_POST ['sex'] : "";
$country = isset ( $_POST ['country'] ) == 1 ? $_POST ['country'] : "";
$state = isset ( $_POST ['state'] ) == 1 ? $_POST ['state'] : "";
$user = isset ( $_POST ['user'] ) == 1 ? $_POST ['user'] : "";
$startMonth = isset ( $_POST ['startMonth'] ) == 1 ? $_POST ['startMonth'] : "";
$endMonth = isset ( $_POST ['endMonth'] ) == 1 ? $_POST ['endMonth'] : "";
$beforeMonth = isset ( $_POST ['beforeMonth'] ) == 1 ? $_POST ['beforeMonth'] : "";
$afterMonth = isset ( $_POST ['afterMonth'] ) == 1 ? $_POST ['afterMonth'] : "";
$onMonth = isset ( $_POST ['onMonth'] ) == 1 ? $_POST ['onMonth'] : "";

$confirmFlag = isset ( $_POST ['confirmFlag'] ) == 1 ? $_POST ['confirmFlag'] : "";
$confirmStartMonth = isset ( $_POST ['confirmStartMonth'] ) == 1 ? $_POST ['confirmStartMonth'] : "";
$confirmEndMonth = isset ( $_POST ['confirmEndMonth'] ) == 1 ? $_POST ['confirmEndMonth'] : "";

$ftFlag = isset ( $_POST ['ftFlag'] ) == 1 ? $_POST ['ftFlag'] : "";
$ftStartMonth = isset ( $_POST ['ftStartMonth'] ) == 1 ? $_POST ['ftStartMonth'] : "";
$ftEndMonth = isset ( $_POST ['ftEndMonth'] ) == 1 ? $_POST ['ftEndMonth'] : "";

$sql = "";
$where = ' where 1=1 ';

$count_all = 0;
if ($type == "Proportion") {
	if ($question == "attend") {
		$count_all = countAction ();
		$sql = "select COUNT(userid) FROM action as a,userinfo as u ";
		$where.=" and u.Id = a.userid ";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setCondition ( $where, $sex, $state, $country );
		}
		if (hasTime ( $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth )) {
			$where = setInsertTime ( $where, $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth );
		}
		if (hasUser ( $user )) {
			$where = setUser ( $where, $user );
		}
		if (hasFtFlag ( $ftFlag )) {
			$where = setFtFlag ( $where, $ftStartMonth, $ftEndMonth );
		}
		if (hasConfirmFlag ( $confirmFlag )) {
			$where = setConfirmFlag ( $where, $confirmStartMonth, $confirmEndMonth );
		}
	} else if ($question == "confirmed") {
		$count_all = countUserinfo ();
		$sql = "select COUNT(Id) from userinfo";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setCondition ( $where, $sex, $state, $country );
		}
		if (hasTime ( $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth )) {
			$where = setconfirmedTime ( $where, $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth );
		}
	} else if ($question == "alteredname") {
		$count_all = countUserinfo ();
		$sql = "SELECT COUNT(Id) FROM userinfo ";
		$where .= " and altername is not null and ltrim(altername) <> ' ' ";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setCondition ( $where, $sex, $state, $country );
		}
	} else if ($question == "firsttimeuser") {
		$count_all = countAction ();
		$sql = "select insertmonth, COUNT(insertmonth) from action ";
		$where .= " and isfirst = 'T' ";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setFirstCondition ( $where, $sex, $state, $country );
		}
		if (hasTime ( $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth )) {
			$where = setInsertTime ( $where, $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth );
		}
		if (hasUser ( $user )) {
			$where = setUser ( $where, $user );
		}
	}
} else {
	echo "something wrong happens";
	exit ();
}

$sql = $sql . $where;
// echo $sql;

$query = mysql_query ( $sql );
$rs = mysql_fetch_array ( $query );
$count_target = $rs [0];
$count_rest = $count_all - $count_target;
$result = "[{value:'" . $count_target . "', name:'target'},{value:'" . $count_rest . "',name:'rest'},]";
echo json_encode ( $result );
?>