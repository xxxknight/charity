<?php

// 该文件专门存储answer.php的函数
/*
 * 该函数为how many问题计算数值，为公用函数
 */
function countNum($sql) {
	$query = mysql_query ( $sql );
	$rs = mysql_fetch_array ( $query );
	$count = $rs [0];
	return $count;
}
function countUserinfo() {
	$sql = "select count(Id) from userinfo";
	return countNum ( $sql );
}
function countAction() {
	$sql = "select count(id) from action";
	return countNum ( $sql );
}
function createArr($sql) {
	$arr1 = Array ();
	$query = mysql_query ( $sql );
	while ( $rs = mysql_fetch_array ( $query ) ) {
		$arr1 [] = $rs;
	}
	return $arr1;
}
function hasCondition($sex, $state, $country) {
	if ($sex == "" and $state == "" and $country == "") {
		return false;
	} else {
		return true;
	}
}
function hasTime($startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth) {
	if (($startMonth == "" or $endMonth == "") and $beforeMonth == "" and $afterMonth == "" and $onMonth == "") {
		return false;
	} else {
		return true;
	}
}
function hasFrequency($frequency, $times) {
	if ($frequency == "" && $times == "") {
		return false;
	} else {
		return true;
	}
}
function hasUser($user) {
	if ($user == "") {
		return false;
	} else {
		return true;
	}
}
function setFrequency($where, $frequency, $times) {
	$where .= " GROUP BY userid HAVING COUNT(userid) ";
	if ($frequency == "more than") {
		$where .= " > " . $times;
	} else if ($frequency == "less than") {
		$where .= " < " . $times;
	} else {
		$where .= " = " . $times;
	}
	$where .= " ) b where a.userid = b.userid and a.userid = u.Id";
	return $where;
}
function setUser($where, $user) {
	if ($user == "inside") {
		$where .= " and flag='M'";
	} else if ($user == "outside") {
		$where .= " and flag='E'";
	}
	return $where;
}

/*
 * 以下函数供how many->attend模块使用
 */
function setFirstCondition($where, $sex, $state, $country) {
	$where .= " and userid in (select Id from userinfo where 1=1 ";
	if ($sex != "") {
		$where .= " and sex='" . $sex . "' ";
	}
	if ($state != "") {
		$where .= " and eligible='" . $state . "' ";
	}
	if ($country != "") {
		$where .= " and (country='" . $country [0] . "' ";
		for($i = 1; $i < count ( $country ); $i ++) {
			$where .= " or country = '" . $country [$i] . "' ";
		}
		$where .= " )";
	}
	$where .= ")";
	return $where;
}
function setCondition($where, $sex, $state, $country) {
	if ($sex != "") {
		$where .= " and sex='" . $sex . "' ";
	}
	if ($state != "") {
		$where .= " and eligible='" . $state . "' ";
	}
	if ($country != "") {
		$where .= " and (country='" . $country [0] . "' ";
		for($i = 1; $i < count ( $country ); $i ++) {
			$where .= " or country = '" . $country [$i] . "' ";
		}
		$where .= " )";
	}
	return $where;
}
function setInsertTime($where, $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth) {
	if ($startMonth != "" and $endMonth != "") {
		$where .= " and insertmonth>='" . $startMonth . "'";
		$where .= " and insertmonth<='" . $endMonth . "'";
	} else if ($beforeMonth != "") {
		$where .= " and insertmonth<='" . $beforeMonth . "'";
	} else if ($afterMonth != "") {
		$where .= " and insertmonth>='" . $afterMonth . "'";
	} else if ($onMonth != "") {
		$where .= " and insertmonth='" . $onMonth . "'";
	}
	return $where;
}

function setConfirmedTime($where, $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth) {
	if ($startMonth != "" and $endMonth != "") {
		$startMonth.="-01";
		$endMonth.="-31";
		$where .= " and confirmtime>='" . $startMonth . "'";
		$where .= " and confirmtime<='" . $endMonth . "'";
	} else if ($beforeMonth != "") {
		$beforeMonth.="-01";
		$where .= " and confirmtime<='" . $beforeMonth . "'";
	} else if ($afterMonth != "") {
		$afterMonth.="-31";
		$where .= " and confirmtime>='" . $afterMonth . "'";
	} else if ($onMonth != "") {
		$where .= " and left(confirmtime,7) ='" . $onMonth . "'";
	}
	return $where;
}
function hasConfirmFlag($confirmFlag) {
	if ($confirmFlag == "1") {
		return true;
	} else {
		return false;
	}
}

function setConfirmFlag($where, $confirmStartMonth, $confirmEndMonth) {
	if ($confirmStartMonth != "") {
		$confirmStartDay = $confirmStartMonth . "-01";
		$where .= " and confirmtime>='" . $confirmStartDay . "' ";
	}
	if ($confirmEndMonth != "") {
		$confirmEndDay = $confirmEndMonth . "-31";
		$where .= " and confirmtime<='" . $confirmEndDay . "' ";
	}
	return $where;
}

function hasFtFlag($ftFlag) {
	if ($ftFlag == "1") {
		return true;
	} else {
		return false;
	}
}

function setFtFlag($where, $ftStartMonth, $ftEndMonth) {
	if ($ftStartMonth != "") {
		$where .= " and newin>='" . $ftStartMonth . "' ";
	}
	if ($ftEndMonth != "") {
		$where .= " and newin<='" . $ftEndMonth . "' ";
	}
	return $where;
}

function workOutLastMonth($date){
	$arr = explode("-",$date);
	$year = $arr[0];
	$month = $arr[1];
	if($month == "01"){
		$year = $year-1;
		$month = "12";
	}else{
		$month = $month -1;
		if(strlen($month)==1){
			$month="0".$month;
		}
	}
	return $year."-".$month;
}

function workOutLastYear($date){
	$arr = explode("-",$date);
	$year = $arr[0];
	$month = $arr[1];
	$year = $year -1;
	return $year."-".$month;
}

?>