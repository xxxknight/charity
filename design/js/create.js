$(function() {
	$("#p1").click(function() {
		$("#col3").show();
		$("#time1").show();
		$("#time2").hide();
		$("option[value=alteredname]").show();
		$("#comparebutton").hide();
		$("#dump2").hide();
		resetResult();
	});
	$("#p2").click(function() {
		$("#col3").hide();
		$("#time1").show();
		$("#time2").hide();
		$("option[value=alteredname]").hide();
		$("#comparebutton").hide();
		$("#dump2").hide();
		resetResult();
	});
	$("#p3").click(function() {
		$("option[value=alteredname]").hide();
		$("#col3").hide();
		$("#time1").hide();
		$("#time2").show();
		$("#comparebutton").show();
		$("#g1-2").show();
		$("#add").show();
		resetResult();
	});
	$("#p4").click(function() {
		$("#time1").show();
		$("#col3").hide();
		$("#time2").hide();
		$("option[value=alteredname]").show();
		$("#comparebutton").hide();
		$("#dump2").hide();
		resetResult();
	});
	$("#add").click(function() {
		$("#time2").append("<div class='g1'>compare to From <input type='text' name='s1' onFocus='WdatePicker({onpicked:function(dp){showInfo();},dateFmt:\"yyyy-MM\"})' size='12' class='Wdate'/> To <input type='text' name='s2' onFocus='WdatePicker({onpicked:function(dp){showInfo();},dateFmt:\"yyyy-MM\"})' size='12' class='Wdate'/> <input onclick='removeDiv(this)' type='button' value='remove'/><div>");
	});
});

function removeDiv(obj){
	$(obj).parent().remove();
}

function resetResult() {
	$("#resultcount").html("");
	$("#resulttext").html("");
	$("#main").remove();
}
