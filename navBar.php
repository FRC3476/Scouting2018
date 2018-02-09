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
                <a class="nav-link" href="index.php" style="color:Black;">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutUs.php" style="color:Black;">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:Black;">FIRST</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="#" style="color:Black;">Tutorials</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="#" style="color:Black;">Gallery</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="#" style="color:Black;">Calendar</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="#" style="color:Black;">Resources</a>
            </li>

        </ul>
		
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
							<a class="nav-link" href = "login.php">Login</a>
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