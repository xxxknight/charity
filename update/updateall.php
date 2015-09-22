<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>norm</title>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="DataTables/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="DataTables/css/bootstrap.2.3.2.css">
 
<!-- jQuery -->
<script type="text/javascript" src="DataTables/js/jquery-1.10.2.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="DataTables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="DataTables/js/bootstrap.min.js"></script>
<script type="text/javascript" src="DataTables/js/index.js"></script>
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
        <th>Id</th>
        <th>firstname</th>
        <th>lastname</th>
        <th>sex</th>
        <th>birth</th>
        <th>country</th>
        <th>region</th>
        <th>eligible</th>
        <th>confirmtime</th>
        <th>altername</th>
        <th>new in</th>
        <th>solicitor id</th>
        <th>note</th>
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
        <h3 id="myModalLabel">user info</h3>
    </div>
    <div class="modal-body">
        <form class="form-horizontal" id="resForm">
            <input type="hidden" id="objectId"/>

            <div class="control-group">
                <label class="control-label" for="inputName">firstname：</label> <input
                    type="text" id="inputName" name="firstname"/>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputLastname">lastname：</label> <input
                    type="text" id="inputLastname" name="lastname"/>
            </div><div class="control-group">
                <label class="control-label" for="inputSex">sex：</label> <input
                    type="text" id="inputSex" name="sex"/>
            </div><div class="control-group">
                <label class="control-label" for="inputBirth">birth：</label> <input
                    type="text" id="inputBirth" name="birth"/>
            </div><div class="control-group">
                <label class="control-label" for="inputCountry">country：</label> <input
                    type="text" id="inputCountry" name="country"/>
            </div><div class="control-group">
                <label class="control-label" for="inputRegion">region：</label> <input
                    type="text" id="inputRegion" name="region"/>
            </div><div class="control-group">
                <label class="control-label" for="inputEligible">eligible：</label> <input
                    type="text" id="inputEligible" name="eligible"/>
            </div><div class="control-group">
                <label class="control-label" for="inputCtime">confirmtime：</label> <input
                    type="text" id="inputCtime" name="ctime"/>
            </div><div class="control-group">
                <label class="control-label" for="inputAname">altername：</label> <input
                    type="text" id="inputAname" name="aname"/>
            </div><div class="control-group">
                <label class="control-label" for="inputNewin">new in：</label> <input
                    type="text" id="inputNewin" name="newin"/>
            </div><div class="control-group">
                <label class="control-label" for="inputSolicitorid">solicitor id：</label> <input
                    type="text" id="inputSolicitorid" name="solicitorid"/>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputBnote">notes：</label>
                <textarea name="bnote" id="inputBnote" cols="30" rows="4"></textarea>
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


