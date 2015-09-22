!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
<?php
include 'dbin.php';
$uname = $_POST['textuser'];
echo $uname;



?>	<h3> we are going to check a user's information for you:</h3>
<?php 
	$query = "SELECT * FROM userinfo WHERE firstname LIKE '%" . $uname . "%'";
	
	$result = mysqli_query($mysql,$query);
	if($result == "") {
		echo " fail to query.";
		exit;
}
?>

	<table class="table table-striped table-hover" width="80%" border="1" cellspacing="0" cellpadding="1">
	  <tr>
	    <td>id</td>
	    <td>first name</td>
	    <td>last name</td>
	    <td>sex</td>
	    <td>birthdate</td>
	    <td>country</td>
	    <td>eligible state</td>
	    <td>confirm date</td>
	    <td>altername</td>
	    <td>basic notes</td>
	  </tr>

<?php 
	while ($num_rows = mysqli_fetch_array($result)){ 
	//echo $num_rows;
	$id = $num_rows["Id"];
	$query2 = "SELECT * FROM ucomeback WHERE Id = '$id' " ;
	$result2 = mysqli_query($mysql,$query2);
	if($result2 == "") {
		echo " fail to query2.";
		exit;
	}
	?>
	
	  <tr>
	    <td> <?php echo $num_rows["Id"]?></td>
	    <td><?php echo $num_rows["firstname"]?></td>
	    <td><?php echo $num_rows["lastname"]?></td>
	    <td><?php echo $num_rows["sex"]?></td>
	    <td><?php echo $num_rows["birth"]?></td>
	    <td><?php echo $num_rows["country"]?></td>
	    <td><?php echo $num_rows["eligible"]?></td>
	    <td><?php echo $num_rows["confirmyear"]; echo"-"; echo $num_rows["confirmmonth"]; echo "-"; echo $num_rows["confirmdate"] ?> </td>
	    <td><?php echo $num_rows["altername"]?></td>
	    <td><?php echo $num_rows["basicnote"]?></td>
	  </tr>
	  
	  <tr>  
	  <td> The user has comeback at 2014 of month:</td>
	  <?php while($num_rows2 = mysqli_fetch_array($result2)){
	  		for( $i=1; $i<= sizeof($num_rows2); $i++){
	  			if ($num_rows2[$i]!=""){
	  ?>
	  			<td><?php echo $i;?></td>
	  		
	  <?php 
				}  
	  		}
	 	}
	  
	  ?>
	  </tr>  
	
<?php }?>
</table>
