require([ 'echarts', 'echarts/chart/bar', ], function(ec) {

	var myChart1 = ec.init(document.getElementById('main'));
	var option1 = {
		title : {
			text : 'The Compare Result',
			x : 'center'
		},
		tooltip : {
			show : true
		},
		toolbox : {
			show : true,
			feature : {
				dataView : {
					show : true,
					readOnly:true,
                    optionToContent :function(){
                    var str ="data format :{condition => quanity} <br/>";//在图的备注里面，是表示数只见的关系的
                    for(var i=0;i<timeperiod.length;i++){
	                   str+=" "+(i+1)+".  "+timeperiod[i]+" => "+num[i]+"<br/>";
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
			data : timeperiod
		} ],
		yAxis : [ {
			type : 'value'
		} ],
		series : [ {
			"name" : "quanity",
			"type" : "bar",
			"data" : num
		} ]
	};

	// 为echarts对象加载数据
	myChart1.setOption(option1);
});