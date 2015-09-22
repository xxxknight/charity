
<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<html>
<body>
<div><?php include "header.php" ?></div>
<div class="container"> 
<?php
include 'dbin.php';
$sname = $_POST['textsolicitor'];

//echo $sname;

  
	$querysn = "SELECT * FROM solicitor WHERE name LIKE '%" . $sname . "%'";

	$resultsn = mysqli_query($mysql,$querysn);
	if($resultsn == "") {
		echo " fail to querysn.";
		exit;
	}	
	$num = mysqli_num_rows($resultsn);
	if(!$num){
		echo "<script>alert('you may have input a wrong name!');
		location=\"functionpage.php\" </script>";
		exit;
	}

	while ($num_rowsn = mysqli_fetch_array($resultsn)){
	
		$idsn = $num_rowsn["Id"];
		$namesn = $num_rowsn["name"];
	

?>
	<section id="about" class="content-section clearfix" style="padding-top:200px;">
	    <div class="container"> 
		<div class="row">
		    <div class="col-md-12">
			<h2 class="section-title left">
			The solictor <?php echo $namesn; ?> has the following clients:</h2>
		    </div>
		</div>
		
		    
	<?php		
		//echo $idsn;
		$querysid = "SELECT * FROM usrelation WHERE solicitorid = '$idsn' " ;
		$resultsid = mysqli_query($mysql,$querysid);
		if($resultsid == "") {
			echo " fail to querysid.";
			exit;
		}
		
		?>
	<div class="row">
		    
	<table class="table table-striped table-hover" width="80%" border="1" cellspacing="0" cellpadding="1">
	  <tr>
	    <td>id</td>
	    <td>name</td>
	  </tr>
	  <tr>
		<?php 
		while ($num_rowun = mysqli_fetch_array($resultsid)){
			$idun = $num_rowun["user id"];
			//echo $idun;
		
		$query2 = "SELECT * FROM userinfo WHERE Id = '$idun' ";
		$result2 = mysqli_query($mysql,$query2);
		if($result2 == "") {
			echo " fail to query2.";
			exit;
		}
		
		$nameresult = mysqli_fetch_array($result2);
		?>
		<td><?php echo $nameresult["Id"];?></td>
	 <td><?php echo $nameresult["firstname"]; echo "  "; echo $nameresult["lastname"];?></td>
	 </tr>
<?php 	
		}
 	}


?>
 </table> 
</div>
</div>
</section>
</div>
</body>
</html>
