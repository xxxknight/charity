require([ 'echarts', 'echarts/chart/bar', // 使用柱状图就加载bar模块，按需加载
], function(ec) {

	var myChart2 = ec.init(document.getElementById('p2'));
	var option2 = {
		title : {
			text : 'The distribution of region',
			subtext : 'Up to this point',
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
    	            var str ="data format :{region => quanity} <br/>";
    	            for(var i=0;i<region.length;i++){
        	            str+=" "+(i+1)+".  "+region[i]+" => "+countRegion[i]+"<br/>";
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
			data : region
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
			"data" : countRegion
		} ]
	};

	// 为echarts对象加载数据
	myChart2.setOption(option2);
});