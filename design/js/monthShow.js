$(function(){
	change();
	$("#confirm").click(function(){
			var Cmonth = $("#Cmonth").val();
			$.get("answer/monthAnswer.php", {
				Cmonth: Cmonth
			}, function(data) {
				var arr = eval(data);
				var newNum = data[0];
				$("#newNum").val(newNum);
				var ftNum = data[4][0];
				$("#ftNum").val(ftNum);
				window.montharr1 = arr[1];
				window.arr_M1 = arr[2];
				window.arr_E1 = arr[3];
				window.arr_T1 = arr[4];
				
				window.montharr2 = arr[5];
				window.arr_M2 = arr[6];
				window.arr_E2 = arr[7];
				window.arr_T2 = arr[8];
				$.getScript('js/tempMonth.js', {}, function() {
				});
			}, "json");
		});
	
})

function change(){
	var Cval = $("#Cmonth").val();
	$("#Dmonth").val(Cval); //为了保证save data的时候跟选择的month保持一致
}