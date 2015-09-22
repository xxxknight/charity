require([ 'echarts', 'echarts/chart/line', ], function(ec) {

	var myChart4 = ec.init(document.getElementById('main'));
	var option4 = {
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
                    for(var i=0;i<arr_month.length;i++){
	                   str+=" "+(i+1)+".  "+arr_month[i]+" => "+arr_num[i]+"<br/>";
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
			data : arr_month,
		} ],
		yAxis : [ {
			type : 'value',

		} ],
		series : [ {
			name : 'quanity',
			type : 'line',
			data : arr_num,
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
	myChart4.setOption(option4);
});