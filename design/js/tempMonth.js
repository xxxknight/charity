// 使用
require([ 'echarts', 'echarts/chart/bar' // 使用柱状图就加载bar模块，按需加载
], function(ec) {
	// 基于准备好的dom，初始化echarts图表
	var myChart = ec.init(document.getElementById('ec1'));
	option = {
		title : {
			text : 'The number of attendence in the last 3 months',
			x : 'center',
		},
		tooltip : {
			trigger : 'axis'
		},
		legend : {
			data : [ 'inside', 'outside', 'sum' ],
			x : 'left',
		},
		toolbox : {
			show : true,
			feature : {
				dataView : {
					show : true,
					readOnly : false
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
		xAxis : [ {
			type : 'category',
			data : montharr1
		} ],
		yAxis : [ {
			type : 'value'
		} ],
		series : [ {
			name : 'inside',
			type : 'bar',
			data : arr_M1,
			markPoint : {
				data : [ {
					type : 'max',
					name : 'max'
				}, {
					type : 'min',
					name : 'min'
				} ]
			},
		}, {
			name : 'outside',
			type : 'bar',
			data : arr_E1,
			markPoint : {
				data : [ {
					type : 'max',
					name : 'max'
				}, {
					type : 'min',
					name : 'min'
				} ]
			},
		}, {
			name : 'sum',
			type : 'bar',
			data : arr_T1,
			markPoint : {
				data : [ {
					type : 'max',
					name : 'max'
				}, {
					type : 'min',
					name : 'min'
				} ]
			},
		} ]
	};
	// 为echarts对象加载数据
	myChart.setOption(option);
	var myChart2 = ec.init(document.getElementById('ec2'));
	option2 = {
		title : {
			text : 'The number of attendence in the last year',
			x : 'center',
		},
		tooltip : {
			trigger : 'axis'
		},
		legend : {
			data : [ 'inside', 'outside', 'sum' ],
			x : 'left',
		},
		toolbox : {
			show : true,
			feature : {
				dataView : {
					show : true,
					readOnly : false
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
		xAxis : [ {
			type : 'category',
			data : montharr2
		} ],
		yAxis : [ {
			type : 'value'
		} ],
		series : [ {
			name : 'inside',
			type : 'bar',
			data : arr_M2,
			markPoint : {
				data : [ {
					type : 'max',
					name : 'max'
				}, {
					type : 'min',
					name : 'min'
				} ]
			},
		}, {
			name : 'outside',
			type : 'bar',
			data : arr_E2,
			markPoint : {
				data : [ {
					type : 'max',
					name : 'max'
				}, {
					type : 'min',
					name : 'min'
				} ]
			},
		}, {
			name : 'sum',
			type : 'bar',
			data : arr_T2,
			markPoint : {
				data : [ {
					type : 'max',
					name : 'max'
				}, {
					type : 'min',
					name : 'min'
				} ]
			},
		} ]
	};
	// 为echarts对象加载数据
	myChart2.setOption(option2);
});