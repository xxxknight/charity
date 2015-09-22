<?php
include '../dbin.php';
//echo $selected;

$query = "SELECT * FROM userinfo";
$result = mysqli_query($mysql,$query);
if($result == "") {
	echo " fail to query.";
	exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="DataTables/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="DataTables/css/bootstrap.2.3.2.css">

<!-- jQuery -->
<script type="text/javascript" src="DataTables/js/jquery-1.10.2.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="DataTables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="DataTables/js/bootstrap.min.js"></script>
<script type="text/javascript" src="DataTables/js/soli.js"></script>
<script type="text/javascript" src="DataTables/js/datatables.js"></script>
<script language="javascript" type="text/javascript" src="../design/js/date97/WdatePicker.js"></script>

<script>
function sform(){
	if (document.getElementById("time").value==""){
		alert("must input a time value before submit the form");
				
	}
	else {document.getElementById("form").submit();}
	
}
	
	$(document).ready(function() {
	  $('#example2').dataTable( {
	    "paging":   true,
	    "ordering": true,
	   // "info":     Flase,
	    "bFilter" : true,
	  	"bLengthChange": true,
	  	"sDom" : "<'row-fluid'<'span6 myBtnBox'><'span6'f>r>t<'row-fluid'<'span6'l><'span6 'p>>",
	  } );
	} );

	
</script>
</head>
<header id="header" class="site-header" role="banner">
	    <div class="container">
		<div class="row">
		    
		    <div class="col-md-4 logo">
			<a href="../index.php"><h1 style="margin-top:10px; float:left">London Charity</h1></a>
		    </div> <!-- //.logo -->  
		</div> <!-- //.row -->
	    </div> <!-- //.container -->
            
    </header>
    <div style="padding-left:5%;padding-right:5%;">
<form id="form" name="form" method="post" action="updateatt.php">
<table id="example2" class="display" cellspacing="0" width="100%">
        <thead>
	       <tr>
	           <th>id</th>
			    <th>first name</th>
				<th>last name</th>
			    <th>country</th>
			    <th>eligible state</th>
			    <th>altername</th>
			    <th>basic notes</th>
			    <th>new   date: <input type="text" id="time" name = "time" onFocus="WdatePicker({onpicked:function(dp){showInfo();},dateFmt:'yyyy-MM'})" onchange="disable(3)" size="12" class="Wdate"/></th>
	       </tr>
   </thead>
 
 <?php while ($num_rows = mysqli_fetch_array($result)){ 
	//echo $num_rows;
?>
	  <tr>
	    <td><?php echo $num_rows["Id"]?></td>
	    <td><?php echo $num_rows["firstname"]?></td>
	    <td><?php echo $num_rows["lastname"]?></td>
	    <td><?php echo $num_rows["country"]?></td>
	    <td><?php echo $num_rows["eligible"]?></td>
	    <td><?php echo $num_rows["altername"]?></td>
	    <td><?php echo $num_rows["basicnote"]?></td>
	    
	    <td><?php 
	//$sql = "ALTER TABLE 'ucomeback' ADD '201501' varchar(20)";
	//mysql_query($sql);
	?>

			    <input type="radio" name="<?php echo $num_rows["Id"]?>" value="M" />As insider &nbsp
			    <input type="radio" name="<?php echo $num_rows["Id"]?>" value="E" />As outsider <br />
			    <input type="radio" name="<?php echo $num_rows["Id"]?>" value="O" />As first time client <br>
			    <input type="radio" name="<?php echo $num_rows["Id"]?>" value="F" checked="default"/> Not attend 
			
	    </td>
	  </tr>
<?php }
?>
</tbody>
      </table>
      <input class="btn  btn-primary btn-shadow" type = "button" id= "update" name="update" onclick="sform()" value="update">
 </form>
 </div>
      </html>
      




