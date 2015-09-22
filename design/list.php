<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Search</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="css/style1.css" media="all" />
<script language="javascript" type="text/javascript" src="js/date97/WdatePicker.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script language="javascript" type="text/javascript" src="js/click.js"></script>
<script language="javascript" type="text/javascript" src="js/pre.js"></script>
<script language="javascript" type="text/javascript" src="js/create.js"></script>

<!-- Include Twitter Bootstrap and jQuery: -->
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
 
<!-- Include the plugin's CSS and JS: -->
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
	<style type="text/css">
	div,div input, div h1 {
	  font-family: "Helvetica Neue", Helvetica-, Arial, sans-serif;
	  font-weight: 500;
	  line-height: 1.1;
	}
	
	.explain-col{font-size: 19px;
	  line-height: 1.5;}

		</style>

<?php
        error_reporting(0);
		include 'database.php';
        $dump =array();
		$sql = "SELECT DISTINCT country FROM userinfo;";
		$query = mysql_query($sql);
		while ($rs = mysql_fetch_array($query)){
             if($rs[0]!=null){
                $dump[] = $rs[0]; 
        }
      }
      //print_r($dump);
      $json_dump=json_encode($dump);
?>
<script type="text/javascript">

var arr_country=eval(<?=$json_dump?>);
$(function() {
	createCountry();
});

function createCountry(){
	var obj=document.getElementById('country');
	var obj1=document.getElementById('dump_country');
	for(var i=0;i<arr_country.length;i++){
		obj.options.add(new Option(arr_country[i],arr_country[i]));
		obj1.options.add(new Option(arr_country[i],arr_country[i]));
	}
}

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#country').multiselect({
       	 maxHeight: 200,
        buttonText: function(options, select) {
            if (options.length === 0) {
                return 'None selected';
            }
            else if (options.length > 0) {
                return options.length+' options selected!';
            }
        }
        });
        $('#form1').on('reset', function() {
            $('#country option:selected').each(function() {
                $(this).prop('selected', false);
            })
           $('#country').multiselect('refresh');
        });
        $('#dump_country').multiselect({
         	 maxHeight: 200,
          	buttonText: function(options, select) {
                if (options.length === 0) {
                    return 'None selected';
                }
                else if (options.length > 0) {
                    return options.length+' options selected!';
                }
            }
          });
          $('#form1').on('reset', function() {
              $('#country option:selected').each(function() {
                  $(this).prop('selected', false);
              })
             $('#dump_country').multiselect('refresh');
          });
    });
</script>
</head>
<body>
<div><?php include "header2.php"; ?></div>
	<div class="pad1">
		<div class=" explain-col attr">
			Problem Type(required)
			<input type="radio" name="problem" id="p1" value="How many" checked="checked" class="f1">how many
            <input type="radio" name="problem" id="p2" value="Trend" class="f1">trend
            <input type="radio" name="problem" id="p3" value="Compare" class="f1">compare
            <input type="radio" name="problem" id="p4" value="Proportion" class="f1">proportion
		</div>
		<div class="explain-col attr" id ="col1">
			Search Type(required)
			<select id="question" name="question" class="f1 btn btn-default">
				<option value="">None selected</option>
				<option value="attend">attend</option>
				<option value="confirmed">confirmed</option>
				<option value="firsttimeuser">first-time-client</option>
				<option value="alteredname">altered name</option>
			</select>
			 <span id="e2" class="error"><image src='images/del.png'/> please choose a search type</span>
		</div>
		<div class="explain-col attr" id ="dump_col1" style="display:none">
			Additional conditions(optional)
			&nbsp;&nbsp;<label><input id="confirmBox" name="dump_question" type="checkbox"/>confirm</label>
			From
			<input type="text" id="confirmStartMonth" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'confirmEndMonth\')}',onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})"  size="12" class="Wdate"/>
			To
			<input type="text" id="confirmEndMonth" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'confirmStartMonth\')}',onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})"  size="12" class="Wdate"/>
			&nbsp;&nbsp;<label><input id="ftBox" name="dump_question" type="checkbox"/>first-time-client</label>
			From
			<input type="text" id="ftStartMonth" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'ftEndMonth\')}',onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})"  size="12" class="Wdate"/>
			To
			<input type="text" id="ftEndMonth" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'ftStartMonth\')}',onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})"  size="12" class="Wdate"/>
		</div>
		<div class="explain-col attr" id="col2">
			sex(optional)
			<select id="sex" name="sex" class="f1 btn btn-default">
				<option value="">None selected</option>
				<option value="M">male</option>
                <option value="F">female</option>
			</select> 
			eligible state(optional)
			<select id="state" name="states" class="f1 btn btn-default">
					<option value="">None selected</option>
					<option value="T">yes</option>
					<option value="F">no</option>
			</select>
			user type(optional)
            <select id="user" name="user" class="f1 btn btn-default">
				<option value="">None selected</option>
				<option value="inside">inside-month</option>
				<option value="outside">outside-month</option>
			</select>
			country(optional)
			<select id="country" name="country" class="f1" multiple="multiple">
			</select>
			<input id="comparebutton" class="btn btn-lg btn-primary btn-shadow" value="Compare" type="button" style="display:none"/>
			<input id="compareflag" value="c1" type="text" size="1" style="display:none"/>
		</div>
		<div class="explain-col attr" id="dump2" style="display:none">
			sex(optional)
			<select id="dump_sex" name="sex" class="f1 btn btn-default">
				<option value="">None selected</option>
				<option value="M">male</option>
                <option value="F">female</option>
			</select> 
			eligible state(optional)
			<select id="dump_state" name="states" class="f1 btn btn-default">
					<option value="">None selected</option>
					<option value="T">yes</option>
					<option value="F">no</option>
			</select>
			user type(optional)
            <select id="dump_user" name="user" class="f1 btn btn-default">
				<option value="">None selected</option>
				<option value="inside">inside-month</option>
				<option value="outside">outside-month</option>
			</select>
			country(optional)
			<select id="dump_country" name="country" class="f1" multiple="multiple">
			</select>
		</div>
		
		<div class="explain-col attr" id="col3">
			Frequency(optional)
			<select id="frequency" name="frequency" class="f1 btn btn-default">
				<option value="">None selected</option>
				<option value="more than">more than</option>
				<option value="less than">less than</option>
				<option value="equals">equals</option>
			</select>
			<span id="tim" style="display: none">
			    <input name="times" type="text" size="3" value="" id="times" class="f1 btn btn-default" maxlength="3"/>times
			</span>
			<span id="tishi" class="error" style="display: none">Please input a valid number between 1 and 100.</span>
		</div>
		<div class="explain-col attr" id="col4">
		<div id="time1">
			From
			<input type="text" id="startMonth" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'endMonth\')}',onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" onchange="disable(1)" size="12" class="Wdate"/>
			To
			<input type="text" id="endMonth" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'startMonth\')}',onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" onchange="disable(1)" size="12" class="Wdate"/>
		    &nbsp;or&nbsp;
		    Before
		    <input type="text" id="beforeMonth" onFocus="WdatePicker({onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" onchange="disable(2)" size="12" class="Wdate"/>
		    &nbsp;or&nbsp;
		    After
		    <input type="text" id="afterMonth" onFocus="WdatePicker({onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" onchange="disable(3)" size="12" class="Wdate"/>
		    &nbsp;or&nbsp;
		    On
		    <input type="text" id="onMonth" onFocus="WdatePicker({onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" onchange="disable(4)" size="12" class="Wdate"/>
		</div>
		<div id="time2" style="display: none">
		    <div class ="g1">
			From
			<input type="text" id="s11" name="s1" onFocus="WdatePicker({onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
			To
			<input type="text" id="s12" name="s2" onFocus="WdatePicker({onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
			<input type="button" class="btn btn-lg btn-primary btn-shadow" value="Add" id="add"/> 
			</div>
			<br/>
			<div class ="g1" id="g1-2">
			compare to From
			<input type="text" name="s1" onFocus="WdatePicker({onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
			To
			<input type="text" name="s2" onFocus="WdatePicker({onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" size="12" class="Wdate"/>
			</div>
		</div>
		<br /><br />
		<input id="send" type="button" name="ask" class="btn btn-lg btn-primary btn-shadow" value="go to ask" />
		<input type="button" id="reset1" class ="btn btn-lg btn-primary btn-shadow" value="reset" style="margin-left:10px;"/>
		</div>
       <div id="dialog"> 
          <div id="showPanel">
          <span id="title"><h1>The question you could ask is :</h1></span>
          <div id="maintext"></div>
          <div id="result">
          <div id="title2"><h1>Result</h1></div>
          <div id="loading"><img src= 'images/loader.gif'/></div>
          <div id="resultcount"></div>
          <br/>
          <div id="resulttext"></div>
          </div>
          </div>
       </div> 
</div>
<!-- ECharts单文件引入 -->
<script src="./js/dist/echarts.js"></script>
<script>
// 路径配置
require.config({
    paths: {
          echarts: './js/dist'
    }
});
// 使用
</script>
</body>
</html>