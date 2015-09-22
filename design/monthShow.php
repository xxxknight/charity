<?php
// error_reporting ( 0 );
include 'database.php';

$thismonth = date ( "Y-m" );
$lastmonth = date ( "Y-m", strtotime ( "-1 month" ) );
$last2month = date ( "Y-m", strtotime ( "-2 month" ) );

$thismonthlastyear = date ( "Y-m", strtotime ( "-12 month" ) );
$lastmonthlastyear = date ( "Y-m", strtotime ( "-13 month" ) );
$last2monthlastyear = date ( "Y-m", strtotime ( "-14 month" ) );

$montharr1 = Array (
		$thismonth,
		$lastmonth,
		$last2month 
);
$montharr2 = Array (
		$thismonthlastyear,
		$lastmonthlastyear,
		$last2monthlastyear 
);

// $arr_confirm1 = Array ();
// for($i = 0; $i < 3; $i ++) {
// 	$sql = "SELECT count(Id) FROM userinfo where confirmtime like '" . $montharr1 [$i] . "%'";
// 	$query = mysql_query ( $sql );
// 	$rs = mysql_fetch_array ( $query );
// 	$arr_confirm1 [] = $rs [0];
// }

$sql_nc = "SELECT count(id) FROM action where isfirst = 'T' and insertmonth = '" . $thismonth. "'";
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
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Monthly Report</title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/style3.css" media="all" />
<script type="text/javascript" src="js/date97/WdatePicker.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/monthShow.js"></script>
<!-- <script type="text/javascript" src="js/monthShow.js"></script> -->
</head>
<body>
<div><?php include "header2.php"; ?></div>
	<h1 style="padding-top:20px;"><strong>Monthly Report</strong></h1>
	<form action ="answer/savedata.php" method="get">
	<input type="text" id="Dmonth" name="Dmonth" style="display:none"/>
	<div class="container"><input type="submit" class="btn  btn-primary btn-shadow" title="click to save data of this month" id="saveData" value="savedata"/></div>
	</form>
	<div id="panel" class="container">
	
	<div id="month">Please input the month you want to see the monthly report
	<input type="text" id="Cmonth" class="form-control" style= "width:30%;" onFocus="WdatePicker({maxDate:'%y-%M',onpicked:function(dp){change()},dateFmt:'yyyy-MM'})" size="12" class="Wdate" value="<?php echo $thismonth?>"/>
	<div style="margin-top:5px"><input type="button" class="btn  btn-primary btn-shadow" value="search" id = "confirm" /></div>
	</div>
	
		<div class="part">
			<div class="title">The Statistics Data in this month</div>
			<div class="subject">
				<div id="s0">
					The number of the new comer : <input type="text" size="5" id="newNum"  class="form-control" style= "width:30%;"
						value="<?php echo $count_nc;?>" readonly="readonly" />
				</div>
				<div id="s1">
					The number of the total clients : <input type="text" size="5" id="ftNum"  class="form-control" style= "width:30%;"
						value="<?php echo $arr_T1[0];?>" readonly="readonly" />
				</div>
			</div>
		</div>
		<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
		<div id="ec1" style="height: 400px"></div>
		<div id="ec2" style="height: 400px"></div>
	</div>
	<!-- ECharts单文件引入 -->
	<script src="./js/dist/echarts.js"></script>
	<script type="text/javascript">
	var montharr1 = eval(<?php echo json_encode($montharr1)?>);
	var montharr2 = eval(<?php echo json_encode($montharr2)?>);
    var arr_T1 = eval(<?php echo json_encode($arr_T1)?>);
    var arr_T2 = eval(<?php echo json_encode($arr_T2)?>);
    var arr_M1 = eval(<?php echo json_encode($arr_M1)?>);
    var arr_M2 = eval(<?php echo json_encode($arr_M2)?>);
    var arr_E1 = eval(<?php echo json_encode($arr_E1)?>);
    var arr_E2 = eval(<?php echo json_encode($arr_E2)?>);
    
        // 路径配置
        require.config({
            paths: {
                echarts: './js/dist'
            }
        });
        
        // 使用
        require(
            [
                'echarts',
                'echarts/chart/bar' // 使用柱状图就加载bar模块，按需加载
            ],
 function (ec) {
                // 基于准备好的dom，初始化echarts图表
      var myChart = ec.init(document.getElementById('ec1')); 
      option = {
                       title : {
                       text: 'The number of attendence in the last 3 months',
                       x:'center',
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['inside','outside','sum'],
        x:'left',
    },
    toolbox: {
        show : true,
        feature : {
            dataView : {show: true, readOnly: false},
            saveAsImage : {show: true},
            restore : {show: true},
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : montharr1
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'inside',
            type:'bar',
            data:arr_M1,
            markPoint : {
                data : [
                    {type : 'max', name: 'max'},
                    {type : 'min', name: 'min'}
                ]
            },
        },
        {
            name:'outside',
            type:'bar',
            data:arr_E1,
            markPoint : {
            	data : [
                        {type : 'max', name: 'max'},
                        {type : 'min', name: 'min'}
                ]
            },
        },
        {
            name:'sum',
            type:'bar',
            data:arr_T1,
            markPoint : {
            	data : [
                        {type : 'max', name: 'max'},
                        {type : 'min', name: 'min'}
                ]
            },
        }
    ]
};
             // 为echarts对象加载数据 
                myChart.setOption(option); 
                var myChart2 = ec.init(document.getElementById('ec2')); 
                option2 = {
                                 title : {
                                 text: 'The number of attendence in the last year',
                                 x:'center',
              },
              tooltip : {
                  trigger: 'axis'
              },
              legend: {
                  data:['inside','outside','sum'],
                  x:'left',
              },
              toolbox: {
                  show : true,
                  feature : {
                      dataView : {show: true, readOnly: false},
                      saveAsImage : {show: true},
                      restore : {show: true},
                  }
              },
              calculable : true,
              xAxis : [
                  {
                      type : 'category',
                      data : montharr2
                  }
              ],
              yAxis : [
                  {
                      type : 'value'
                  }
              ],
              series : [
                  {
                      name:'inside',
                      type:'bar',
                      data:arr_M2,
                      markPoint : {
                          data : [
                              {type : 'max', name: 'max'},
                              {type : 'min', name: 'min'}
                          ]
                      },
                  },
                  {
                      name:'outside',
                      type:'bar',
                      data:arr_E2,
                      markPoint : {
                      	data : [
                                  {type : 'max', name: 'max'},
                                  {type : 'min', name: 'min'}
                          ]
                      },
                  },
                  {
                      name:'sum',
                      type:'bar',
                      data:arr_T2,
                      markPoint : {
                      	data : [
                                  {type : 'max', name: 'max'},
                                  {type : 'min', name: 'min'}
                          ]
                      },
                  }
              ]
          };
                          // 为echarts对象加载数据 
                          myChart2.setOption(option2);
            }
        );
    </script>
</body>