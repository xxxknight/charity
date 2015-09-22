<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>updateAttend</title>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="DataTables/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="DataTables/css/bootstrap.2.3.2.css">
 
<!-- jQuery -->
<script type="text/javascript" src="DataTables/js/jquery-1.10.2.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="DataTables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="DataTables/js/bootstrap.min.js"></script>
<script type="text/javascript" src="DataTables/js/action.js"></script>
<script type="text/javascript" src="DataTables/js/datatables.js"></script>

</head>
<body>
<div class="container">	
	<div class="row">		    
		    <div class="col-md-4 logo  site-header">
			<a href="../index.php"><h1 style="margin-top:10px">London Charity</h1></a>
		    </div> <!-- //.logo -->
	</div>
</div>
<!-- 表格开始 -->
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" style="width:90%"
       id="example">
    <thead>
    <tr>
        <th style="width:5px"><input type="checkbox" id='checkAll'></th>
        <th>id</th>
        <th>userid</th>
        <th>flag</th>
        <th>insertmonth</th>
        <th>isfirst</th>
        <th>handle</th>
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- 表格结束 -->

<!-- Modal -->
<div id="myModal" class="modal hide fade" data-backdrop="false">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        </button>
        <h3 id="myModalLabel">attend info</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" id="resForm">
            <input type="hidden" id="objectId"/>

            <div class="control-group">
                <label class="control-label" for="inputUserid">userid：</label> <input
                    type="text" id="inputUserid" name="userid"/>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputFlag">flag：</label> <input
                    type="text" id="inputFlag" name="flag"/>
            </div><div class="control-group">
                <label class="control-label" for="inputInsertmonth">insertmonth：</label> <input
                    type="text" id="inputInsertmonth" name="insertmonth"/>
            </div><div class="control-group">
                <label class="control-label" for="inputIsfirst">isfirst：</label> <input
                    type="text" id="inputIsfirst" name="isfirst"/>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" id="btnSave">confirm</button>
        <button class="btn btn-primary" id="btnEdit">save</button>
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">cancel</button>
    </div>
</div>
</body>
</html>


