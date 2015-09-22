require([ 'echarts', 'echarts/chart/pie', ], function(ec) {

	var myChart = ec.init(document.getElementById('main'));
	var option = {
		title : {
			text : 'The proportion of total system',
			x : 'center'
		},
		tooltip : {
			trigger : 'item',
			formatter : "{a} <br/>{b} : {c} ({d}%)"
		},
		toolbox : {
			show : true,
			feature : {
				dataView : {
					show : true,
					readOnly : true
				},
				saveAsImage : {
					show : true
				},
				restore : {
					show : true
				},
			}
		},
		calculable : true,
		series : [ {
			name : 'The proportion of',
			type : 'pie',
			radius : '55%',
			center : [ '50%', '60%' ],
			data : result,
		} ]
	};
	// 为echarts对象加载数据
	myChart.setOption(option);
});