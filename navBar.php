<?php include ("header.php"); ?>
<!-- Image and text -->
<nav class="navbar navbar-expand-lg navbar-dark orange">
    <a class="navbar-brand" href="#">
        <img src="images/Logo.png" height="50" class="d-inline-block align-top" alt="">
        
    </a>
	 <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
	    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <h4><a class="nav-link" href="index.php" style="color:Black;">Scouting 2018</a></h4>
            </li>
        </ul>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-left">
				<li class = "dropdown">
					<a class="dropdown-toggle" style="color:Black;">Forms</a>
	                    <ul class="dropdown-menu">
	                        <li><a class="nav-link" href="index.php" style="color:Black;">Match Form</a></li>
							<li><a class="nav-link" href="index.php" style="color:Black;">HS Input</a></li>
							<li><a class="nav-link" href="index.php" style="color:Black;">PS Form</a></li>
							<li><a class="nav-link" href="index.php" style="color:Black;">Picture Upload</a></li>
							<li><a class="nav-link" href="index.php" style="color:Black;">Database Op</a></li>		
	                    </ul>
				</li>
				<li><a class="nav-link" href="index.php" style="color:Black;">User Registration</a></li>
				<li><a class="nav-link" href="index.php" style="color:Black;">Team Data</a></li>
				<li><a class="nav-link" href="index.php" style="color:Black;">Match Data</a></li>
				<li><a class="nav-link" href="index.php" style="color:Black;">Ranking</a></li>	
				<li><a class="nav-link" href="index.php" style="color:Black;">Match Output</a></li>
				<li><a class="nav-link" href="index.php" style="color:Black;">HS Output</a></li>
				<li><a class="nav-link" href="index.php" style="color:Black;">Team Filter</a></li>	

			</ul>
			</div>
		
		<?php
			if(isset($_SESSION["userKey"])){
				echo('<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a data-target="#" class="dropdown-toggle-1 nav-link" data-toggle="dropdown">'.$_SESSION["userName"].'<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:void(0)">Action</a></li>
								<li class="divider"></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>');
			}
			else{
				echo('<ul class="nav navbar-nav navbar-right">
						<li class = "nav-item">
							<a class="nav-link" href = "login.php" >Login</a>
						</li>
					</ul>');
			}
		?>
		
			

        <!-- Search form -->
        <!--<form class="form-inline">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
			
        </form>-->
    </div>
    <!-- Collapsible content -->
</nav>