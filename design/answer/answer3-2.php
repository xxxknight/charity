<?php
include '../database.php';
include 'answer.fuc.php';

$type = isset ( $_POST ['type'] ) == 1 ? $_POST ['type'] : "";
$question = isset ( $_POST ['question'] ) == 1 ? $_POST ['question'] : "";
$sex = isset ( $_POST ['sex'] ) == 1 ? $_POST ['sex'] : "";
$country = isset ( $_POST ['country'] ) == 1 ? $_POST ['country'] : "";
$state = isset ( $_POST ['state'] ) == 1 ? $_POST ['state'] : "";
$user = isset ( $_POST ['user'] ) == 1 ? $_POST ['user'] : "";
$dump_sex = isset ( $_POST ['dump_sex'] ) == 1 ? $_POST ['dump_sex'] : "";
$dump_country = isset ( $_POST ['dump_country'] ) == 1 ? $_POST ['dump_country'] : "";
$dump_state = isset ( $_POST ['dump_state'] ) == 1 ? $_POST ['dump_state'] : "";
$dump_user = isset ( $_POST ['dump_user'] ) == 1 ? $_POST ['dump_user'] : "";

$fromTime = isset ( $_POST ['fromTime'] ) == 1 ? $_POST ['fromTime'] : "";
$toTime = isset ( $_POST ['toTime'] ) == 1 ? $_POST ['toTime'] : "";

$confirmFlag = isset ( $_POST ['confirmFlag'] ) == 1 ? $_POST ['confirmFlag'] : "";
$confirmStartMonth = isset ( $_POST ['confirmStartMonth'] ) == 1 ? $_POST ['confirmStartMonth'] : "";
$confirmEndMonth = isset ( $_POST ['confirmEndMonth'] ) == 1 ? $_POST ['confirmEndMonth'] : "";

$ftFlag = isset ( $_POST ['ftFlag'] ) == 1 ? $_POST ['ftFlag'] : "";
$ftStartMonth = isset ( $_POST ['ftStartMonth'] ) == 1 ? $_POST ['ftStartMonth'] : "";
$ftEndMonth = isset ( $_POST ['ftEndMonth'] ) == 1 ? $_POST ['ftEndMonth'] : "";

$sql = "";
$sql1 = "";
$sql2 = "";
$sum = Array ();
$where1 = ' where 1=1 ';
$where2 = ' where 1=1 ';

if ($type == "Compare") {
	if ($question == "attend") {
		$sql = "select COUNT(userid) FROM action as a,userinfo as u ";
		$where1.=" and u.Id = a.userid ";
		if (hasCondition ( $sex, $state, $country )) {
			$where1 = setCondition ( $where1, $sex, $state, $country );
		}
		if (hasUser ( $user )) {
			$where1 = setUser ( $where1, $user );
		}
		if (setInsertTime1 ( $fromTime, $toTime )) {
			$where1 = getInsertTime1 ( $where1, $fromTime, $toTime );
		}
		if (hasFtFlag ( $ftFlag )) {
			$where1 = setFtFlag ( $where1, $ftStartMonth, $ftEndMonth );
		}
		if (hasConfirmFlag ( $confirmFlag )) {
			$where1 = setConfirmFlag ( $where1, $confirmStartMonth, $confirmEndMonth );
		}
		$where2.=" and u.Id = a.userid ";
		if (hasCondition ( $dump_sex, $dump_state, $dump_country )) {
			$where2 = setCondition ( $where2, $dump_sex, $dump_state, $dump_country );
		}
		if (hasUser ( $dump_user )) {
			$where2 = setUser ( $where2, $dump_user );
		}
		if (setInsertTime1 ( $fromTime, $toTime )) {
			$where2 = getInsertTime1 ( $where2, $fromTime, $toTime );
		}
		if (hasFtFlag ( $ftFlag )) {
			$where2 = setFtFlag ( $where2, $ftStartMonth, $ftEndMonth );
		}
		if (hasConfirmFlag ( $confirmFlag )) {
			$where2 = setConfirmFlag ( $where2, $confirmStartMonth, $confirmEndMonth );
		}
	} else if ($question == "confirmed") {
		$sql = "select COUNT(Id) from userinfo";
		if (hasCondition ( $sex, $state, $country )) {
			$where1 = setCondition ( $where1, $sex, $state, $country );
		}
		if (setTime ( $fromTime, $toTime )) {
			$where1 = getTime ( $where1, $fromTime, $toTime );
		}
		
		if (hasCondition ( $dump_sex, $dump_state, $dump_country )) {
			$where2 = setCondition ( $where2, $dump_sex, $dump_state, $dump_country );
		}
		if (setTime ( $fromTime, $toTime )) {
			$where2 = getTime ( $where2, $fromTime, $toTime );
		}
	} else if ($question == "firsttimeuser") {
		$sql = "select COUNT(id) from action ";
		$where1 .= " and isfirst = 'T' ";
		$where2 .= " and isfirst = 'T' ";
		if (hasCondition ( $sex, $state, $country )) {
			$where1 = setFirstCondition ( $where1, $sex, $state, $country );
		}
		if (hasUser ( $user )) {
			$where1 = setUser ( $where1, $user );
		}
		if (setInsertTime1 ( $fromTime, $toTime )) {
			$where1 = getInsertTime1 ( $where1, $fromTime, $toTime );
		}
		
		if (hasCondition ( $dump_sex, $dump_state, $dump_country )) {
			$where2 = setFirstCondition ( $where2, $dump_sex, $dump_state, $dump_country );
		}
		if (hasUser ( $dump_user )) {
			$where2 = setUser ( $where2, $dump_user );
		}
		if (setInsertTime1 ( $fromTime, $toTime )) {
			$where2 = getInsertTime1 ( $where2, $fromTime, $toTime );
		}
	}
} else {
	echo "something wrong happens";
	exit ();
}
$sql1 = $sql . $where1;
$sql2 = $sql . $where2;
$sum [0] = countNum ( $sql1 );
$sum [1] = countNum ( $sql2 );
$arr_multiple = Array ();
$arr_multiple [0] = $sum [0] == 0 ? "No comparison" : sprintf ( "%.2f", $sum [1] / $sum [0] );

$arr_all = Array ();
$arr_all [0] = $sum;
$arr_all [1] = $arr_multiple;

print_r ( json_encode ( $arr_all ) );

function setInsertTime1($startTime, $endTime) {
	if ($startTime == "" && $endTime == "") {
		return false;
	} else {
		return true;
	}
}
function getInsertTime1($where, $startTime, $endTime) {
	if ($startTime != "") {
		$where .= " and insertmonth>='" . $startTime . "'";
	}
	if ($endTime != "") {
		$where .= " and insertmonth<='" . $endTime . "'";
	}
	return $where;
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
?>