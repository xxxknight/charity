<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> 
<![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en"> 
<![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

    <head>

        <title>Charity--the Home Office</title>
        <meta charset="UTF-8">

        <!-- CSS Bootstrap & Custom -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/animate.css" rel="stylesheet" media="screen">
        <link href="css/templatemo_style.css" rel="stylesheet" media="screen">
       	<style type="text/css">
		.pic{height:"224px"; width:"270px";}
		</style>
        <!-- JavaScripts -->
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/modernizr.js"></script>
        <!--[if lt IE 8]>
	    <div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>
        </div>
        <![endif]-->
    </head>
    <body>
	<!-- Preloader -->
	<div id="page-preloader">
	    <div id="spinner"></div>
	</div>
	<!-- End Preloader -->
	
	<!-- Mobile Menu -->
	<div id="mobile-menu" class="mobile-nav hide-nav hidden-md hidden-lg">
	    <div class="mobile-menu-close">
		<button type="button" class="close" aria-hidden="true"><span>Close</span>&times;</button>
	    </div>
	   
		<ul class="mobile-navigation">
		    <li><a href="#introduction">solicitor-client</a></li>
		    <li><a href="#about">update all info</a></li>
		    <li><a href="#portfolio">update indicidual</a></li>
		    <li><a href="#our-team">update solicitor information</a></li>
		    
		</ul>
	
	    
	</div>

        <!-- Header -->
        <header id="header" class="site-header" role="banner">
	    <div class="container">
		<div class="row">
		    
		    <div class="col-md-4 logo">
			<a href="index.php"> <h1 style="margin-top:10px">London Charity</h1></a>
		    </div> <!-- //.logo -->
		    
		    <div class="col-md-8">
			<nav id="navigation" class="hidden-sm hidden-xs" style="padding-top:15px;">
			    <ul id="main-nav" class="main-navigation">
				<li class="current"><a href="#introduction">solicitor-client</a></li>
				<li><a href="#about">update all info</a></li>
				<li><a href="#portfolio">update individual</a></li>
				<li><a href="#our-team">update solicitor</a></li>
			    </ul>
			</nav>
			
			<a href="#mobile-menu" class="visible-xs visible-sm mobile-menu-trigger"><i class="fa  fa-reorder"></i></a>
			
		    </div>
		    
		</div> <!-- //.row -->
	    </div> <!-- //.container -->
            
        </header>
	<!-- End Header -->
	
	
	<!-- Introduction Section -->
	<section id="introduction" class="content-section clearfix" style="padding-top:50px;">
	    <div class="container"> 
		<div class="row">
		    <div class="col-md-12">
			<h2 class="section-title left">Find a solicitor’s client list:</h2>
		    </div>
		</div>
		<div class="row">
		    
		   <form class="form-inline" method="post" action="searchsoli.php"> 
		   		<div class="col-md-4 animated-item feature-item fadeInUp" data-delay="200">
				<span class="feature-icon"><i class="li_bulb"></i></span>
				<div class="feature-info">
				    <h3 class="feature-title"><span></span>Name of solicitor</h3>
				</div>
			    </div>
			    
			    <div class="col-md-4 animated-item feature-item fadeInUp" data-delay="300">
				<span class="feature-icon"><i class="li_params"></i></span>
				<div class="feature-info">
				<h3 class="feature-title"><span></span></h3>
				    <input type="text" name="textsolicitor" class="form-control">
				</div>
			    </div>
			    
			    <div class="col-md-4 animated-item feature-item fadeInUp" data-delay="400">
				<span class="feature-icon"><i class="li_heart"></i></span>
				<div class="feature-info">
				    <h3 class="feature-title"><span></span>click to search</h3>
				    <input class="btn btn-lg btn-primary btn-shadow" type="submit" value="search">
				</div>
		    	</div>
		    </form>
		    
		</div> <!-- //.row -->
		
		<hr class="solid">
	
	    </div> <!-- //.container -->
	    
	</section>
	<!-- End Introduction Section -->


	<!-- About Section -->
	<section id="about" class="content-section clearfix">
	    <div class="container">
		<div class="row">
		    <div class="col-md-12">
			<h2 class="section-title left">To update the clinets' attend information:</h2>
		    </div>
		</div>
		<div class="row">
		    
		   <form class="form-inline" method="post" action="update/updateattend.php"> 
		   		<div class="col-md-8 animated-item feature-item fadeInUp" data-delay="200">
				<span class="feature-icon"><i class="li_bulb"></i></span>
				<div class="feature-info">
				    <h3 class="feature-title"><span></span>click to update all clients' attend information:</h3>
				</div>
			    </div>
			    
			    
			    <div class="col-md-4 animated-item feature-item fadeInUp" data-delay="400">
				<span class="feature-icon"><i class="li_heart"></i></span>
				<div class="feature-info">
				    <h3 class="feature-title"><span></span></h3>
				    <input class="btn btn-lg btn-primary btn-shadow" type="submit" name="user" value = "update">
				</div>
		    	</div>
		    </form>
		    
		</div> <!-- //.row -->
		
		<hr class="solid">
	
	    </div> <!-- //.container -->
	    
	</section>
	<!-- End About Section -->
	
	<!-- Portfolio Section -->
	<section id="portfolio" class="content-section clearfix" style="background:#5c5c5c;">
	    <div class="container">
		<div class="row">
		    <div class="col-md-12">
			<h2 class="section-title right">To update the client information individually: </h2>
		    </div>
		</div>
		<div class="row">
		  <form class="form-inline" method="post" action="update/updateall.php"> 
		   		<div class="col-md-8 animated-item feature-item fadeInUp" data-delay="200">
				<span class="feature-icon"><i class="li_bulb"></i></span>
				<div class="feature-info">
				    <h3 class="feature-title"><span></span>click to update the client information individually:</h3>
				</div>
			    </div>
			    
			    
			    <div class="col-md-4 animated-item feature-item fadeInUp" data-delay="400">
				<span class="feature-icon"><i class="li_heart"></i></span>
				<div class="feature-info">
				    <h3 class="feature-title"><span></span></h3>
				    <input class="btn btn-lg btn-primary btn-shadow" type="submit" name="user" name="user" value = "search" >
				</div>
		    	</div>
		    </form>
		    <form class="form-inline" method="post" action="update/updateaction.php"> 
		   		<div class="col-md-8 animated-item feature-item fadeInUp" data-delay="200">
				<span class="feature-icon"><i class="li_bulb"></i></span>
				<div class="feature-info">
				    <h3 class="feature-title"><span></span>click to update the client attend information indicidually:</h3>
				</div>
			    </div>
			    
			    
			    <div class="col-md-4 animated-item feature-item fadeInUp" data-delay="400">
				<span class="feature-icon"><i class="li_heart"></i></span>
				<div class="feature-info">
				    <h3 class="feature-title"><span></span></h3>
				    <input class="btn btn-lg btn-primary btn-shadow" type="submit" name="user" name="user" value = "search" >
				</div>
		    	</div>
		    </form>
		</div>   
		</div>
	    
	</section>
	<!-- End Portfolio Section -->
	
	<!-- Partners Section -->
	
	<!-- End Partners Section -->
	
	<!-- team Section -->
	<section id="our-team" class="content-section clearfix">
	    <div class="container">
		<div class="row">
		    <div class="col-md-12">
			<h2 class="section-title right">Edit Solicitor</h2>
		    </div>
		</div>
		<div class="row">
		 <form class="form-inline" method="post" action="update/updatesoli.php"> 
		   		<div class="col-md-8 animated-item feature-item fadeInUp" data-delay="200">
				<span class="feature-icon"><i class="li_bulb"></i></span>
				<div class="feature-info">
				    <h3 class="feature-title"><span></span>Edit solicitors' information here:</h3>
				   </div>
				   </div>
				     <div class="col-md-4 animated-item feature-item fadeInUp" data-delay="400">
					<span class="feature-icon"><i class="li_heart"></i></span>
				    <h3 class="feature-title"><span></span></h3>
				    <input class="btn btn-lg btn-primary btn-shadow" type="submit" name="user" name="user" value = "update" >
				</div>
		    	</div>
		    
		    </form>
		</div>
	</section>
	<!-- End Partners Section -->
	

	

        <!-- JavaScripts -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/custom.js"></script>

    </body>







			
