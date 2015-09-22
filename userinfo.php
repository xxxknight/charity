<?php
include 'dbin.php';
//echo $selected;

$query = "SELECT * FROM userinfo";

$result = mysqli_query($mysql,$query);
if($result == "") {
	echo " fail to query.";
	exit;
}

?>


<head>

<link rel="stylesheet" type="text/css" href="update/DataTables/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="update/DataTables/css/bootstrap.2.3.2.css">
<!-- jQuery -->
<script type="text/javascript" src="update/DataTables/js/jquery-1.10.2.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="update/DataTables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="update/DataTables/js/bootstrap.min.js"></script>
<script type="text/javascript" src="update/DataTables/js/datatables.js"></script>


<script>
$(document).ready(function() {
  $('#example').dataTable( {
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

<body>
  <header id="header" class="site-header" role="banner">
	    <div class="container">
		<div class="row">
		    
		    <div class="col-md-4 logo">
			<a href="index.php"><h1 style="margin-top:10px; float:left">London Charity</h1></a>
			<form action="saveuinfo.php" method="post">
				<input type="submit" style="float:right" title="click to save data of this month" id="saveData" value="savedata"/>
			</form>
		
		    </div> <!-- //.logo -->  
		</div> <!-- //.row -->
	    </div> <!-- //.container -->
            
    </header>
<div class="container">       
<table id="example" class="display" cellspacing="0" width="100%" ">
        <thead>
            <tr>
                <th>id</th>
			    <th>first name</th>
			    <th>sex</th>
			    <th>country</th>
			    <th>eligible state</th>
			    <th>confirm date</th>
			    <th>altername</th>
			    <th>basic notes</th>
            </tr>
        </thead>
 

 
        <tbody>
            <?php while ($num_rows = mysqli_fetch_array($result)){ 
	//echo $num_rows;
?>
	  <tr>
	    <td> <?php echo $num_rows["Id"]?></td>
	    <td><?php echo $num_rows["firstname"]?></td>
	    <td><?php echo $num_rows["sex"]?></td>
	    <td><?php echo $num_rows["country"]?></td>
	    <td><?php echo $num_rows["eligible"]?></td>
	    <td><?php echo $num_rows["confirmtime"];?> </td>
	    <td><?php echo $num_rows["altername"]?></td>
	    <td><?php echo $num_rows["basicnote"]?></td>
	  </tr>
<?php }?>
 
</table>
</div>

</body>
            