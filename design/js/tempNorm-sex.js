// 使用
require([ 'echarts', 'echarts/chart/pie', ], function(ec) {
	var myChart4 = ec.init(document.getElementById('p4'));
	var option4 = {
		title : {
			text : 'The proportion of sex',
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
			data : countSex
		} ]
	};
	// 为echarts对象加载数据
	myChart4.setOption(option4);
});