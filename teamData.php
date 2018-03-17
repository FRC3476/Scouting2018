<html>
<?php session_start();
include("navbar.php");?>
<body>
<script src="externalJS/Chart.js"></script>
<style>
	body{
		padding: 0;
		margin: 0;
	}
	#canvas-holder{
		width:50%;
	}
	#canvas-holder2{
		width:50%;
	}
	#canvas-holder3{
		width:50%;
	}
	.rotate090 {
	
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
}
</style>
<script>
var $ = jQuery.noConflict();
</script>
<div class="container row-offcanvas row-offcanvas-left">
	<div class="well column  col-lg-112  col-sm-12 col-xs-12" id="content">
	<?php
				if($_GET["team"]){
					$teamNumber = $_GET["team"];
					include("databaseName.php");
					include("databaseLibrary.php");
					getTeamData($_GET["team"]);
					$teamData = getTeamData($teamNumber);
					$fuelAccuracy = fuelAccuracy($teamNumber);
					$fuelSpeed = fuelSpeed($teamNumber);
					$hopperSize = hopperSize($teamNumber);
					
				}	
		?>
		<form action="" method="get">
		Enter Team Number: <input class="control-label"type="number" name="team"  id="team"  size="10" height="10" width="40"> 
		<button id="submit" class="btn btn-primary" onclick="">Display</button>
		<div class="row">
			<div class = "col-md-4">
				<h1> Team <?php echo($_GET["team"]);?> - <?php echo($teamData[0]); ?></h1>	
				<div class="box">			
					<div id="myCarousel" class="carousel slide" data-interval="false">
					  <ol class="carousel-indicators">
					  <?php 
						$index = 0;
						while(file_exists("uploads/".$_GET["team"]."-".$index.".jpg")==1){
								if($index == 0){	
									echo('<li data-target="#myCarousel" data-slide-to="'.$index.'" class="active"></li>');
								}
								else{
									echo('<li data-target="#myCarousel" data-slide-to="'.$index.'"></li>');
								}
								$index++;
						}
					?>
					  </ol>
					  <div class="carousel-inner" role="listbox">
					  <?php 
						$index = 0;
						while(file_exists("uploads/".$_GET["team"]."-".$index.".jpg")==1){
								if($index == 0){	
									echo('<div class="item active" >
											<img   id="'.$_GET["team"].'-'.$index.'" src="uploads/'.$_GET["team"].'-'.$index.'.jpg" >
										 </div>');
								}
								else{
									echo('<div class="item" >
											<img   id="'.$_GET["team"].'-'.$index.'" src="uploads/'.$_GET["team"].'-'.$index.'.jpg" >
										 </div>');
								}
								$index++;
						}
						?>
					  </div>
					  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					  </a>
					</div>
				</div>
				<a><h3><b><u>Fuel Statistics:</u></b></h3></a>
				<h4><b>Fuel Accuracy -</b></h4>
				<div id="canvas-holder">
					<canvas id="chart-area" width="100" height="100"/>
				</div>
				<h4><b>Fuel Speed -</b></h4>
				<div id="canvas-holder2">
					<canvas id="chart-area2" width="100" height="100"/>
				</div>
				<h4><b>Hopper Size -</b></h4>
				<div id="canvas-holder3">
					<canvas id="chart-area3" width="100" height="100"/>
				</div>
				<script>
				var doughnutData = [
				{
					value: <?php echo($fuelAccuracy[0]);?>,
					color:"#FF8C00",
					highlight: "#FF5A5E",
					label: "(< / =60%)"
				},
				{
					value: <?php echo($fuelAccuracy[1]);?>,
					color: "#008080",
					highlight: "#5AD3D1",
					label: "(61 - 70%)"
				},
				{
					value: <?php echo($fuelAccuracy[2]);?>,
					color: "#9ACD32",
					highlight: "#FFC870",
					label: "(71 - 80%)"
				},
				{
					value: <?php echo($fuelAccuracy[3]);?>,
					color: "#20B2AA",
					highlight: "#A8B3C5",
					label: "(81 - 90%)"
				},
				{
					value: <?php echo($fuelAccuracy[4]);?>,
					color: "#FFA500",
					highlight: "#616774",
					label: "(91 - 100%)"
				}
			];
				
				var doughnutData2 = [
				{
					value: <?php echo($fuelSpeed[0]);?>,
					color:"#FF8C00",
					highlight: "#FF5A5E",
					label: "(> / =09 sec)"
				},
				{
					value: <?php echo($fuelSpeed[1]);?>,
					color: "#008080",
					highlight: "#5AD3D1",
					label: "(07 - 08 sec)"
				},
				{
					value: <?php echo($fuelSpeed[2]);?>,
					color: "#9ACD32",
					highlight: "#FFC870",
					label: "(05 - 06 sec)"
				},
				{
					value: <?php echo($fuelSpeed[3]);?>,
					color: "#20B2AA",
					highlight: "#A8B3C5",
					label: "(03 - 04 sec)"
				},
				{
					value: <?php echo($fuelSpeed[4]);?>,
					color: "#FFA500",
					highlight: "#616774",
					label: "(01 - 02 sec)"
				}
			];	
				var doughnutData3 = [
				{
					value: <?php echo($hopperSize[0]);?>,
					color:"#FF8C00",
					highlight: "#FF5A5E",
					label: "(~20 Fuel)"
				},
				{
					value: <?php echo($hopperSize[1]);?>,
					color: "#008080",
					highlight: "#5AD3D1",
					label: "(~40 Fuel)"
				},
				{
					value: <?php echo($hopperSize[2]);?>,
					color: "#9ACD32",
					highlight: "#FFC870",
					label: "(~60 Fuel)"
				},
				{
					value: <?php echo($hopperSize[3]);?>,
					color: "#20B2AA",
					highlight: "#A8B3C5",
					label: "(~80 Fuel)"
				},
				{
					value: <?php echo($hopperSize[4]);?>,
					color: "#FFA500",
					highlight: "#616774",
					label: "(~100 Fuel)"
				}
			];
			
			window.onload = function(){
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
				var ctx2 = document.getElementById("chart-area2").getContext("2d");
				window.myDoughnut = new Chart(ctx2).Doughnut(doughnutData2, {responsive : true});
				var ctx3 = document.getElementById("chart-area3").getContext("2d");
				window.myDoughnut = new Chart(ctx3).Doughnut(doughnutData3, {responsive : true});
				var ctx4 = document.getElementById("myChart").getContext("2d");
				window.myLine = new Chart(ctx4).Line(lineChartData, {responsive: true});
			};
				</script>
			</div>
			<div class = "col-md-4">
				<a><h3><b><u>Gear Statistics:</u></b></h3></a>
				<button class=" btn btn-material-blue">Auto Gears</button>
				<button class=" btn btn-material-green">Teleop Gears</button>
				<canvas id="myChart" width="300" height="250"></canvas>
				<script>
				var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
				var lineChartData = {
				labels : <?php echo(json_encode(matchNum($teamNumber)));?>,
				datasets : [
					{
						label: "Auto Gears",
						fillColor : "rgba(220,220,220,0.1)",
						strokeColor : "#03a9f4",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#03a9f4",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(220,220,220,1)",
						data : <?php echo(json_encode(getGearA($teamNumber))); ?>
					},
					{
						label: "Teleop Gears",
						fillColor : "rgba(220,220,220,0.1)",
						strokeColor : "#0f9d58",
						pointColor : "rgba(220,220,220,1)",
						pointStrokeColor : "#0f9d58",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(151,187,205,1)",
						data : <?php echo(json_encode(getGearT($teamNumber))); ?>
					}
				]
			}
				</script>
				<br><br>
				<div class="table-responsive">
					<table class="table">
					<tbody>
						<tr class="info">
							<td>Average Gears in Auto</td>
							<td><?php echo(getAvgGearA($teamNumber)); ?></td> 
					  </tr>
					  <tr class="success">
							<td>Average Gears in Teleop</td>
							<td><?php echo(getAvgGearT($teamNumber)); ?></td>
					  </tr>
					</tbody>
					</table>
				</div>
				<a><h3><b><u>Comments:</u></b></h3></a>
				<div class="table-responsive">
					<table class="table">
					<tbody>
						<tr class="success">
							<td>Match Comments</td>
							<td><?php $matchComments = matchComments($teamNumber); 
										for($i = 0; $i!= sizeof($teamData[7]); $i++){
											echo("$matchComments[$i].").PHP_EOL;
										}?></td>
					  </tr>
					  <tr class="info">
							<td>Defense Comments</td>
							<td><?php $defenseComments = defenseComments($teamNumber); 
										for($i = 0; $i!= sizeof($teamData[7]); $i++){
											echo("$defenseComments[$i].").PHP_EOL;											
										}?></td>
					  </tr>
					  <tr class="danger">
							<td>Head Scout Comments</td>
							<td><?php $headScoutComments = headScoutComments($teamNumber); 
										for($i = 0; $i!= sizeof($teamData[8]); $i++){
											echo("$headScoutComments[$i].").PHP_EOL;											
										}?></td>
					  </tr>
					</tbody>
					</table>
				</div>
			</div>
			<div class = "col-md-4">
				<a><h3><b><u>Pit Statistics:</u></b></h3></a>
				<div class="table-responsive">
					<table class="table">
					<tbody>
						<tr class="info">
							<td>Weight of Robot</td>
							<td><?php echo($teamData[1]); ?></td>
					  </tr>
					  <tr class="success">
							<td>Height of Robot</td>
							<td><?php echo($teamData[2]); ?></td>
					  </tr>
					  <tr class="danger">
							<td>No. of Batteries</td>
							<td><?php echo($teamData[3]); ?></td>
					  </tr> 
					  <tr class="info">
							<td>Batteries Charged Simultaneously</td>
							<td><?php echo($teamData[4]); ?></td>
					  </tr>
					   <tr class="success">
							<td>Drive Train</td>
							<td><?php echo($teamData[5]); ?></td>
					  </tr>
					  <tr class="danger">
							<td>Pit Comments</td>
							<td><?php echo($teamData[6]); ?></td>
					  </tr>
					</tbody>
					</table>
				</div>
				<div>
					<canvas id="myCanvas" width="300" height="330" style="border:1px solid #d3d3d3;"></canvas>
					<script type="text/javascript">
						var canvas = document.getElementById('myCanvas');
						var context = canvas.getContext('2d');
						var drawLine = false;
						var oldCoor = {};
						var i = 1;
						var t;
						var coordinateList = [];
						var lastCoordinate = {};
						var imageObj = new Image();
						var matchToPoints = [];
						<?php
							for($i = 0; $i != sizeof($teamData[7]); $i++){
								echo("matchToPoints[".$teamData[7][$i][2]."] = ".$teamData[7][$i][5].";");
							}
						?>
						  imageObj.onload = function() {
							makeCanvasReady();
						  };
						  imageObj.src = 'pictures/autoPath.png';
						  
						function makeCanvasReady(){
							context.clearRect(0, 0, 300, 330);
							context.drawImage(imageObj, 0, 0, 300, 400);
						}
						function adjustCanvas(){
							$("#canvasHolder").css('height' , $(window).height()-25);
							$("#canvasHolder").css('height' , $(window).height()-25);
							$("#main").attr('width' , $("#canvasHolder").width());
							$("#main").attr('height' , $("#canvasHolder").height());
						}
						
						function drawPoint(context , x , y){
							context.fillRect(x,y,1,1);
						}
							
						function drawPointLines(){
							makeCanvasReady();
							var matchNumber = document.getElementById("matchNum").value;
							var a = matchToPoints[matchNumber];
							var color = "#FFFFFF";
								context.beginPath();
								context.strokeStyle = color;
							
							for(var i = 0; i !=a.length; i++){
								if(i == 0){
									context.moveTo(a[i][0],a[i][1]); 
								}
								else{
									context.lineTo(a[i][0], a[i][1]);
								}
							}
							context.stroke();
						}
						
			
					</script>
					<h4><b>Match Number -</b></h4>
					<select onclick = "drawPointLines()"id="matchNum" class="form-control">
					<?php for($i = 0;$i != sizeof($teamData[7]); $i++){
							echo("<option value='".$teamData[7][$i][2]."'>".$teamData[7][$i][2]."</option>");
						  }?>
					</select>
				</div>
				<a><h3><b><u>Climb Statistics:</u></b></h3></a>
				<div class="table-responsive">
					<table class="table">
					<tbody>
						<tr class="danger">
							<td>Total Single Climbs</td>
							<td><?php echo(getTotalClimb($teamNumber)); ?></td> 
					  </tr>
					  <tr class="danger">
							<td>Total Double Climbs</td>
							<td><?php echo(getTotalClimb($teamNumber)); ?></td> 
					  </tr>
					  <tr class="danger">
							<td>Total Triple Climbs</td>
							<td><?php echo(getTotalClimb($teamNumber)); ?></td> 
					  </tr>
					</tbody>
					</table>
				</div>
				<a><h3><b><u>Defense Statistics:</u></b></h3></a>
				<div class="table-responsive">
					<table class="table">
					<tbody>
						<tr class="danger">
							<td>Total Times Defense Played</td>
							<td><?php echo(getTotalDefense($teamNumber)); ?></td> 
					  </tr>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>