
<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?php
include 'dbin.php';
//echo $selected;

$query = "SELECT Id,solicitorid,firstname,lastname FROM userinfo";

$result = mysqli_query($mysql,$query);
if($result == "") {
	echo " fail to query.";
	exit;
}

?>
<div> <?php include "header.php" ?></div>
<section id="about" class="content-section clearfix" style="padding-top:150px;">
<div class="container">
<h2>clients and solicitors relationship:</h2>
<table class="table table-striped table-hover" width="80%" border="1" cellspacing="0" cellpadding="1">
  <tr>
  	<td>user Id</td>
    <td>username</td>
    <td>coresponding solicitor's Id</td>
    <td>coresponding solicitor's name</td>
  </tr>


<?php while ($num_rows = mysqli_fetch_array($result)){ 
	//echo $num_rows;
	$id = $num_rows["Id"];
	if($id!= ""){
?> <td>
	<?php 
					
					echo $num_rows["Id"];										
					?>
	</td>
	    <td><?php echo $num_rows["firstname"]; echo "  "; echo $num_rows["lastname"];?></td>
	    
	    <?php $ids = $num_rows["solicitorid"]; ?>
	    <td><?php	if($ids != ""){
	    			 $query3 = "SELECT * FROM solicitor WHERE Id = '$ids'";
					$result3 = mysqli_query($mysql,$query3);
					if($result3 == "") {
						echo " fail to query3.";
						exit;
					} 
					$nameresults = mysqli_fetch_array($result3);
					echo $nameresults["Id"];										
					?></td></td>
	    <td><?php echo  $nameresults["name"]; 
	    	}
	    	else {echo "no solicitor assigned yet";}
	    }?>
	    </td>
	
	  </tr>
	  <tr>
<?php }?>
 
</table>
</div>
</section>
</body>

