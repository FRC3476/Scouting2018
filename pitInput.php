<html>
<?php include("navBar.php");
function filter($str){
	return filter_var($str, FILTER_SANITIZE_STRING);
}
 if( isset( $_POST['teamNumber'] ) ) {
	include("databaseLibrary.php");
	 $teamNum = filter($_POST['teamNumber']);
	 $teamName = filter($_POST['teamName']);
	 $weight = filter($_POST['weight']);
	 $height = filter($_POST['height']);
	 $numBatteries = filter($_POST['numBatteries']);
	 $chargedBatteries = filter($_POST['chargedBatteries']);
	 $driveTrain = filter($_POST['driveTrain']);
	 $pitComments = filter($_POST['pitComments']);
	 pitScoutInput( $teamNum,
				 $teamName,
				 $weight,
				 $height,
				 $numBatteries,
				 $chargedBatteries,
				 $driveTrain,
				 $pitComments);
 }
 ?>
<head>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-material-design-master/dist/css/ripples.min.css" rel="stylesheet">
    <link href="bootstrap-material-design-master/dist/css/material-wfont.min.css" rel="stylesheet">	
	<script src="jquery-1.11.2.min.js"></script>
	<script src="sorttable.js"></script>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	

</head>
<body>
<style>
#overallForm {
		font-size: 15px;
		display: inline-block;
}
</style>
<div class="container row-offcanvas row-offcanvas-left">
	<div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
	<a><h2><b><u>Pit Scout Form:</u></b></h2></a>
            <form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<b><text class="col-lg-2 control-label" >Team Number: </text></b>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="teamNumber" name="teamNumber" placeholder=" ">
				</div>
			</div>
			
			<div class="col-lg-2">
			<b><br>Team Name: </b>
			</div>
				<div class="col-lg-10">
				<br>
				<input type="text" class="form-control" id="teamName" name="teamName" placeholder=" ">
				<br>
			</div>
			
			<div class="col-lg-2">
			<b><br>Weight of Robot: </b>
			</div>
				<div class="col-lg-10">
				<br>
				<input type="text" class="form-control" id="weight" name="weight" placeholder=" ">
				<br>
			</div>
			
			<div class="col-lg-2">
			<b><br>Height of Robot: </b>
			</div>
				<div class="col-lg-10">
				<br>
				<input type="text" class="form-control" id="height" name="height" placeholder=" ">
				<br>
			</div>
			
			<div class="col-lg-2">
			<b><br>How Many Batteries in the Pit: </b>
			</div>
				<div class="col-lg-10">
				<br>
				<input type="text" class="form-control" id="numBatteries" name="numBatteries" placeholder=" ">
				<br>
				</div>
			
			<div class="col-lg-2">
			<b><br>How Many Batteries Can Be Charged Simultaneously: </b>
			</div>
				<div class="col-lg-10">
				<br>
				<br>
				<input type="text" class="form-control" id="chargedBatteries" name="chargedBatteries" placeholder=" ">
				<br>
				</div>
				
			<div class="col-lg-2">
			<b><br>Type of Drive Train: </b>
			</div>
				<div class="col-lg-10">
				<br>
				<br>
				<input type="text" class="form-control" id="driveTrain" name="driveTrain" placeholder=" ">
				<br>
				</div>
				
			<div class="col-lg-2">
			<b><br>Comments: </b>
			</div>
				<div class="col-lg-10">
				<br>
				<br>
				<input type="text" class="form-control" id="pitComments" name="pitComments" placeholder=" ">
				<br>
				</div>
				
			<div class="col-lg-12 col-sm-12 col-xs-12">
				<input id="PitScouting" type="submit" class="btn btn-primary" value="Submit Data" onclick="" >
			</form>
			</div>
			<br>		
	</div>
</div>
<?php include("footer.php"); ?>