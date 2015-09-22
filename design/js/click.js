$(function() {
	$("#send").click(function() {
		var type = $("input[type='radio']:checked").val();
		switch (type) {
		case "How many":
			post1();
			break;
		case "Trend":
			post2();
			break;
		case "Compare":
			post3();
			break;
		case "Proportion":
			post4();
			break;
		default:
			alert("wrong");
		}
	});
});

function post1() {
	if (validation1()) {
		$.ajax({
			url : "answer/answer1.php",
			type : 'post',
			data : {
				type : $("input[type='radio']:checked").val(),
				sex : $("#sex").val(),
				country : $("#country").val() != null ? $("#country").val()
						: "",
				state : $("#state").val(),
				user : $("#user").val(),
				question : $("#question").val(),
				frequency : $("#frequency").val(),
				times : $("#times").val(),
				startMonth : $("#startMonth").val(),
				endMonth : $("#endMonth").val(),
				beforeMonth : $("#beforeMonth").val(),
				afterMonth : $("#afterMonth").val(),
				onMonth : $("#onMonth").val(),
				confirmFlag : $("#confirmBox").prop("checked") == true ? "1"
						: "0",
				confirmStartMonth : $("#confirmStartMonth").val(),
				confirmEndMonth : $("#confirmEndMonth").val(),
				ftFlag : $("#ftBox").prop("checked") == true ? "1" : "0",
				ftStartMonth : $("#ftStartMonth").val(),
				ftEndMonth : $("#ftEndMonth").val()
			},
			dataType : "json",
			timeout : 15000,
			beforeSend : function(XMLHttpRequest) {
				resetResult();
				$("#loading").show();
			},
			success : function(data, textStatus) {
				resetResult();
				$("#loading").hide();
				if (data.arr.length) {
					displayResult(data);
				} else {
					$("#resultcount").html("No data");
					$("#resulttext").html("");
				}
			},
		});
	}
}

function validation1() {
	if (checkSearch() && checkTishi() && checkMonth()) {
		return true;
	} else {
		return false;
	}
}

function checkSearch() {
	var v = $("#question").val();
	if (v == "") {
		$("#e2").show();
		return false;
	} else {
		return true;
	}
}

function checkTishi() {
	var v1 = $("#frequency").val();
	var v2 = $("#times").val();
	if (v1 != "" && v2 == "") {
		$("#tishi").show();
		return false;
	} else {
		return true;
	}
}

function checkMonth() {
	var s1 = $("#startMonth").val();
	var s2 = $("#endMonth").val();
	if ((s1 != "" && s2 == "") || (s1 == "" && s2 != "")) {
		alert("please input the right From-Time and To-Time");
		return false;
	} else {
		return true;
	}
}

function post2() {
	if (validation1()) {
		$.ajax({
			url : "answer/answer2.php",
			type : 'post',
			data : {
				type : $("input[type='radio']:checked").val(),
				question : $("#question").val(),
				sex : $("#sex").val(),
				country : $("#country").val() != null ? $("#country").val()
						: "",
				state : $("#state").val(),
				user : $("#user").val(),
				startMonth : $("#startMonth").val(),
				endMonth : $("#endMonth").val(),
				beforeMonth : $("#beforeMonth").val(),
				afterMonth : $("#afterMonth").val(),
				onMonth : $("#onMonth").val(),
				confirmFlag : $("#confirmBox").prop("checked") == true ? "1"
						: "0",
				confirmStartMonth : $("#confirmStartMonth").val(),
				confirmEndMonth : $("#confirmEndMonth").val(),
				ftFlag : $("#ftBox").prop("checked") == true ? "1" : "0",
				ftStartMonth : $("#ftStartMonth").val(),
				ftEndMonth : $("#ftEndMonth").val()
			},
			dataType : "json",
			timeout : 15000,
			beforeSend : function(XMLHttpRequest) {
				resetResult();
				$("#loading").show();
			},
			success : function(data, textStatus) {
				resetResult();
				$("#loading").hide();
				if (data.length) {
					createEchart();
					arr_month = data[0];
					arr_num = data[1];
					window.arr_month = arr_month;
					window.arr_num = arr_num;//变成全局变量，所以在后面的js的图里才能获取并使用
					$.getScript('js/tempTrend.js', {}, function() {
					});
				} else {
					$("#resultcount").html("No data");
					$("#resulttext").html("");
				}
			},
		});
	}
}

function post3() {
	var compareType = $("#compareflag").val();
	if (compareType == "c2") {
		if (checkSearch()) {
			$
					.ajax({
						url : "answer/answer3-2.php",
						type : 'post',
						data : {
							type : "Compare",
							question : $("#question").val(),
							sex : $("#sex").val(),
							dump_sex : $("#dump_sex").val(),
							country : $("#country").val() != null ? $(
									"#country").val() : "",
							dump_country : $("#dump_country").val() != null ? $(
									"#dump_country").val()
									: "",
							state : $("#state").val(),
							dump_state : $("#dump_state").val(),
							user : $("#user").val(),
							dump_user : $("#dump_user").val(),
							fromTime : $("#s11").val(),
							toTime : $("#s12").val(),
							confirmFlag : $("#confirmBox").prop("checked") == true ? "1"
									: "0",
							confirmStartMonth : $("#confirmStartMonth").val(),
							confirmEndMonth : $("#confirmEndMonth").val(),
							ftFlag : $("#ftBox").prop("checked") == true ? "1"
									: "0",
							ftStartMonth : $("#ftStartMonth").val(),
							ftEndMonth : $("#ftEndMonth").val()
						},
						dataType : "json",
						timeout : 15000,
						beforeSend : function(XMLHttpRequest) {
							resetResult();
							$("#loading").show();
						},
						success : function(data, textStatus) {
							resetResult();
							$("#loading").hide();
							if (data.length) {
								createEchart();
								var arr = new Array();
								var con1 = createCondition1();
								var con2 = createCondition2();
								arr[0] = con1;
								arr[1] = con2;
								window.timeperiod = arr;
								window.num = data[0];
								var answer = "The number of "
										+ con2
										+ " is <span class='red'>"
										+ data[1]
										+ "</span> times more than the number of "
										+ con1 + " ";
								var datePeriod = createDate();
								answer += datePeriod;
								$("#resulttext").html(answer);
								$.getScript('js/tempCompare.js', {},
										function() {
										});
							} else {
								$("#resultcount").html("No data");
								$("#resulttext").html("");
							}
						},
					});
		}
	} else {
		if (checkSearch()) {
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
			$
					.ajax({
						url : "answer/answer3.php",
						type : 'post',
						data : {
							type : "Compare",
							question : $("#question").val(),
							sex : $("#sex").val(),
							country : $("#country").val() != null ? $(
									"#country").val() : "",
							state : $("#state").val(),
							user : $("#user").val(),
							timeGroup1 : arr1,
							timeGroup2 : arr2,
							confirmFlag : $("#confirmBox").prop("checked") == true ? "1"
									: "0",
							confirmStartMonth : $("#confirmStartMonth").val(),
							confirmEndMonth : $("#confirmEndMonth").val(),
							ftFlag : $("#ftBox").prop("checked") == true ? "1"
									: "0",
							ftStartMonth : $("#ftStartMonth").val(),
							ftEndMonth : $("#ftEndMonth").val()
						},
						dataType : "json",
						timeout : 15000,
						beforeSend : function(XMLHttpRequest) {
							resetResult();
							$("#loading").show();
						},
						success : function(data, textStatus) {
							resetResult();
							$("#loading").hide();
							if (data.length) {
								createEchart();
								window.timeperiod = data[0];
								window.num = data[1];
								var answer = "The comparison results is as follows ["
										+ data[1] + "]";
								if (!isNaN(data[2][0])) {
									answer = answer
											+ "<br/> The multiple compared to the first condition is as follow: <span class='red'>"
											+ data[2] + "</span>";
								}
								$("#resulttext").html(answer);
								$.getScript('js/tempCompare.js', {},
										function() {
										});
							} else {
								$("#resultcount").html("No data");
								$("#resulttext").html("");
							}
						},
					});
		}
	}
}

function post4() {
	if (validation1()) {
		$
				.ajax({
					url : "answer/answer4.php",
					type : 'post',
					data : {
						type : $("input[type='radio']:checked").val(),
						question : $("#question").val(),
						sex : $("#sex").val(),
						country : $("#country").val() != null ? $("#country")
								.val() : "",
						state : $("#state").val(),
						user : $("#user").val(),
						startMonth : $("#startMonth").val(),
						endMonth : $("#endMonth").val(),
						beforeMonth : $("#beforeMonth").val(),
						afterMonth : $("#afterMonth").val(),
						onMonth : $("#onMonth").val(),
						confirmFlag : $("#confirmBox").prop("checked") == true ? "1"
								: "0",
						confirmStartMonth : $("#confirmStartMonth").val(),
						confirmEndMonth : $("#confirmEndMonth").val(),
						ftFlag : $("#ftBox").prop("checked") == true ? "1"
								: "0",
						ftStartMonth : $("#ftStartMonth").val(),
						ftEndMonth : $("#ftEndMonth").val()
					},
					dataType : "json",
					timeout : 15000,
					beforeSend : function(XMLHttpRequest) {
						resetResult();
						$("#loading").show();
					},
					success : function(data, textStatus) {
						resetResult();
						$("#loading").hide();
						if (data) {
							createEchart();
							window.result = eval(data);
							var target = parseInt(result[0].value);
							var rest = parseInt(result[1].value);
							var sum = target + rest;
							var pro = Math.round(target / sum * 10000) / 100.00
									+ "%";
							var answer = "The answer is: <span class='red'>"
									+ target
									+ "</span>, its percentage of total system is: <span class='red'>"
									+ pro + "</span>.";
							$("#resulttext").html(answer);
							$.getScript('js/tempProportion.js', {}, function() {
							});
						} else {
							$("#resultcount").html("No data");
							$("#resulttext").html("");
						}
					},
				});
	}
}

function displayResult(data) {
	var count_all = data.arr.length;
	var count_distinct = data.count_distinct;
	var anscount_all = "<h4> The total number is: <strong>" + count_all
			+ "</strong><h4>.<br/>";
	var anscount_distinct = "<h4>There are <strong>" + count_distinct
			+ "</strong> different users.</h4>";
	$("#resultcount").html(anscount_all + anscount_distinct);

	var table = $("<table class= 'table table-striped table-hover' border='1'></table>");
	table.append("<caption>Answer Details</caption>");
	table
			.append("<tr><th>NO.</th><th width='10%'>Userid</th><th width='15%'>Firstname</th><th width='10%'>Lastname</th><th width='8%'>Flag</th><th width='8%'>Isfirst</th><th width='10%'>Insertmonth</th><th width='8%'>Sex</th><th width='10%'>Country</th><th width='10%'>Confirmtime</th><th width='10%'>Altername</th></tr>");
	for ( var i = 0; i < count_all; i++) {
		var tr = $("<tr></tr>");
		var td = "<td>" + (i + 1) + "</td>";
		tr.append(td);
		for ( var j = 0; j < 10; j++) {
			var ans = "<td>" + data.arr[i][j] + "</td>";
			var td = $(ans);
			tr.append(td);
		}
		table.append(tr);
	}
	$("#resulttext").html(table);
}

function resetResult() {
	$("#resultcount").html("");
	$("#resulttext").html("");
	$("#main").remove();
}

function createEchart() {
	var main = "<div id='main' style='height: 400px;'></div>";
	$("#dialog").append(main);
}

function createCondition1() {
	var str = " client {";
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
	str += " }";
	return str;
}

function createCondition2() {
	var str = " client {";
	if ($("#dump_sex").val() != "") {
		str += " sex: " + $("#dump_sex").val() + " , ";
	}
	if ($("#dump_country").val() != "" && $("#dump_country").val() != null) {
		str += " country: [" + $("#dump_country").val() + "], ";
	}
	if ($("#dump_state").val() != "") {
		str += " eligible state: " + $("#dump_state").val() + " , ";
	}
	if ($("#dump_user").val() != "") {
		str += " user type: " + $("#dump_user").val() + "  ";
	}
	str += "}";
	return str;
}

function createDate() {
	var str = "";
	if ($("#s11").val() != "") {
		str += " from " + $("#s11").val();
	}
	if ($("#s12").val() != "") {
		str += " to " + $("#s12").val();
	}
	return str;
}
