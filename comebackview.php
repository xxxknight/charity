<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script>
function validate(){
	var uid = document.getElementById("uid").value;
	uid = uid.trim();
	if(checkUid(uid)){
		return true;
	}else{
		alert("please input a positive number!");
		return false;
	}
}

function checkUid(uid){
	var re = /^[0-9]*[1-9][0-9]*$/ ;  
	return re.test(uid);  
}
</script>
</head>
<body>
<div><?php include "header.php" ?></div>

<?php
include 'dbin.php';

$id=$_POST["uid"];
?>

<section id="about" class="content-section clearfix">
	    <div class="container">
		<div class="row">
		    <div class="col-md-12">
			<h2 class="section-title left">please input client id you want to check:</h2>
		    </div>
		</div>
		<div class="row">
		    
		   <form class="form-inline" method="post" action="comebackview.php"> 
		      <div class="col-md-4">
				    <input id="uid" type="text" name="uid" class="form-control">
				</div>
			    </div>
			    
			    <div class="col-md-4">
				    <input class="btn btn-lg btn-primary btn-shadow" type="submit" name="user" value = "check"  onclick ="return validate();">
				</div>
		    </form>
		<hr class="solid">
	
	    <!-- //.container -->
		
<?php 
if($id!=""){?>

<table class="table table-striped table-hover" width="80%" border="1" cellspacing="0" cellpadding="1">
	<tr>
		<td>user id</td>
		<td>main queue/express quess</td>
		<td>time</td>
	</tr>
  <?php
	  $query = "SELECT * FROM action where userid=$id ORDER BY insertmonth";
	  
	  $result = mysqli_query($mysql,$query);
	  
	  if($result == "") {
	  	echo " fail to query.";
	  	exit;
	  }
	  $num = mysqli_num_rows($result);
	  if(!$num){
         echo "<script>alert('there is no such id!')</script>";
         exit;
      }
   
   while ($num_rows = mysqli_fetch_array($result)){ 
?>
	  <tr>
	    <td><?php echo $num_rows["userid"]?></td>
	    <td><?php echo $num_rows["flag"]?></td>
	    <td><?php echo $num_rows["insertmonth"]?></td>

	  </tr>

<?php }
  }
?>

</table>
</div>
</section>
</body>

