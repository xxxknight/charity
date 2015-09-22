<?php
include '../database.php';
include 'answer.fuc.php';

$type = isset($_POST ['type'])==1?$_POST ['type']:"";
$question = isset ( $_POST ['question'] ) == 1 ? $_POST ['question'] : "";
$sex = isset($_POST ['sex'])==1?$_POST ['sex']:"";
$country = isset($_POST ['country'])==1?$_POST ['country']:"";
$state = isset($_POST ['state'])==1?$_POST ['state']:"";
$user = isset($_POST ['user'])==1?$_POST ['user']:"";
$startMonth = isset($_POST ['startMonth'])==1?$_POST ['startMonth']:"";
$endMonth = isset($_POST ['endMonth'])==1?$_POST ['endMonth']:"";
$beforeMonth = isset($_POST ['beforeMonth'])==1?$_POST ['beforeMonth']:"";
$afterMonth = isset($_POST ['afterMonth'])==1?$_POST ['afterMonth']:"";
$onMonth = isset($_POST ['onMonth'])==1?$_POST ['onMonth']:"";

$confirmFlag = isset ( $_POST ['confirmFlag'] ) == 1 ? $_POST ['confirmFlag'] : "";
$confirmStartMonth = isset ( $_POST ['confirmStartMonth'] ) == 1 ? $_POST ['confirmStartMonth'] : "";
$confirmEndMonth = isset ( $_POST ['confirmEndMonth'] ) == 1 ? $_POST ['confirmEndMonth'] : "";

$ftFlag = isset ( $_POST ['ftFlag'] ) == 1 ? $_POST ['ftFlag'] : "";
$ftStartMonth = isset ( $_POST ['ftStartMonth'] ) == 1 ? $_POST ['ftStartMonth'] : "";
$ftEndMonth = isset ( $_POST ['ftEndMonth'] ) == 1 ? $_POST ['ftEndMonth'] : "";

$sql = "";
$where = ' where 1=1 ';

if($type=="Trend"){
	if($question=="attend"){
		$sql = "select insertmonth, COUNT(insertmonth) FROM action as a ,userinfo as u";
		$where.=" and u.Id = a.userid ";
		if(hasCondition($sex,$state,$country)){
			$where=setCondition($where,$sex,$state,$country);
		}
		if (hasConfirmFlag ( $confirmFlag )) {
			$where = setConfirmFlag ( $where, $confirmStartMonth, $confirmEndMonth );
		}
		if(hasTime($startMonth, $endMonth,$beforeMonth,$afterMonth,$onMonth)){
			$where=setInsertTime($where, $startMonth, $endMonth, $beforeMonth,$afterMonth,$onMonth);
		}
		if (hasFtFlag ( $ftFlag )) {
			$where = setFtFlag ( $where, $ftStartMonth, $ftEndMonth );
		}
		if(hasUser($user)){
			$where=setUser($where, $user);
		}
		$where.=" GROUP BY insertmonth";
	}else if($question=="confirmed"){
		$sql = "select left(confirmtime,7), count(left(confirmtime,7)) from userinfo";
		if (hasCondition ( $sex, $state, $country )) {
			$where = setCondition ( $where, $sex, $state, $country );
		}
		if (hasTime ( $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth )) {
			$where = setconfirmedTime ( $where, $startMonth, $endMonth, $beforeMonth, $afterMonth, $onMonth );
		}
		$where.=" GROUP BY left(confirmtime,7)";
	}else if($question == "firsttimeuser"){
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
		$where.=" GROUP BY insertmonth";
	}
}else{
	echo "something wrong happens";
	exit;
}

$sql= $sql.$where;
//echo $sql;
$result = creatTrend($sql);
print_r(json_encode($result));

function creatTrend($sql){
	$arr_month=Array();
	$arr_num=Array();
	$query = mysql_query ( $sql );
	while($rs = mysql_fetch_array ( $query )){
		$arr_month[]=$rs[0];
		$arr_num[]=$rs[1];
	}
	if(count($arr_num)==0){
		return $arr_num;
	}
	$whole=Array();
	$whole[0]=$arr_month;
	$whole[1]=$arr_num;
	return $whole;
}
?>