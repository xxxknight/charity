
/** --------------------------------------for userinfo---------------------------------------------*/

var oTable;
$(document).ready(function () {
    initModal();
    oTable = initTable();
    $("#btnEdit").hide();
    $("#btnSave").click(_addFun);
    $("#btnEdit").click(_editFunAjax);
    $("#deleteFun").click(_deleteList);
    //checkboxȫѡ
    $("#checkAll").live("click", function () {
        if ($(this).attr("checked") === "checked") {
            $("input[name='checkList']").attr("checked", $(this).attr("checked"));
        } else {
            $("input[name='checkList']").attr("checked", false);
        }
    });
});

/**
 * ����ʼ��
 * @returns {*|jQuery}
 */

function initTable() {
    var table = $("#example").dataTable({
        //"iDisplayLength":10,
        "sAjaxSource": "userinfo2.php",
        'bPaginate': true,
        "bDestory": true,
        "bRetrieve": true,
        "bFilter":false,
        "bSort": false,
        "bProcessing": true,
        "aoColumns": [
            {
                "mDataProp": "Id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<input type='checkbox' name='checkList' value='" + sData + "'>");
 
                }
            },
            {"mDataProp": "firstname"},
            {"mDataProp": "sex"},
            {"mDataProp": "birth"},
            {"mDataProp": "country"},
            {"mDataProp": "eligible"},
            {"mDataProp": "confirmtime"},
            {"mDataProp": "altername"},
            {"mDataProp": "note"},
            {
                "mDataProp": "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='javascript:void(0);' " +
                    "onclick='_editFun(\"" + oData.Id + "\",\"" + oData.firstname + "\",\"" + oData.sex + "\",\"" + oData.birth + "\",\"" + oData.country + "\",\"" + oData.eligible + "\",\"" + oData.confirmtime + "\",\"" + oData.altername + "\",\"" + oData.note + "\")'>�༭</a>&nbsp;&nbsp;")
                        .append("<a href='javascript:void(0);' onclick='_deleteFun(" + sData + ")'>ɾ��</a>");
                }
            },
        ],
        "sDom": "<'row-fluid'<'span6 myBtnBox'><'span6'f>r>t<'row-fluid'<'span6'i><'span6 'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sUrl": "../resources/user_share/basic_curd/jsplugin/datatables/zh-CN.txt",
            "sSearch": "���ٹ��ˣ�"
        },
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
            //add selected class
            $(nRow).click(function () {
                if ($(this).hasClass('row_selected')) {
                    $(this).removeClass('row_selected');
                } else {
                    oTable.$('tr.row_selected').removeClass('row_selected');
                    $(this).addClass('row_selected');
                }
            });
        },
        "fnInitComplete": function (oSettings, json) {
            $('<a href="#myModal" id="addFun" class="btn btn-primary" data-toggle="modal">����</a>' + '&nbsp;' +
            '<a href="#" class="btn btn-primary" id="editFun">�޸�</a> ' + '&nbsp;' +
            '<a href="#" class="btn btn-danger" id="deleteFun">ɾ��</a>' + '&nbsp;').appendTo($('.myBtnBox'));
            $("#deleteFun").click(_deleteList);
            $("#editFun").click(_value);
            $("#addFun").click(_init);
        }
    });
    return table;
}

 
/**
 * ɾ��
 * @param id
 * @private
 */
function _deleteFun(id) {
    $.ajax({
        url: "deleteFun.php",
        data: {"id": id},
        type: "post",
        success: function (backdata) {
            if (backdata) {
                oTable.fnReloadAjax(oTable.fnSettings());
            } else {
                alert("ɾ��ʧ��");
            }
        }, error: function (error) {
            console.log(error);
        }
    });
}
 
/**
 * ��ֵ
 * @private
 */
function _value() {
    if (oTable.$('tr.row_selected').get(0)) {
        $("#btnEdit").show();
        var selected = oTable.fnGetData(oTable.$('tr.row_selected').get(0));
        $("#inputName").val(selected.name);
        $("#inputJob").val(selected.job);
        $("#inputDate").val(selected.date);
        $("#inputNote").val(selected.note);
        $("#objectId").val(selected.id);
 
        $("#myModal").modal("show");
        $("#btnSave").hide();
    } else {
        alert('����ѡ��һ����¼�������');
    }
}
 
/**
 * �༭���ݴ���ֵ
 * @param id
 * @param name
 * @param job
 * @param note
 * @private
 */
function _editFun(id, name, job, note) {
    $("#inputName").val(name);
    $("#inputJob").val(job);
    $("#inputNote").val(note);
    $("#objectId").val(id);
    $("#myModal").modal("show");
    $("#btnSave").hide();
    $("#btnEdit").show();
}
 
/**
 * ��ʼ��
 * @private
 */
function _init() {
    resetFrom();
    $("#btnEdit").hide();
    $("#btnSave").show();
}
 
/**
 * �������
 * @private
 */
function _addFun() {
    var jsonData = {
        'name': $("#inputName").val(),
        'job': $("#inputJob").val(),
        'note': $("#inputNote").val()
    };
    $.ajax({
        url: "insertFun.php",
        data: jsonData,
        type: "post",
        success: function (backdata) {
            if (backdata == 1) {
                $("#myModal").modal("hide");
                resetFrom();
                oTable.fnReloadAjax(oTable.fnSettings());
            } else if (backdata == 0) {
                alert("����ʧ��");
            } else {
                alert("��ֹ���ݲ�����������Ӱ���ٶȣ�����ɾ��һЩ������������");
            }
        }, error: function (error) {
            console.log(error);
        }
    });
}
 
 
/*
 add this plug in
 // you can call the below function to reload the table with current state
 Datatablesˢ�·���
 oTable.fnReloadAjax(oTable.fnSettings());
 */
$.fn.dataTableExt.oApi.fnReloadAjax = function (oSettings) {
    //oSettings.sAjaxSource = sNewSource;
    this.fnClearTable(this);
    this.oApi._fnProcessingDisplay(oSettings, true);
    var that = this;
 
    $.getJSON(oSettings.sAjaxSource, null, function (json) {
        /* Got the data - add it to the table */
        for (var i = 0; i < json.aaData.length; i++) {
            that.oApi._fnAddData(oSettings, json.aaData[i]);
        }
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
        that.fnDraw(that);
        that.oApi._fnProcessingDisplay(oSettings, false);
    });
}
 
 
/**
 * �༭����
 * @private
 */
function _editFunAjax() {
    var id = $("#objectId").val();
    var name = $("#inputName").val();
    var job = $("#inputJob").val();
    var note = $("#inputNote").val();
    var jsonData = {
        "id": id,
        "name": name,
        "job": job,
        "note": note
    };
    $.ajax({
        type: 'POST',
        url: 'editFun.php',
        data: jsonData,
        success: function (json) {
            if (json) {
                $("#myModal").modal("hide");
                resetFrom();
                oTable.fnReloadAjax(oTable.fnSettings());
            } else {
                alert("����ʧ��");
            }
        }
    });
}
/**
 * ��ʼ��������
 */
function initModal() {
    $('#myModal').on('show', function () {
        $('body', document).addClass('modal-open');
        $('<div class="modal-backdrop fade in"></div>').appendTo($('body', document));
    });
    $('#myModal').on('hide', function () {
        $('body', document).removeClass('modal-open');
        $('div.modal-backdrop').remove();
    });
}
 
/**
 * ���ñ�
 */
function resetFrom() {
    $('form').each(function (index) {
        $('form')[index].reset();
    });
}
 
 
/**
 * ����ɾ��
 * δ��
 * @private
 */
function _deleteList() {
    var str = '';
    $("input[name='checkList']:checked").each(function (i, o) {
        str += $(this).val();
        str += ",";
    });
    if (str.length > 0) {
        var IDS = str.substr(0, str.length - 1);
        alert("��Ҫɾ�������ݼ�idΪ" + IDS);
    } else {
        alert("����ѡ��һ����¼����");
    }
}

/** --------------------------------------end userinfo---------------------------------------------*/