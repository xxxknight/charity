var age = [ '1950s', '1960s', '1970s', '1980s', '1990s', '2000s','other' ];
require([ 'echarts', 'echarts/chart/bar', // 使用柱状图就加载bar模块，按需加载
], function(ec) {

	var myChart3 = ec.init(document.getElementById('p3'));
	var option3 = {
		title : {
			text : 'The distribution of age',
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
                    var str ="data format :{age => quanity} <br/>";
                    for(var i=0;i<age.length;i++){
	                   str+=" "+(i+1)+".  "+age[i]+" => "+countAge[i]+"<br/>";
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
			data : age
		} ],
		yAxis : [ {
			type : 'value'
		} ],
		series : [ {
			"name" : "quanity",
			"type" : "bar",
			itemStyle : {
				normal : {
					color : function(params) {
						// build a color map as your need.
						var colorList = [ '#D7504B', '#C6E579', '#F4E001',
								'#F0805A', '#26C0C0', '#C1232B', '#B5C334',
								'#FCCE10', '#E87C25', '#27727B', '#FE8463',
								'#9BCA63', '#FAD860', '#F3A43B', '#60C0DD',

						];
						return colorList[params.dataIndex]
					},
					label : {
						show : true,
						position : 'top',
						formatter : '{b}\n{c}'
					}
				}
			},
			"data" : countAge
		} ]
	};

	// 为echarts对象加载数据
	myChart3.setOption(option3);
});