var oTable;
$(document).ready(function() {
	initModal();
	oTable = initTable();
	$('#exmaple').DataTable();
	$("#btnEdit").hide();
	$("#btnSave").click(_addFun);
	$("#btnEdit").click(_editFunAjax);
	$("#deleteFun").click(_deleteList);
	// checkbox全选
	$("#checkAll").on("click", function() {
		if ($(this).is(":checked") == true) {
			$("input[name='checkList']").prop("checked", true);
		} else {
			$("input[name='checkList']").prop("checked", false);
		}
	});
});

/**
 * 表格初始化
 * 
 * @returns {*|jQuery}
 */
function initTable() {
	var table = $("#example")
			.dataTable(
					{
						// "iDisplayLength":10,
						"sAjaxSource" : "datalist.php",
						'bPaginate' : true,
						"bDestory" : true,
						"bRetrieve" : true,
						"bFilter" : true,
						"bSort" : false,
						"bInfo":false,
						"bProcessing" : true,
						// "dom": '<"top""myBtnBox">rt<"bottom"flp><"clear"i>',
						// "sDom":'<"top"iflp<"clear">>rt<"bottom"ilp<"clear">>'
						"sDom" : "<'row-fluid'<'span6 myBtnBox'><'span6'f>r>t<'row-fluid'<'span6'l><'span6 'ip>>",
						// "sPaginationType": "bootstrap",
						"aoColumns" : [
								{
									"mDataProp" : "Id",
									"fnCreatedCell" : function(nTd, sData,
											oData, iRow, iCol) {
										$(nTd).html(
												"<input type='checkbox' name='checkList' value='"
														+ sData + "'>");

									}
								},
								{
									"mDataProp" : "Id"
								},
								{
									"mDataProp" : "firstname"
								},
								{
									"mDataProp" : "lastname"
								},
								{
									"mDataProp" : "sex"
								},
								{
									"mDataProp" : "birth"
								},
								{
									"mDataProp" : "country"
								},
								{
									"mDataProp" : "region"
								},
								{
									"mDataProp" : "eligible"
								},
								{
									"mDataProp" : "confirmtime"
								},
								{
									"mDataProp" : "altername"
								},
								{
									"mDataProp" : "newin"
								},
								{
									"mDataProp" : "solicitorid"
								},
								{
									"mDataProp" : "bnote"
								},
								{
									"mDataProp" : "Id",
									"fnCreatedCell" : function(nTd, sData,oData, iRow, iCol) {
										$(nTd).html("<a href='javascript:void(0);' " + "onclick='_editFun(\""+ oData.Id + "\",\"" + oData.firstname + "\",\"" + oData.lastname
												+ "\",\"" + oData.sex
												+ "\",\"" + oData.birth
												+ "\",\"" + oData.country
												+ "\",\"" + oData.region
												+ "\",\"" + oData.eligible
												+ "\",\"" + oData.confirmtime
												+ "\",\"" + oData.altername
												+ "\",\"" + oData.newin
												+ "\",\"" + oData.solicitorid
												+ "\",\"" + oData.bnote
												+ "\")'>edit</a>&nbsp;&nbsp;")
												.append("<a href='javascript:void(0);' onclick='_deleteFun(" + sData + ")'>delete</a>");
							    }
						}, ],
						"fnCreatedRow" : function(nRow, aData, iDataIndex) {
							// add selected class
							$(nRow)
									.click(
											function() {
												if ($(this).hasClass(
														'row_selected')) {
													$(this).removeClass(
															'row_selected');
												} else {
													oTable
															.$(
																	'tr.row_selected')
															.removeClass(
																	'row_selected');
													$(this).addClass(
															'row_selected');
												}
											});
						},
						"fnInitComplete" : function(oSettings, json) {
							$(
									'<a href="#myModal" id="addFun" class="btn btn-primary" data-toggle="modal">add</a>'
											+ '&nbsp;'
											//+ '<a href="#" class="btn btn-primary" id="editFun">modify</a> '
											+ '&nbsp;'
											+ '<a href="#" class="btn btn-danger" id="deleteFun">delete</a>'
											+ '&nbsp;')
									.appendTo($('.myBtnBox'));
							$("#deleteFun").click(_deleteList);
							$("#editFun").click(_value);
							$("#addFun").click(_init);
						}
					});
	return table;
}



/**
 * 赋值
 * 
 * @private
 */
function _value() {
	var arr =new Array();
	$("input[name='checkList']:checked").each(function(i, o) {
		arr.push($(this).val());
	});
	if (arr.length == 1) {
		if (oTable.$('tr.row_selected').get(0)) {
			$("#btnEdit").show();
			var selected = oTable.fnGetData(oTable.$('tr.row_selected').get(0));
			$("#objectId").val(selected.Id);
			$("#inputName").val(selected.firstname);
			$("#inputLastname").val(selected.lastname);
			$("#inputSex").val(selected.sex);
			$("#inputBirth").val(selected.birth);
			$("#inputCountry").val(selected.country);
			$("#inputRegion").val(selected.region);
			$("#inputEligible").val(selected.eligible);
			$("#inputCtime").val(selected.confirmtime);
			$("#inputAname").val(selected.altername);
			$("#inputNewin").val(selected.newin);
			$("#inputSolicitorid").val(selected.solicitorid);
			$("#inputBnote").val(selected.basicnote);
			$("#myModal").modal("show");
			$("#btnSave").hide();
		} 
	} else if(arr.length >1){
		alert('you have chosen more than one option');
	}else {
		alert('Please select an record before doing any option.');
	}
}

/**
 * 编辑数据带出值
 * 
 * @param id
 * @param name
 * @param job
 * @param note
 * @private
 */
function _editFun(Id, firstname, lastname, sex, birth, country, region,
		eligible, confirmtime, altername, newin,solicitorid,basicnote) {
	$("#objectId").val(Id);
	$("#inputName").val(firstname);
	$("#inputLastname").val(lastname);
	$("#inputSex").val(sex);
	$("#inputBirth").val(birth);
	$("#inputCountry").val(country);
	$("#inputRegion").val(region);
	$("#inputEligible").val(eligible);
	$("#inputCtime").val(confirmtime);
	$("#inputAname").val(altername);
	$("#inputNewin").val(newin);
	$("#inputSolicitorid").val(solicitorid);
	$("#inputBnote").val(basicnote);
	$("#myModal").modal("show");
	$("#btnSave").hide();
	$("#btnEdit").show();
}

/**
 * 初始化
 * 
 * @private
 */
function _init() {
	$("#btnEdit").hide();
	$("#btnSave").show();
	resetForm();
}

/**
 * 添加数据
 * 
 * @private
 */
function _addFun() {
	if(!validate()){
		return false;
	}
	var jsonData = {
		'firstname' : $("#inputName").val(),
		'lastname' : $("#inputLastname").val(),
		'sex' : $("#inputSex").val(),
		'birth' : $("#inputBirth").val(),
		'country' : $("#inputCountry").val(),
		'region' : $("#inputRegion").val(),
		'eligible' : $("#inputEligible").val(),
		'confirmtime' : $("#inputCtime").val(),
		'altername' : $("#inputAname").val(),
		'newin' : $("#inputNewin").val(),
	    'solicitorid' :  $("#inputSolicitorid").val(),
		'basicnote' : $("#inputBnote").val()
	};
	$.ajax({
		url : "insertFun.php",
		data : jsonData,
		type : "post",
		success : function(backdata) {
			//alert(backdata);
			if (backdata == 1) {
				$("#myModal").modal("hide");
				resetForm();
				oTable.fnReloadAjax(oTable.fnSettings());
			} else {
				alert("insert failure");
			}
		},
		error : function(error) {
			console.log(error);
		}
	});
}

/*
 * add this plug in // you can call the below function to reload the table with
 * current state Datatables刷新方法 oTable.fnReloadAjax(oTable.fnSettings());
 */
$.fn.dataTableExt.oApi.fnReloadAjax = function(oSettings) {
	// oSettings.sAjaxSource = sNewSource;
	this.fnClearTable(this);
	this.oApi._fnProcessingDisplay(oSettings, true);
	var that = this;

	$.getJSON(oSettings.sAjaxSource, null, function(json) {
		/* Got the data - add it to the table */
		for ( var i = 0; i < json.aaData.length; i++) {
			that.oApi._fnAddData(oSettings, json.aaData[i]);
		}
		oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
		that.fnDraw(that);
		that.oApi._fnProcessingDisplay(oSettings, false);
	});
}

/**
 * 编辑数据
 * 
 * @private
 */
function _editFunAjax() {
	if(!validate()){
		return false;
	}
	var Id = $("#objectId").val();
	var firstname = $("#inputName").val();
	var lastname = $("#inputLastname").val();
	var sex = $("#inputSex").val();
	var birth = $("#inputBirth").val();
	var country = $("#inputCountry").val();
	var region = $("#inputRegion").val();
	var eligible = $("#inputEligible").val();
	var confirmtime = $("#inputCtime").val();
	var altername = $("#inputAname").val();
	var newin = $("#inputNewin").val();
	var solicitorid = $("#inputSolicitorid").val();
	var basicnote = $("#inputBnote").val();

	var jsonData = {
		"Id" : Id,
		"firstname" : firstname,
		"lastname" : lastname,
		"sex" : sex,
		"birth" : birth,
		"country" : country,
		"region" : region,
		"eligible" : eligible,
		"confirmtime" : confirmtime,
		"altername" : altername,
		"newin" : newin,
		"solicitorid" : solicitorid,
		"basicnote" : basicnote
	};
	$.ajax({
		type : 'POST',
		url : 'editFun.php',
		data : jsonData,
		success : function(backdata) {
			//alert(backdata);
			if (backdata) {
				$("#myModal").modal("hide");
				resetForm();
				oTable.fnReloadAjax(oTable.fnSettings());
			} else {
				alert("update failure");
			}
		}
	});
}
/**
 * 初始化弹出层
 */
function initModal() {
	$('#myModal').on(
			'show',
			function() {
				$('body', document).addClass('modal-open');
				$('<div class="modal-backdrop fade in"></div>').appendTo(
						$('body', document));
			});
	$('#myModal').on('hide', function() {
		$('body', document).removeClass('modal-open');
		$('div.modal-backdrop').remove();
	});
}

/**
 * 重置表单
 */
function resetForm() {
	$('form').each(function(index) {
		$('form')[index].reset();
	});
}

/**
 * 删除
 * 
 * @param id
 * @private
 */
function _deleteFun(Id) {
	var str = "you are going to delete id : "+Id;
	if(confirm(str)){
		$.ajax({
		url : "deleteFun.php",
		data : {
			"Id" : Id
		},
		type : "post",
		success : function(backdata) {
			if (backdata) {
				oTable.fnReloadAjax(oTable.fnSettings());
			} else {
				alert("delete failure");
			}
		},
		error : function(error) {
			console.log(error);
		}
	});
	}
}

/**
 * 批量删除 
 * 
 * @private
 */
function _deleteList() {
	var arr =new Array();
	$("input[name='checkList']:checked").each(function(i, o) {
		arr.push($(this).val());
	});
	if (arr.length > 0) {
		_deleteFun(arr);
	} else {
		alert("select at least one data");
	}
}

function validate(){
	var firstname = $("#inputName").val();
	var lastname = $("#inputLastname").val();
	var sex = $("#inputSex").val();
	var birth =  $("#inputBirth").val();
	var country = $("#inputCountry").val();
	var region = $("#inputRegion").val();
	var eligible = $("#inputEligible").val();
	var confirmtime = $("#inputCtime").val();
	var altername = $("#inputAname").val();
	var newin = $("#inputNewin").val();
	var solicitorid = $("#inputSolicitorid").val();
	if(firstname==""){
		alert("please input firstname!");
		return false;
	}
	if(sex =="" || (sex!="M" && sex !="F" )){
		alert("please input right format sex(M/F)!");
		return false;
	}
	
	if(eligible =="" || (eligible!="F" && eligible !="T" )){
		alert("please input right format eligible(T/F)!");
		return false;
	}
	if(birth!="" && !checkDate(birth)){
		alert("please input right format birth(0000-00-00)!");
		return false;
	}
	if(confirmtime!="" && !checkDate(confirmtime)){
		alert("please input right format confirmtime(0000-00-00)!");
		return false;
	}
	if(newin!="" && !checkDate(newin)){
		alert("please input right format new in(0000-00)!");
		return false;
	}
	if(solicitorid!="" && !checkNum(solicitorid)){
		alert("please input right format solicitorid!");
		return false;
	}
	return true;
}

function checkNum(num){
	var re = /^[0-9]*[1-9][0-9]*$/ ;  
	return re.test(num);  
}

function checkTelenumber(telenumber) {
    var re = /^\d+(\-\d+)*$/;
	return re.test(telenumber);  
}

function checkDate(date){
	var re = /^\d{4}(-\d{2}){1,2}$/;
	return re.test(date);
}

