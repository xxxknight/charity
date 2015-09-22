$(function() {
	$(".f1").each(function() {
		$(this).change(function() {
			showInfo();
		})
	});
	preValidation();
	$("#reset1").click(function() {
		location.reload();
	});
	$("input[name=problem]").each(function() {
		$(this).click(function() {
			$("#frequency").attr("disabled", false);
			$("#question").val("");
			
			$("#dump_col1").hide();
			$("#confirmBox").prop('checked', false);
			$("#ftBox").prop('checked', false);
			$("#confirmStartMonth").val("");
			$("#confirmEndMonth").val("");
			$("#ftStartMonth").val("");
			$("#ftEndMonth").val("");
			
			$("#confirmStartMonth").attr("disabled", true);
			$("#confirmEndMonth").attr("disabled", true);
			$("#ftStartMonth").attr("disabled", true);
			$("#ftEndMonth").attr("disabled", true);
			
			$("#sex").val("");
			$("#state").val("");
			$("#user").val("");
			$('#country option:selected').each(function() {
				$(this).prop('selected', false);
			});
			$('#country').multiselect('refresh');
			$("#frequency").val("");
			$("#times").val("");
			$("#tim").hide();
			$("#tishi").hide();
			$("#startMonth").val("");
			$("#endMonth").val("");
			$("#sinceMonth").val("");
			$("#afterMonth").val("");
			$("#onMonth").val("");

			$("input[name=s1]").each(function() {
				$(this).val("");
			});
			$("input[name=s2]").each(function() {
				$(this).val("");
			});
			showInfo();
		});
	});
	$("#comparebutton").click(function() {
		$("#dump2").show();
		$("#g1-2").hide();
		$("#add").hide();
		$("#compareflag").val("c2");
		var sex = $("#sex").val();
		var state = $("#state").val();
		var user = $("#user").val();
		var country = $("#country").val();
		$("#dump_sex").val(sex);
		$("#dump_state").val(state);
		$("#dump_user").val(user);
		$("#dump_country").multiselect('select', country);
		showInfo();
	});
})

function showInfo() {
	var str = "";
	var compareFlag = $("#compareflag").val();
	var v1 = $("input[type='radio']:checked").val();
	if (v1 != "" && v1 != undefined) {
		str += v1 + " client ";
	}
	if (v1 == "Compare") {
		if (compareFlag == "c1") {
			str = showDumpCol1(str);
			str += "{ ";
			if ($("#sex").val() != "") {
				str += " sex: " + $("#sex").val() + ", ";
			}
			if ($("#state").val() != "") {
				str += " eligible state: " + $("#state").val() + ", ";
			}
			if ($("#user").val() != "") {
				str += " user type: " + $("#user").val() + ", ";
			}
			if ($("#country").val() != "" && $("#country").val() != null) {
				str += " country: [" + $("#country").val() + "] ";
			}
			str += "} ";
			if ($("#question").val() != "") {
				str += " who " + $("#question").val() + "  ";
			}
			var arr1 = new Array();
			var arr2 = new Array();
			var i = 0;
			var j = 0;
			$("input[name='s1']").each(function() {
				arr1[i] = $(this).val();
				i++;
			});
			$("input[name='s2']").each(function() {
				arr2[j] = $(this).val();
				j++;
			});
			if (i > 0 && (arr1[0] != "" || arr2[0] != "")) {
				str += " at ";
				for ( var k = 0; k < arr1.length; k++) {
					if (arr1[k] != "") {
						str += " " + arr1[k] + "~";
					}
					if (arr2[k] != "" && k != arr1.length - 1) {
						str += "" + arr2[k] + " and ";
					} else {
						str += "" + arr2[k] + "";
					}
				}
			}
		} else {
			str = showDumpCol1(str);
			if (str != "") {
				str += " { ";
			}
			if ($("#sex").val() != "") {
				str += " sex: " + $("#sex").val() + " , ";
			}
			if ($("#country").val() != "" && $("#country").val() != null) {
				str += " country: [" + $("#country").val() + "], ";
			}
			if ($("#state").val() != "") {
				str += " eligible state: " + $("#state").val() + " , ";
			}
			if ($("#user").val() != "") {
				str += " user type: " + $("#user").val() + "  ";
			}
			if (str != "") {
				str += " } ";
			}
			if (str != "") {
				str +=  " with client {";
			}
			if ($("#dump_sex").val() != "") {
				str += " sex: " + $("#dump_sex").val() + " , ";
			}
			if ($("#dump_country").val() != ""
					&& $("#dump_country").val() != null) {
				str += " country: [" + $("#dump_country").val() + "], ";
			}
			if ($("#dump_state").val() != "") {
				str += " eligible state: " + $("#dump_state").val() + " , ";
			}
			if ($("#dump_user").val() != "") {
				str += " user type: " + $("#dump_user").val() + "  ";
			}
			if (str != "") {
				str += " } ";
			}
			if ($("#question").val() != "") {
				str += $("#question").val() + "  ";
			}
			if ($("#s11").val() != "") {
				str += "from " + $("#s11").val() + "  ";
			}
			if ($("#s12").val() != "") {
				str += "to " + $("#s12").val() + "  ";
			}
		}
	} else {
		str = showDumpCol1(str);
		if ($("#sex").val() != "") {
			str += "[sex: " + $("#sex").val() + " ] ";
		}
		if ($("#country").val() != "" && $("#country").val() != null) {
			str += " come from [" + $("#country").val() + "]  ";
		}
		if ($("#state").val() != "") {
			str += "[eligible state: " + $("#state").val() + " ] ";
		}
		if ($("#user").val() != "") {
			str += "[user type: " + $("#user").val() + " ] ";
		}
		if ($("#question").val() != "") {
			str += $("#question").val() + "  ";
		}
		if ($("#frequency").val() != "") {
			str += $("#frequency").val() + "  ";
		}
		if ($("#times").val() != "") {
			str += $("#times").val() + " times ";
		}
		if ($("#startMonth").val() != "") {
			str += "from " + $("#startMonth").val() + "  ";
		}
		if ($("#endMonth").val() != "") {
			str += "to " + $("#endMonth").val() + "  ";
		}
		if ($("#beforeMonth").val() != "") {
			str += "before " + $("#beforeMonth").val() + "  ";
		}
		if ($("#afterMonth").val() != "") {
			str += "after " + $("#afterMonth").val() + "  ";
		}
		if ($("#onMonth").val() != "") {
			str += "on " + $("#onMonth").val() + "  ";
		}
	}

	if (str != "" && v1 == "Proportion") {
		str += "compared to the whole system’s data";
	}
	if (str != "") {
		str += " ?";
	}
	$("#maintext").html(str);
}

function preValidation() {
	$("#confirmStartMonth").attr("disabled", true);
	$("#confirmEndMonth").attr("disabled", true);
	$("#ftStartMonth").attr("disabled", true);
	$("#ftEndMonth").attr("disabled", true);
	
	$("#question").change(function() {
				if ($("#question").val() == "attend") {
					$("#frequency").attr("disabled", false);
					$("#dump_col1").show();
				} else {
					$("#times").val("");
					$("#tim").hide();
					$("#tishi").hide();
					$("#frequency").val("");
					$("#frequency").attr("disabled", true);
					$("#dump_col1").hide();
				}
				if ($("#question").val() != "") {
					$("#e2").hide();
				}
			});
	$("#frequency").change(function() {
		if ($("#frequency").val() == "") {
			$("#times").val("");
			$("#tim").hide();
			$("#tishi").hide();
		} else {
			$("#tim").show();
		}
	});
	$("#times").keyup(function() {
		if (checkTimes()) {
			$("#tishi").hide();
		} else {
			$("#tishi").show();
		}
	});
	$("#confirmBox").click(function(){
		if(!$("#confirmBox").prop("checked")){
			$("#confirmStartMonth").attr("disabled", true);
			$("#confirmEndMonth").attr("disabled", true);
		}else{
			$("#confirmStartMonth").attr("disabled",false);
			$("#confirmEndMonth").attr("disabled", false);
		}
	});
	$("#ftBox").click(function(){
		if(!$("#ftBox").prop("checked")){
			$("#ftStartMonth").attr("disabled", true);
			$("#ftEndMonth").attr("disabled", true);
		}else{
			$("#ftStartMonth").attr("disabled",false);
			$("#ftEndMonth").attr("disabled", false);
		}
	});
}

function checkTimes() {
	var str = $("#times").val();
	if (str == "") {
		return false;
	}
	var reNum = /(^[1-9][0-9]$)|(^100$)|(^[1-9]$)/;    //正则
	return (reNum.test(str));
}

function disable(t) {
	if (t == 1) {
		if ($("#startMonth").val() != "" || $("#endMonth").val() != "") {
			$("#beforeMonth").attr("disabled", true);
			$("#afterMonth").attr("disabled", true);
			$("#onMonth").attr("disabled", true);
		} else {
			$("#beforeMonth").attr("disabled", false);
			$("#afterMonth").attr("disabled", false);
			$("#onMonth").attr("disabled", false);
		}
	} else if (t == 2) {
		if ($("#beforeMonth").val() != "") {
			$("#startMonth").attr("disabled", true);
			$("#endMonth").attr("disabled", true);
			$("#afterMonth").attr("disabled", true);
			$("#onMonth").attr("disabled", true);
		} else {
			$("#startMonth").attr("disabled", false);
			$("#endMonth").attr("disabled", false);
			$("#afterMonth").attr("disabled", false);
			$("#onMonth").attr("disabled", false);
		}
	} else if (t == 3) {
		if ($("#afterMonth").val() != "") {
			$("#startMonth").attr("disabled", true);
			$("#endMonth").attr("disabled", true);
			$("#beforeMonth").attr("disabled", true);
			$("#onMonth").attr("disabled", true);
		} else {
			$("#startMonth").attr("disabled", false);
			$("#endMonth").attr("disabled", false);
			$("#beforeMonth").attr("disabled", false);
			$("#onMonth").attr("disabled", false);
		}
	} else if (t == 4) {
		if ($("#onMonth").val() != "") {
			$("#startMonth").attr("disabled", true);
			$("#endMonth").attr("disabled", true);
			$("#beforeMonth").attr("disabled", true);
			$("#afterMonth").attr("disabled", true);
		} else {
			$("#startMonth").attr("disabled", false);
			$("#endMonth").attr("disabled", false);
			$("#beforeMonth").attr("disabled", false);
			$("#afterMonth").attr("disabled", false);
		}
	}
}

function showDumpCol1(str){
	if($("#confirmBox").prop("checked") || $("#ftBox").prop("checked")){
		str += " who ";
		if($("#confirmBox").prop("checked")){
			str += " confirmed " ;
			if($("#confirmStartMonth").val()!=""){
				str += " from "+$("#confirmStartMonth").val()+" ";
			}
			if($("#confirmEndMonth").val() !=""){
				str += " to " + $("#confirmEndMonth").val()+" ";
			}
		}
		if($("#confirmBox").prop("checked") && $("#ftBox").prop("checked")){
			    str += " and ";
		}
		if($("#ftBox").prop("checked")){
			str += " first come ";
			if($("#ftStartMonth").val()!=""){
				str += " from "+$("#ftStartMonth").val()+" ";
			}
			if($("#ftEndMonth").val() !=""){
				str += " to " + $("#ftEndMonth").val()+" ";
			}
		}
	}
	return str;
}