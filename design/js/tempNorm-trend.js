require([ 'echarts', 'echarts/chart/line', ], function(ec) {

	var myChart5 = ec.init(document.getElementById('p5'));
	var option5 = {
		title : {
			text : 'The trend of attendance',
			x : 'center'
		},
		tooltip : {
			trigger : 'axis'
		},
		legend : {
			data : [ 'quanity' ],
			x : 'left',
		},
		toolbox : {
			show : true,
			feature : {
				dataView : {
					show : true,
					readOnly:true,
                    optionToContent :function(){
                    var str ="data format :{month => quanity} <br/>";
                    for(var i=0;i<trend.length;i++){
	                   str+=" "+(i+1)+".  "+trend[i]+" => "+countTrend[i]+"<br/>";
                    }
                       return str;
                  },
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
			boundaryGap : false,
			data : trend,
		} ],
		yAxis : [ {
			type : 'value',

		} ],
		series : [ {
			name : 'quanity',
			type : 'line',
			data : countTrend,
			markPoint : {
				data : [ {
					type : 'max',
					name : 'Max'
				}, {
					type : 'min',
					name : 'Min'
				} ]
			},
		},

		]
	};

	// 为echarts对象加载数据
	myChart5.setOption(option5);
});