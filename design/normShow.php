<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>General Analysis</title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/style1.css" media="all" />
<script language="javascript" type="text/javascript" src="js/date97/WdatePicker.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script language="javascript" type="text/javascript" src="js/normShow.js"></script>

<style type="text/css">
	
	.time{padding-top:20px;}

		</style>
</head>

<body>

<div><?php include "header2.php"; ?></div>
<?php
error_reporting ( 0 );
include 'database.php';

$sql1 = "select country,count(country) from userinfo group by country";
$query1 = mysql_query ( $sql1 );
$country = array ();
$num = array ();
while ( $rs1 = mysql_fetch_array ( $query1 ) ) {
	if ($rs1 [0] != null) {
		$country [] = $rs1 [0];
		$num [] = $rs1 [1];
	}
}
$new_country = json_encode ( $country );
$new_num = json_encode ( $num );

$sql7 = "select region,count(region) from userinfo group by region";
$query7 = mysql_query ( $sql7 );
$region = array ();
$countRegion = array ();
while ( $rs7 = mysql_fetch_array ( $query7 ) ) {
	if ($rs7 [0] != null) {
		$region [] = $rs7 [0];
		$countRegion [] = $rs7 [1];
	}
}
$json_region = json_encode ( $region );
$json_countRegion = json_encode ( $countRegion );

$sql2 = "select COUNT(Id) from userinfo where sex ='M'";
$query2 = mysql_query ( $sql2 );
$rs2 = mysql_fetch_array ( $query2 );
if ($rs2) {
	$countM = $rs2 [0];
} else {
	$countM = 0;
}

$sql3 = "select COUNT(Id) from userinfo where sex ='F'";
$query3 = mysql_query ( $sql3 );
$rs3 = mysql_fetch_array ( $query3 );
if ($rs3) {
	$countF = $rs3 [0];
} else {
	$countF = 0;
}

$sex = "[{value:'" . $countM . "', name:'male'},{value:'" . $countF . "',name:'female'},]";
$new_sex = json_encode ( $sex );

$age = Array ();
$age [0] = "1950s";
$age [1] = "1960s";
$age [2] = "1970s";
$age [3] = "1980s";
$age [4] = "1990s";
$age [5] = "2000s";
$age [6] = "other";

$numAge = Array ();
for($i = 195; $i <= 200; $i ++) {
	$sql4 = "select count(Id) from userinfo WHERE birth LIKE '" . $i . "%'";
	$query4 = mysql_query ( $sql4 );
	$rs4 = mysql_fetch_array ( $query4 );
	if ($rs4 [0] != null) {
		$numAge [] = $rs4 [0];
	}
}

$sql5 = "select count(Id) from userinfo";
$query5 = mysql_query ( $sql5 );
$rs5 = mysql_fetch_array ( $query5 );
if ($rs5 [0] != null) {
	$sum = array_sum ( $numAge );
	$numAge [] = $rs5 [0]-$sum;
}

$new_age = json_encode ( $age );
$new_numAge = json_encode ( $numAge );

$arr_m = Array();
$arr_n = Array();
$dump_m = Array("01","02","03","04","05","06","07","08","09","10","11","12");

$this_month = date('n');
$this_year = date('Y');
for ($i=1;$i<=$this_month;$i++){
      $str = $this_year."-".$dump_m[$i-1];
      $sql6 = "select count(id) from action where insertMonth= '".$str."'";
      $query6 = mysql_query ( $sql6);
      $rs6 = mysql_fetch_array ( $query6);
      if(rs6!=null){
          $arr_m[]=$str;
          $arr_n[]=$rs6[0];
      }
}
$json_m = json_encode ( $arr_m );
$json_n = json_encode ( $arr_n );
?>
<h1 style="padding-left:40%; padding-top:20px;"><strong>General Analysis</strong></h1>
	<div id="panel" class="container">
		<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
		<div class="time">
			From
			<input type="text" id="start1" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'end1\')}',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
			To
			<input type="text" id="end1" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'start1\')}',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
		    <input type="button" id="commit1" class="btn  btn-primary btn-shadow" size="20" value="commit"/>
		</div>
		<div id="p1" style="height:400px"></div>
		
		<div class="time">
			From
			<input type="text" id="start2" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'end2\')}',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
			To
			<input type="text" id="end2" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'start2\')}',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
		    <input type="button" id="commit2" class="btn  btn-primary btn-shadow" size="20" value="commit"/>
		</div>
		<div id="p2" style="height:400px"></div>
		
		<div class="time">
			From
			<input type="text" id="start3" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'end3\')}',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
			To
			<input type="text" id="end3" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'start3\')}',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
		    <input type="button" id="commit3" class="btn  btn-primary btn-shadow" size="20" value="commit"/>
		</div>
		<div id="p3" style="height:400px"></div>
		
		<div class="time">
			From
			<input type="text" id="start4" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'end4\')}',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
			To
			<input type="text" id="end4" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'start4\')}',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
		    <input type="button" id="commit4" class="btn  btn-primary btn-shadow" size="20" value="commit"/>
		</div>
		<div id="p4" style="height:400px"></div>
		
		<div class="time">
			From
			<input type="text" id="start5" onFocus="WdatePicker({maxDate:'%y-%M',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
			To
			<input type="text" id="end5" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'start5\')}',maxDate:'%y-%M',dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
		    <input type="button" id="commit5" class="btn  btn-primary btn-shadow" size="20" value="commit"/>
		</div>
		<div id="p5" style="height:400px"></div>
	
	</div>
	<!-- ECharts单文件引入 -->
	<script src="./js/dist/echarts.js"></script>
	<script type="text/javascript">

	var myDate = new Date();
	var this_year = myDate.getFullYear();

	var country = new Array();
	country=eval(<?=$new_country?>);
	var num = new Array();
	num=eval(<?=$new_num?>);
	var sex = eval(<?=$new_sex?>);

	var region = new Array();
	region=eval(<?=$json_region?>);
	var countRegion = new Array();
	countRegion=eval(<?=$json_countRegion?>);
	
	var sex = eval(<?=$new_sex?>);

	var age = eval(<?=$new_age?>);
	var numAge = eval(<?=$new_numAge?>);

	var month = eval(<?=$json_m?>);
	var n = eval(<?= $json_n?>);
	
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
                'echarts/chart/bar', // 使用柱状图就加载bar模块，按需加载
                'echarts/chart/pie',
                'echarts/chart/line',
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表
                var myChart1 = ec.init(document.getElementById('p1')); 
                var option1 = {
                		    title : {
                		        text: 'The distribution of countries',
                		        x:'center'
                		    },
                		    tooltip: {
                                show: true
                            },
                		    toolbox: {
                		        show : true,
                		        feature : {
                		            dataView : {show: true, 
                    		                    readOnly:true,
                		            	        optionToContent :function(){
                    		            	        var str ="data format :{country => quanity} <br/>";
                    		            	        for(var i=0;i<country.length;i++){
                        		            	        str+=" "+(i+1)+".  "+country[i]+" => "+num[i]+"<br/>";
                    		            	        }
                    		            	        return str;
                		            	        },
                    		        },
                		            saveAsImage : {show: true},
                		            restore : {show: true},
                		        }
                		    },
                		    calculable : true,
                		    xAxis : [
                                     {
                                         type : 'category',
                                         data : country
                                     }
                                 ],
                                 yAxis : [
                                     {
                                         type : 'value'
                                     }
                                 ],
                                 series : [
                                     {
                                         "name":"quanity",
                                         "type":"bar",
                                         itemStyle: {
                                             normal: {
                                                 color: function(params) {
                                                     // build a color map as your need.
                                                     var colorList = [
                                                       '#C1232B','#B5C334','#FCCE10','#E87C25','#27727B',
                                                        '#FE8463','#9BCA63','#FAD860','#F3A43B','#60C0DD',
                                                        '#D7504B','#C6E579','#F4E001','#F0805A','#26C0C0',
                                                        '#AC8463','#9BFF63','#FAC001','#C0805A','#A6C0C0',
                                                     ];
                                                     return colorList[params.dataIndex]
                                                 },
                                                 label: {
                                                     show: true,
                                                     position: 'top',
                                                     formatter: '{b}\n{c}'
                                                 }
                                             }
                                         },
                                         "data":num
                                     }
                                 ]
                };
        
                // 为echarts对象加载数据 
                myChart1.setOption(option1); 

                var myChart2 = ec.init(document.getElementById('p2')); 
                var option2 = {
                		    title : {
                		        text: 'The distribution of regions',
                		        x:'center'
                		    },
                		    tooltip: {
                                show: true
                            },
                		    toolbox: {
                		        show : true,
                		        feature : {
                		            dataView : {show: true, 
                		            	        readOnly:true,
        		            	                optionToContent :function(){
            		            	            var str ="data format :{region => quanity} <br/>";
            		            	            for(var i=0;i<region.length;i++){
                		            	            str+=" "+(i+1)+".  "+region[i]+" => "+countRegion[i]+"<br/>";
            		            	            }
            		            	            return str;
        		            	                },
                    		        },
                		            saveAsImage : {show: true},
                		            restore : {show: true},
                		        }
                		    },
                		    calculable : true,
                		    xAxis : [
                                     {
                                         type : 'category',
                                         data : region
                                     }
                                 ],
                                 yAxis : [
                                     {
                                         type : 'value'
                                     }
                                 ],
                                 series : [
                                     {
                                         "name":"quanity",
                                         "type":"bar",
                                         itemStyle: {
                                             normal: {
                                                 color: function(params) {
                                                     // build a color map as your need.
                                                     var colorList = [
                                                       '#D7504B','#C6E579','#F4E001','#F0805A','#26C0C0',
                                                       '#C1232B','#B5C334','#FCCE10','#E87C25','#27727B',
                                                        '#FE8463','#9BCA63','#FAD860','#F3A43B','#60C0DD',
                                                        
                                                     ];
                                                     return colorList[params.dataIndex]
                                                 },
                                                 label: {
                                                     show: true,
                                                     position: 'top',
                                                     formatter: '{b}\n{c}'
                                                 }
                                             }
                                         },
                                         "data":countRegion
                                     }
                                 ]
                };
        
                // 为echarts对象加载数据 
                myChart2.setOption(option2); 
                
                var myChart3 = ec.init(document.getElementById('p3')); 
                var option3 = {
                		title : {
            		        text: 'The distribution of age',
            		        x:'center'
            		    },
            		    tooltip: {
                            show: true
                        },
            		    toolbox: {
            		        show : true,
            		        feature : {
            		            dataView : {show: true, 
            		            	        readOnly:true,
	            	                        optionToContent :function(){
		            	                    var str ="data format :{age => quanity} <br/>";
		            	                    for(var i=0;i<age.length;i++){
    		            	                   str+=" "+(i+1)+".  "+age[i]+" => "+numAge[i]+"<br/>";
		            	                    }
		            	                       return str;
	            	                      },
                		           },
            		            saveAsImage : {show: true},
            		            restore : {show: true},
            		        }
            		    },
            		    calculable : true,
            		    xAxis : [
                                 {
                                     type : 'category',
                                     data : age
                                 }
                             ],
                             yAxis : [
                                 {
                                     type : 'value'
                                 }
                             ],
                             series : [
                                 {
                                     "name":"quanity",
                                     "type":"bar",
                                     itemStyle: {
                                         normal: {
                                             color: function(params) {
                                                 // build a color map as your need.
                                                 var colorList = [
                                                   '#D7504B','#C6E579','#F4E001','#F0805A','#26C0C0',
                                                   '#C1232B','#B5C334','#FCCE10','#E87C25','#27727B',
                                                    '#FE8463','#9BCA63','#FAD860','#F3A43B','#60C0DD',
                                                    
                                                 ];
                                                 return colorList[params.dataIndex]
                                             },
                                             label: {
                                                 show: true,
                                                 position: 'top',
                                                 formatter: '{b}\n{c}'
                                             }
                                         }
                                     },
                                     "data":numAge
                                 }
                             ]
                };
        
                // 为echarts对象加载数据 
                myChart3.setOption(option3); 

                var myChart4 = ec.init(document.getElementById('p4')); 
                var option4 = {
                	    title : {
                	        text: 'The proportion of sex',
                	        x:'center'
                	    },
                	    tooltip : {
                	        trigger: 'item',
                	        formatter: "{a} <br/>{b} : {c} ({d}%)"
                	    },
                	    toolbox: {
                	        show : true,
                	        feature : {
                	        	dataView : {show: true, readOnly: true},
                	            saveAsImage : {show: true},
                	            restore : {show: true},
                	        }
                	    },
                	    calculable : true,
                	    series : [
                	        {
                	            name:'The proportion of',
                	            type:'pie',
                	            radius : '55%',
                	            center: ['50%', '60%'],
                	            data:sex
                	        }
                	    ]
                	};
                // 为echarts对象加载数据 
                myChart4.setOption(option4); 

                var myChart5 = ec.init(document.getElementById('p5')); 
                var option5 = {
                	    title : {
                	        text: 'The trend of attendance in '+this_year,
                	        x:'center'
                	    },
                	    tooltip : {
                	        trigger: 'axis'
                	    },
                	    legend: {
                	        data:['quanity'],
                	        x : 'left',
                	    },
                	    toolbox: {
                	        show : true,
                	        feature : {
                	            dataView : {show: true, 
                	            	        readOnly:true,
        	                                optionToContent :function(){
            	                              var str ="data format :{month => quanity} <br/>";
            	                              for(var i=0;i<month.length;i++){
	            	                          str+=" "+(i+1)+".  "+month[i]+" => "+n[i]+"<br/>";
            	                            }
            	                            return str;
        	                      },
                    	        },
                	            saveAsImage : {show: true},
                	            restore : {show: true},
                	        }
                	    },
                	    calculable : true,
                	    xAxis : [
                	        {
                	            type : 'category',
                	            boundaryGap : false,
                	            data : month
                	        }
                	    ],
                	    yAxis : [
                	        {
                	            type : 'value',
                	       
                	        }
                	    ],
                	    series : [
                	        {
                	            name:'quanity',
                	            type:'line',
                	            data:n,
                	            markPoint : {
                	                data : [
                	                    {type : 'max', name: 'Max'},
                	                    {type : 'min', name: 'Min'}
                	                ]
                	            },
                	        },
                	       
                	    ]
                	};
                	                    
                // 为echarts对象加载数据 
                myChart5.setOption(option5); 
            }
        );
    </script>
</body>
</html>