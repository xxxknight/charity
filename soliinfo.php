<?php
include 'dbin.php';
//echo $selected;

$query = "SELECT * FROM solicitor";

$result = mysqli_query($mysql,$query);
if($result == "") {
	echo " fail to query.";
	exit;
}

?>

<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div> <?php include "header.php" ?></div>
<section id="about" class="content-section clearfix" style="padding-top:150px;">
<div class="container">
<h2>Solicitors' information</h2>

<table class="table table-striped table-hover" width="80%" border="1" cellspacing="0" cellpadding="1">
  <tr>
    <td>id</td>
    <td>name</td>
    <td>address</td>
    <td>telenumber</td>
  </tr>


<?php while ($num_rows = mysqli_fetch_array($result)){ 
	//echo $num_rows;
?>
	  <tr>
	    <td> <?php echo $num_rows["Id"]?></td>
	    <td><?php echo $num_rows["name"]?></td>
	    <td><?php echo $num_rows["address"]?></td>
	    <td><?php echo $num_rows["telenumber"]?></td>
	  </tr>
<?php }?>
 
</table>
</div>
</section>
</body>

