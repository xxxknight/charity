<?php
session_start();
include 'dbin.php';
?>
<!DOCTYPE div PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<title>manage</title>
</head>

<body>
<div><?php include "header.php"; ?></div>
<?php
//create names for variables
$name = $_POST['name'];
$password = $_POST['password'];

//whether user enter their name and password or not
		$query = "SELECT * FROM manager WHERE name = '$name' and password = '$password' ";
	
		$result = mysqli_query($mysql,$query);
		if($result == "") {
			echo " fail to query.";
			exit;
		}
        
		$num_rows = mysqli_num_rows($result);
		if ($num_rows == 1) {	//For the correct name & password;
				//session_start();
				//$_SESSION['login'] = "Log In";
				$_SESSION['name'] = $name;
			?>
	<section id="about" class="content-section clearfix" style="padding-top:200px;">
	    <div class="container">
		<div class="row">
		    <div class="col-md-12">
			<h2 class="section-title left">welcome <?php echo $name; ?> </h2>
		    </div>
		</div>
		<div class="row">
		  <form class="form-inline" method="post" action="design/list.php"> 
		   		<div class="col-md-8">
				    <h3 class="feature-title">click to analyze data:</h3>
				</div>
			    <div class="col-md-4">
				    <input class="btn btn-lg btn-primary btn-shadow" type="submit" name="user" name="user" value = "Go" >
				</div>
		    </form>
		</div>  
		
		<div class="row">
		  <form class="form-inline" method="post" action="design/normShow.php"> 
		   		<div class="col-md-8">
				    <h3 class="feature-title">See general graphs:</h3>
				</div>
			    <div class="col-md-4">
				    <input class="btn btn-lg btn-primary btn-shadow" type="submit" name="user" name="user" value = "Go" >
				</div>
		    </form>
		</div>   
		
		<div class="row">
		  <form class="form-inline" method="post" action="design/monthShow.php"> 
		    	<div class="col-md-8">
				    <h3 class="feature-title">view monthly report:</h3>
				</div>
			    <div class="col-md-4">
				    <input class="btn btn-lg btn-primary btn-shadow" type="submit" name="user" name="user" value = "Go" >
				</div>
		    </form>
		</div>    
		</div>
	    
	</section>
	<!-- End Portfolio Section -->
		

		<?php		}
	
	
		else { // for the wrong login
			echo "<script>alert('the login has failed, your password and username is not match,please try later.');
				location=\"index.php\" </script>";
}
			
?>
</body>