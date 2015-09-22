<?php
include '../database.php';
include 'answer.fuc.php';

$type = isset ( $_POST ['type'] ) == 1 ? $_POST ['type'] : "";
$question = isset ( $_POST ['question'] ) == 1 ? $_POST ['question'] : "";
$sex = isset ( $_POST ['sex'] ) == 1 ? $_POST ['sex'] : "";
$country = isset ( $_POST ['country'] ) == 1 ? $_POST ['country'] : "";
$state = isset ( $_POST ['state'] ) == 1 ? $_POST ['state'] : "";
$frequency = isset ( $_POST ['frequency'] ) == 1 ? $_POST ['frequency'] : "";
$times = isset ( $_POST ['times'] ) == 1 ? $_POST ['times'] : "";
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

$where = ' where 1=1 ';
if ($type == "How many") {
	if ($question == "attend") {
		if (hasFrequency ( $frequency, $times )) {
			$sql1 = "select a.userid,u.firstname,u.lastname,a.flag,a.isfirst,a.insertmonth,u.sex,u.country,u.confirmtime,u.altername from userinfo as u ,action as a, (SELECT userid from action";
			$sql2 = "select count(distinct(a.userid)) from userinfo as u ,action as a, (SELECT userid from action";
			if (hasTime ( $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth )) {
				$where = setInsertTime ( $where, $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth );
			}
			if (hasUser ( $user )) {
				$where = setUser ( $where, $user );
			}
			if (hasFtFlag ( $ftFlag )) {
				$where = setFtFlag ( $where, $ftStartMonth, $ftEndMonth );
			}
			$where = setFrequency ( $where, $frequency, $times );
			if (hasCondition ( $sex, $state, $country )) {
				$where = setCondition ( $where, $sex, $state, $country );
			}
			if (hasConfirmFlag ( $confirmFlag )) {
				$where = setConfirmFlag ( $where, $confirmStartMonth, $confirmEndMonth );
			}
		} else {
			$sql1 = "select a.userid,u.firstname,u.lastname,a.flag,a.isfirst,a.insertmonth,u.sex,u.country,u.confirmtime,u.altername from userinfo as u ,action as a ";
			$sql2 = "select count(distinct(a.userid)) from userinfo as u ,action as a ";
			$where = " where u.Id=a.userid ";
			if (hasCondition ( $sex, $state, $country )) {
				$where = setCondition ( $where, $sex, $state, $country );
			}
			if (hasConfirmFlag ( $confirmFlag )) {
				$where = setConfirmFlag ( $where, $confirmStartMonth, $confirmEndMonth );
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
		}
	} else if ($question == "confirmed") {
		$sql1 = "select a.userid,u.firstname,u.lastname,a.flag,a.isfirst,a.insertmonth,u.sex,u.country,u.confirmtime,u.altername from userinfo as u ,action as a ";
		$sql2 = "select count(distinct(a.userid)) from userinfo as u ,action as a ";
		$where = " where u.Id=a.userid ";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setCondition ( $where, $sex, $state, $country );
		}
		if (hasTime ( $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth )) {
			$where = setconfirmedTime ( $where, $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth );
		}
		if (hasUser ( $user )) {
			$where = setUser ( $where, $user );
		}
	} else if ($question == "alteredname") {
		$sql1 = "select a.userid,u.firstname,u.lastname,a.flag,a.isfirst,a.insertmonth,u.sex,u.country,u.confirmtime,u.altername from userinfo as u ,action as a ";
		$sql2 = "select count(distinct(a.userid)) from userinfo as u ,action as a ";
		$where = " where u.Id=a.userid ";
		$where .= " and altername is not null and ltrim(altername) <> '' ";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setCondition ( $where, $sex, $state, $country );
		}
		if (hasUser ( $user )) {
			$where = setUser ( $where, $user );
		}
	} else if ($question == "firsttimeuser") {
		$sql1 = "select a.userid,u.firstname,u.lastname,a.flag,a.isfirst,a.insertmonth,u.sex,u.country,u.confirmtime,u.altername from userinfo as u ,action as a ";
		$sql2 = "select count(distinct(a.userid)) from userinfo as u ,action as a ";
		$where = " where u.Id=a.userid ";
		$where .= " and isfirst = 'T' ";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setCondition ( $where, $sex, $state, $country );
		}
		if (hasTime ( $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth )) {
			$where = setInsertTime ( $where, $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth );
		}
		if (hasUser ( $user )) {
			$where = setUser ( $where, $user );
		}
	} else {
		echo "something wrong happens";
		exit ();
	}
} else {
	echo "something wrong happens";
	exit ();
}

$sql1 = $sql1 . $where;
$sql2 = $sql2 . $where;
// echo $sql1;
// echo PHP_EOL;
// echo $sql2;
// echo PHP_EOL;

$arr = createArr ( $sql1 );
$count_distinct = countNum ( $sql2 );
$result = Array (
		"count_distinct" => $count_distinct,
		"arr" => $arr 
);
print_r ( json_encode ( $result ) );
?>