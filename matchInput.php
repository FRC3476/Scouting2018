<html>
<?php 
include("navBar.php");
if( isset( $_POST['matchNum'] ) ) {
	include("databaseLibrary.php");
	 $user = ($_SESSION['userIDCookie']);
	 $matchNum = filter_var($_POST['matchNum'], FILTER_SANITIZE_STRING);  
	 $teamNum = filter_var($_POST['teamNum'], FILTER_SANITIZE_STRING);  
	 $ID = $matchNum."-".$teamNum;
	 $allianceColor = filter_var($_POST['allianceColor'], FILTER_SANITIZE_STRING); 
	 $autoPath = filter_var($_POST['autoPath'], FILTER_SANITIZE_STRING);  
	 $crossLineA = filter_var($_POST['crossLineA'], FILTER_SANITIZE_STRING);  
	 $gearPositionA = filter_var($_POST['gearPositionA'], FILTER_SANITIZE_STRING);  
	 $gearNumberA = filter_var($_POST['gearNumberA'], FILTER_SANITIZE_STRING);  
	 $hopperUsedA = filter_var($_POST['hopperUsedA'], FILTER_SANITIZE_STRING);  
	 $rankingPointA = filter_var($_POST['rankingPointA'], FILTER_SANITIZE_STRING);  
	 $gearNumberT = filter_var($_POST['gearNumberT'], FILTER_SANITIZE_STRING);  
	 $gearPickupT = filter_var($_POST['gearPickupT'], FILTER_SANITIZE_STRING);  
	 $fuelGoalT = filter_var($_POST['fuelGoalT'], FILTER_SANITIZE_STRING);  
	 $fuelPickupT = filter_var($_POST['fuelPickupT'], FILTER_SANITIZE_STRING);  
	 $fuelAccuracyT = filter_var($_POST['fuelAccuracyT'], FILTER_SANITIZE_STRING);  
	 $fuelSpeedT = filter_var($_POST['fuelSpeedT'], FILTER_SANITIZE_STRING);  
	 $hopperSizeT = filter_var($_POST['hopperSizeT'], FILTER_SANITIZE_STRING);  
	 $climb = filter_var($_POST['climb'], FILTER_SANITIZE_STRING);  
	 $climbExtent = filter_var($_POST['climbExtent'], FILTER_SANITIZE_STRING);  
	 $issues = filter_var($_POST['issues'], FILTER_SANITIZE_STRING);  
	 $defenseBot = filter_var($_POST['defenseBot'], FILTER_SANITIZE_STRING);  
	 $defenseComments = filter_var($_POST['defenseComments'], FILTER_SANITIZE_STRING);  
	 $matchComments = filter_var($_POST['matchComments'], FILTER_SANITIZE_STRING);  
	 matchInput( $user,
				 $ID,
				 $matchNum,
				 $teamNum,
				 $allianceColor,
				 $autoPath,
				 $crossLineA,
				 $gearPositionA,
				 $gearNumberA,
				 $hopperUsedA,
				 $rankingPointA,
				 $gearNumberT,
				 $gearPickupT,
				 $fuelGoalT,
				 $fuelPickupT,
				 $fuelAccuracyT,
				 $fuelSpeedT,
				 $hopperSizeT,
				 $climb,
				 $climbExtent,
				 $issues,
				 $defenseBot,
				 $defenseComments,
				 $matchComments);
 }
	 
	?>
<body>
<script>
var increment = 1;
var keyPressOk = true;
var mode = true;
var removeStuff = 0;
var gearNumberA = 0;
var gearNumberT = 0;  
$( document ).ready(function() {
    $.material.init();
});
function incrGearsPlacedA(){
	gearNumberA = gearNumberA + increment;
	document.getElementById("gearNumberA").innerHTML=gearNumberA;
}
function decGearsPlacedA(){
	gearNumberA = gearNumberA - increment;
	if (gearNumberA < 0){
		gearNumberA = 0;
	} 
	document.getElementById("gearNumberA").innerHTML=gearNumberA; 
}
function incrGearsPlacedT(){
	gearNumberT = gearNumberT + increment;
	document.getElementById("gearNumberT").innerHTML=gearNumberT;
}
function decGearsPlacedT(){
	gearNumberT = gearNumberT - increment;
	if (gearNumberT < 0){
		gearNumberT = 0;
	} 
	document.getElementById("gearNumberT").innerHTML=gearNumberT;
}
$(function(){
  		$('#teleopscouting').hide();
	});
	
function autotele(){
		if(mode == true){
			$('#autoscouting').hide();
			$('#teleopscouting').show();
			document.getElementById("Switch").innerHTML = "Auto";
		}
		else{
			$('#autoscouting').show();
			$('#teleopscouting').hide();
			document.getElementById("Switch").innerHTML="Teleop";
		}
		mode = !mode; 
	}	
	function toggleColor(){
		
		 var colorTog = document.getElementById("allianceColor");
		if (colorTog.innerHTML !== "Blue <b>(a)</b>") {
			colorTog.innerHTML = "Blue <b>(a)</b>";
			document.getElementById("allianceColor").value="Blue";
		}
		else {
			colorTog.innerHTML = "Red <b>(a)</b>";
			document.getElementById("allianceColor").value="Red";
		}
	}
	
</script>
<script>
function postwith(to){
		
		var myForm = document.createElement("form");
		myForm.method="post";
		myForm.action = to;
		
		var names = [
		 'matchNum',
		 'teamNum',
		 'allianceColor',
		 'autoPath',
		 'crossLineA',
		 'gearPositionA',
		 'gearNumberA',
		 'hopperUsedA',
		 'rankingPointA',
		 'gearNumberT',
		 'gearPickupT',
		 'fuelGoalT',
		 'fuelPickupT',
		 'fuelAccuracyT',
		 'fuelSpeedT',
		 'hopperSizeT',
		 'climb',
		 'climbExtent',
		 'issues',
		 'defenseBot',
		 'defenseComments',
		 'matchComments'
		
		];
	
		var nums = [
		document.getElementById('matchNum').value,
		document.getElementById('teamNum').value,
		document.getElementById('allianceColor').value,
		JSON.stringify(coordinateList),
		document.getElementById('crossLineA').checked?1:0,
		document.getElementById('gearPositionA').value,
		gearNumberA,
		document.getElementById('hopperUsedA').value,
		document.getElementById('rankingPointA').checked?1:0,
		gearNumberT,
		document.getElementById('gearPickupT').value,
		document.getElementById('fuelGoalT').value,
		document.getElementById('fuelPickupT').value,
		document.getElementById('fuelAccuracyT').value,
		document.getElementById('fuelSpeedT').value,
		document.getElementById('hopperSizeT').value,
		document.getElementById('climb').checked?1:0,
		document.getElementById('climbExtent').value,
		document.getElementById('issues').value,
		document.getElementById('defenseBot').checked?1:0,
		document.getElementById('defenseComments').value,
		document.getElementById('matchComments').value
		];  
  
		for (var i = 0; i != names.length; i++) {
			var myInput = document.createElement("input");
			myInput.setAttribute("name", names[i]);
			myInput.setAttribute("value", nums[i]);
			myForm.appendChild(myInput);
		}
  
		document.body.appendChild(myForm);
		myForm.submit();
		document.body.removeChild(myForm);
	}
</script>
<div class="container row-offcanvas row-offcanvas-left">
	<div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
		<div class="row">
			<div id="matchinfo" style="text-align: center;">	
				<div class="col-md-3">
					Match Number:
					<input type="text" name="matchNum" id="matchNum" size="8" class="form-control">
				</div>
				<div class="col-md-3">
					Team Number:
					<input type= "text" name="teamNum"  id="teamNum" size="8" class="form-control">
				</div>
				<div class="col-md-3">
					Alliance Color:
					<select id="allianceColor" class="form-control">
						<?php   if($_SESSION['allianceColor'] == "blue"){
									echo("<option value='blue'>Blue</option>
										  <option value='red'>Red</option>");
								}
							    else{
									echo("<option value='red'>Red</option>
										  <option value='blue'>Blue</option>");
								}
						?>
					</select>
				</div>
				<div class="col-md-3">
					<button id="Switch" onclick="autotele();" class="btn btn-primary" >Teleop</button>
				</div>
			</div>
		</div>
		<div id="autoscouting">
			<a><h2><b><u>Auto Scouting:</u></b></h2></a>
			<div class="row">
				<div class="col-md-4">
					<div class="togglebutton" id="reach">
						<h4><b>Reached Base Line:</b></h4>
						<label>
							<input id="crossLineA" type="checkbox">
						</label>
					</div>
					<a href="javascript:void(0)" class="btn btn-raised btn-boulder btn-material-teal-600" onclick="clearPath()"><b>CLEAR PATH</b></a>
						<canvas id="myCanvas" width="300" height="330" style="border:1px solid #d3d3d3;">
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
								  imageObj.onload = function() {
									context.drawImage(imageObj, 0, 0, 300, 400);
								  };
								  imageObj.src = 'pictures/autoPath.png';
								  
								function clearPath(){
									context.clearRect(0, 0, 300, 330);
									context.drawImage(imageObj, 0, 0, 300, 400);
									coordinateList = [];
									lastCoordinate = {};
								}
								
								function addCoordinate(coor){
									coordinateList.push(coor);
								}
								
								function updateRobotHTML(){
									
								}
						
								function randomColor(){
									var choices = "0123456789abcdef";
									var out = "#";
									for(var i = 0; i < 6; i++){
										out += choices[Math.floor(Math.random() * 16)];
									}
									return(out);
								}
								
								function adjustCanvas(){
									$("#canvasHolder").css('height' , $(window).height()-25);
									$("#canvasHolder").css('height' , $(window).height()-25);
									$("#main").attr('width' , $("#canvasHolder").width());
									$("#main").attr('height' , $("#canvasHolder").height());
								}
								
								function resize(){    
									//$("#main").outerHeight($(window).height()-$("#main").offset().top- Math.abs($("#main").outerHeight(true) - $("#main").outerHeight()));
									//$("#main").outerHeight(100*i);
									//$("#main").outerWidth(100*i);
									canvas.width = $(window).width() - 35;
									canvas.height = $(window).height() - 25;
								}
								
								$(document).ready(function(){
									$.material.init()
									//resize();
									adjustCanvas();
									$(window).on("resize", function(){                      
										//resize();
										adjustCanvas();
									});
									context.stroke();
									//$("#main")[0].webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT); //Chrome
									//$("#main")[0].mozRequestFullScreen(); //Firefox
									canvas.addEventListener('touchmove', movePath, false);
									canvas.addEventListener('touchstart', startPoint, false);
									canvas.addEventListener('touchend', endPoint, false);
									
									canvas.addEventListener('mousemove', movePath, false);
									canvas.addEventListener('mousedown', startPoint, false);
									canvas.addEventListener('mouseup', endPoint, false);
								});
								
								function getMousePos(canvas, evt) {
									var rect = canvas.getBoundingClientRect();
									var evtType = evt.constructor.name;
									if(evtType == "TouchEvent"){
										return {
											x: evt.touches[0].clientX - rect.left,
											y: evt.touches[0].clientY - rect.top
											};
									}
									else if(evtType = "MouseEvent"){
										return {
											x: evt.clientX - rect.left,
											y: evt.clientY - rect.top
											};
									}
									else{
										alert("Input type not supported!")
									} 
								}
								
								function drawPoint(context , x , y){
									context.fillRect(x,y,1,1);
								}
									
								function drawPointLines(context , point){
									var color = "#FFFFFF";
									if(lastCoordinate.length == 0){
										lastCoordinate = point;
									}
									else{
										context.beginPath();
										context.strokeStyle = color;
										context.moveTo(lastCoordinate[0] , lastCoordinate[1]);
										context.lineTo(point[0] , point[1]);
										addCoordinate(point);
										lastCoordinate = point;
										context.stroke();
									}
								}
								
								function movePath(evt){
									t = evt;
									if(drawLine){
										var mousePos = getMousePos(canvas, evt);
										var message = mousePos.x + ' , ' + mousePos.y;
										//drawPoint(context , mousePos.x , mousePos.y);
										drawPointLines(context , [mousePos.x , mousePos.y]);
										console.log(message);
									}
										evt.preventDefault();
										return false;
								}
								
								function startPoint(evt){
									console.log("A");
									drawLine = true;
									evt.preventDefault();
									return false;
								}
								
								function endPoint(evt){
									console.log("B");
									drawLine = false;
									evt.preventDefault();
									return false;
								}
								
								
								
							</script>
				</div>
				<div class="col-md-4">
				<a><h3><b><u>Gear:</u></b></h3></a>
					<h4><b>No. of Gears Placed:</b></h4>
						<button type="button" onClick="decGearsPlacedA()" class="enlargedtext ">-</button>	
						<a id="gearNumberA" class="enlargedtext">0</a>
						<button type="button" onClick="incrGearsPlacedA()" class="enlargedtext">+</button>
					<h4><b>Gear Placement -</b></h4>
					<select id="gearPositionA" class="form-control">
						 <option value="Not Attempted">Not Attempted</option>
						 <option value="left">1</option>
						 <option value="middle">2</option>
						 <option value="right">3</option>
					</select>
						<img src="pictures/gearPositionPic.png" width="600" height="300">
				</div>
				<div class="col-md-4">
				<a><h3><b><u>Fuel:</u></b></h3></a>
					<h4><b>Hopper Used -</b></h4>
					<select id="hopperUsedA" class="form-control">
						 <option value="Not Attempted">Not Attempted</option>
						 <option value="nearScorer">A</option>
						 <option value="nearBoiler">B</option>
					</select>
					<div class="togglebutton" id="reach">
						<h4><b>Ranking Point Achieved:</b></h4>
						<label>
						<input id="rankingPointA" type="checkbox">
						</label>
					</div>
				</div>
			</div>
		</div>
		<div id="teleopscouting">
			<a><h2><b><u>Teleop Scouting:</u></b></h2></a>
			<div class="row">
				<div class="col-md-3">
				<a><h3><b><u>Gear:</u></b></h3></a>
					<h4><b>Gear Pickup:</b></h4>
						<select id="gearPickupT" multiple="" class="form-control">
						  <option value="N/A">Not Able to Get Gears</option>
						  <option value="feeder station">Feeder Station</option>
						  <option value="floor">Floor Pickup</option>
						  <option value="Both">Both</option>
						</select>
					<h4><b>No. of Gears Placed:</b></h4>
						<button type="button" onClick="decGearsPlacedT()" class="enlargedtext ">-</button>	
						<a id="gearNumberT" class="enlargedtext">0</a>
						<button type="button" onClick="incrGearsPlacedT()" class="enlargedtext">+</button>
					<a><h3><b><u>Robot Issues:</u></b></h3></a>
						<select id="issues" multiple="" class="form-control">
						  <option value="N/A">None</option>
						  <option value="dead">Dead</option>
						  <option value="stopped working">Stopped Working</option>
						  <option value="fell over">Fell Over</option>
						</select>
				</div>
				<div class="col-md-3">
				<a><h3><b><u>Fuel:</u></b></h3></a>
					<h4><b>Fuel Pickup:</b></h4>
						<select id="fuelPickupT" multiple="" class="form-control">
							  <option value="N/A">Not Able to Get Fuel</option>
							  <option value="feeder station">Feeder Station</option>
							  <option value="floor">Floor Pickup</option>
							  <option value="hopper">Hopper</option>
							  <option value="feeder and floor">Feeder & Floor</option>
							  <option value="feeder and hopper">Feeder & Hopper</option>
							  <option value="floor and hopper">Floor & Hopper</option>
							  <option value="all">All 3</option>
						</select>
					<h4><b>Goal Scored In -</b></h4>
					<select id="fuelGoalT" class="form-control">
						 <option value="Not Attempted">Not Attempted</option>
						 <option value="High Goal">High Goal</option>
						 <option value="Low Goal">Low Goal</option>
						 <option value="Both">Both</option>
					</select>
					<h4><b>Fuel Accuracy -</b></h4>
					<select id="fuelAccuracyT" class="form-control">
						 <option value="N/A">N/A</option>
						 <option value="1">1 (< / =60%)</option>
						 <option value="2">2 (61 - 70%)</option>
						 <option value="3">3 (71 - 80%)</option>
						 <option value="4">4 (81 - 90%)</option>
						 <option value="5">5 (91 - 100%)</option>
					</select>
				</div>
				<div class="col-md-3">
				<br><br>
				<h4><b>Fuel Speed -</b></h4>
					<select id="fuelSpeedT" class="form-control">
						 <option value="N/A">N/A</option>
						 <option value="1">1 (> / =50 sec)</option>
						 <option value="2">2 (31 - 40 sec)</option>
						 <option value="3">3 (21 - 30 sec)</option>
						 <option value="4">4 (11 - 20 sec)</option>
						 <option value="5">5 (01 - 10 sec)</option>
					</select>
					<h4><b>Hopper Size -</b></h4>
					<select id="hopperSizeT" class="form-control">
						 <option value="N/A">N/A</option>
						 <option value="1">1 (~20 Fuel)</option>
						 <option value="2">2 (~40 Fuel)</option>
						 <option value="3">3 (~60 Fuel)</option>
						 <option value="4">4 (~80 Fuel)</option>
						 <option value="5">5 (~100 Fuel)</option>
					</select>
				<a><h3><b><u>Climb:</u></b></h3></a>
					<div class="togglebutton" id="reach">
						<h4><b>Climb?(Only for Full Climb)</b></h4>
						<label>
							<input id="climb" type="checkbox">
						</label>
					</div>
					<h4><b>Climb Final Position -</b></h4>
					<select id="climbExtent" class="form-control">
						 <option value="Not Attempted">Not Attempted</option>
						 <option value="Ready for Takeoff">Ready for Takeoff</option>
						 <option value="Halfway">Halfway</option>
						 <option value="Fell off">Fell off</option>
					</select>
				<a><h3><b><u>Defense:</u></b></h3></a>
					<div class="togglebutton" id="reach">
						<h4><b>Defense Played?</b></h4>
						<label>
							<input id="defenseBot" type="checkbox">
						</label>
					</div>
				</div>
				<div class="col-md-3">
					<br> <br>
					<div style="padding: 5px; padding-bottom: 10;" >
					<h4><b><u>Defense Comments: </u></b></h4>
					<textarea placeholder="hello friend" rows="6" cols="10" id = "defenseComments"  class="form-control"> 
					</textarea>
					</div>
					<br> <br>
					<div style="padding: 5px; padding-bottom: 10;" >
					<h4><b><u>Comments: </u></b></h4>
					<textarea placeholder="hello friend" rows="6" cols="10" id = "matchComments"  class="form-control"> 
					</textarea>
					<br>
					<input type="button" value="Submit Data" class="btn btn-primary" onclick="postwith('');" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>						
</body>
</html>