<?php
include '../database.php';
include 'answer.fuc.php';

$type = isset ( $_POST ['type'] ) == 1 ? $_POST ['type'] : "";
$question = isset ( $_POST ['question'] ) == 1 ? $_POST ['question'] : "";
$sex = isset ( $_POST ['sex'] ) == 1 ? $_POST ['sex'] : "";
$country = isset ( $_POST ['country'] ) == 1 ? $_POST ['country'] : "";
$state = isset ( $_POST ['state'] ) == 1 ? $_POST ['state'] : "";
$user = isset ( $_POST ['user'] ) == 1 ? $_POST ['user'] : "";
$timeGroup1 = isset ( $_POST ['timeGroup1'] ) == 1 ? $_POST ['timeGroup1'] : "";  //这个是从click.js里面传过来的
$timeGroup2 = isset ( $_POST ['timeGroup2'] ) == 1 ? $_POST ['timeGroup2'] : "";

$confirmFlag = isset ( $_POST ['confirmFlag'] ) == 1 ? $_POST ['confirmFlag'] : "";
$confirmStartMonth = isset ( $_POST ['confirmStartMonth'] ) == 1 ? $_POST ['confirmStartMonth'] : "";
$confirmEndMonth = isset ( $_POST ['confirmEndMonth'] ) == 1 ? $_POST ['confirmEndMonth'] : "";

$ftFlag = isset ( $_POST ['ftFlag'] ) == 1 ? $_POST ['ftFlag'] : "";
$ftStartMonth = isset ( $_POST ['ftStartMonth'] ) == 1 ? $_POST ['ftStartMonth'] : "";
$ftEndMonth = isset ( $_POST ['ftEndMonth'] ) == 1 ? $_POST ['ftEndMonth'] : "";

$count_group = 0;
if ($timeGroup1 != "") {
	$count_group = count ( $timeGroup1 );
}

$sum = Array ();
// print_r ( $timeGroup1 );
// print_r ( $timeGroup2 );
$sql = "";
$where = ' where 1=1 ';

if ($type == "Compare") {
	if ($question == "attend") {
		$sql = "select COUNT(userid) FROM action as a,userinfo as u ";
		$where.=" and u.Id = a.userid ";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setCondition ( $where, $sex, $state, $country );
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
		
		for($i = 0; $i < $count_group; $i ++) {
			if (hasTimeGroup ( $timeGroup1 [$i] )) {
				$where1 = setInsertTimeGroup1 ( $where, $timeGroup1 [$i] );
			} else {
				$where1 = $where;
			}
			if (hasTimeGroup ( $timeGroup2 [$i] )) {
				$where2 = setInsertTimeGroup2 ( $where1, $timeGroup2 [$i] );
			} else {
				$where2 = $where1;
			}
			$dump_sql = $sql . $where2;
			$sum [] = countNum ( $dump_sql );
		}
	} else if ($question == "confirmed") {
		$sql = "select COUNT(Id) from userinfo";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setCondition ( $where, $sex, $state, $country );
		}
		for($i = 0; $i < $count_group; $i ++) {
			if (hasTimeGroup ( $timeGroup1 [$i] )) {
				$where1 = setConfirmTimeGroup1 ( $where, $timeGroup1 [$i] );
			} else {
				$where1 = $where;
			}
			if (hasTimeGroup ( $timeGroup2 [$i] )) {
				$where2 = setConfirmTimeGroup2 ( $where1, $timeGroup2 [$i] );
			} else {
				$where2 = $where1;
			}
			$dump_sql = $sql . $where2;
			$sum [] = countNum ( $dump_sql );
		}
	} else if ($question == "firsttimeuser") {
		$sql = "select COUNT(id) from action ";
		$where .= " and isfirst = 'T' ";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setFirstCondition ( $where, $sex, $state, $country );
		}
		if (hasUser ( $user )) {
			$where = setUser ( $where, $user );
		}
		for($i = 0; $i < $count_group; $i ++) {
			if (hasTimeGroup ( $timeGroup1 [$i] )) {
				$where1 = setInsertTimeGroup1 ( $where, $timeGroup1 [$i] );
			} else {
				$where1 = $where;
			}
			if (hasTimeGroup ( $timeGroup2 [$i] )) {
				$where2 = setInsertTimeGroup2 ( $where1, $timeGroup2 [$i] );
			} else {
				$where2 = $where1;
			}
			$dump_sql = $sql . $where2;
			$sum [] = countNum ( $dump_sql );
		}
	}
} else {
	echo "something wrong happens";
	exit ();
}
$combineTime = Array ();
for($i = 0; $i < $count_group; $i ++) {
	$combineTime [$i] = $timeGroup1 [$i] . "~" . $timeGroup2 [$i];
}
$arr_multiple = Array ();
for($i = 0; $i < $count_group - 1; $i ++) {
	$arr_multiple [] = $sum [0] == 0 ? "No comparison" : sprintf ( "%.2f", $sum [$i + 1] / $sum [0] );
}

$arr_all = Array ();
$arr_all [0] = $combineTime;
$arr_all [1] = $sum;
$arr_all [2] = $arr_multiple;

print_r ( json_encode ( $arr_all ) );
function hasTimeGroup($timeGroup) {
	if ($timeGroup == "" || $timeGroup == null || $timeGroup == "undefined") {
		return false;
	} else {
		return true;
	}
}
function setInsertTimeGroup1($w, $timeGroup1) {
	$where = $w . " and insertmonth>='" . $timeGroup1 . "'";
	return $where;
}
function setInsertTimeGroup2($w, $timeGroup2) {
	$where = $w . " and insertmonth<='" . $timeGroup2 . "'";
	return $where;
}
function setConfirmTimeGroup1($w, $timeGroup1) {
	$timeGroup1 .= "-01";
	$where = $w . " and confirmtime>='" . $timeGroup1 . "'";
	return $where;
}
function setConfirmTimeGroup2($w, $timeGroup2) {
	$timeGroup2 .= "-31";
	$where = $w . " and confirmtime<='" . $timeGroup2 . "'";
	return $where;
}

?>