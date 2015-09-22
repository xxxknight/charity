$(function() {
	$("#commit1").click(function() {
		var start1 = $("#start1").val();
		var end1 = $("#end1").val();
		$.post("answer/normAnswer.php", {
			flag : "f1",
			startTime : start1,
			endTime : end1,
		}, function(data) {
			var arr = eval(data);
			window.country = arr[0];
			window.countCountry = arr[1];
			$.getScript('js/tempNorm-country.js', {}, function() {
			});
		}, "json");
	});

	$("#commit2").click(function() {
		var start2 = $("#start2").val();
		var end2 = $("#end2").val();
		$.post("answer/normAnswer.php", {
			flag : "f2",
			startTime : start2,
			endTime : end2,
		}, function(data) {
			var arr = eval(data);
			window.region = arr[0];
			window.countRegion = arr[1];
			$.getScript('js/tempNorm-region.js', {}, function() {
			});
		}, "json");
	});

	$("#commit3").click(function() {
		var start3 = $("#start3").val();
		var end3 = $("#end3").val();
		$.post("answer/normAnswer.php", {
			flag : "f3",
			startTime : start3,
			endTime : end3,
		}, function(data) {
			var arr = eval(data);
			window.countAge = arr;
			$.getScript('js/tempNorm-age.js', {}, function() {
			});
		}, "json");
	});

	$("#commit4").click(function() {
		var start4 = $("#start4").val();
		var end4 = $("#end4").val();
		$.post("answer/normAnswer.php", {
			flag : "f4",
			startTime : start4,
			endTime : end4,
		}, function(data) {
			var arr = eval(data);
			window.countSex = arr;
			$.getScript('js/tempNorm-sex.js', {}, function() {
			});
		}, "json");
	});

	$("#commit5").click(function() {
		var start5 = $("#start5").val();
		var end5 = $("#end5").val();
		$.post("answer/normAnswer.php", {
			flag : "f5",
			startTime : start5,
			endTime : end5,
		}, function(data) {
			var arr = eval(data);
			window.trend = arr[0];
			window.countTrend = arr[1];
			$.getScript('js/tempNorm-trend.js', {}, function() {
			},"json");
		});
	});

});
