<!DOCTYPE html>

<html>
<?php session_start();
include("header.php")?>
<body>
<?php include("navBar.php")?>
<?php
	function filter($str){
		return filter_var($str, FILTER_SANITIZE_STRING);
	}
	if(isset($_POST['matchNum'])){
		include("databaseLibrary.php");
		$matchNum = filter($_POST['matchNum']);
		$team1 = filter($_POST['team1']);
		$team2 = filter($_POST['team2']);
		$team3 = filter($_POST['team3']);
		$team4 = filter($_POST['team4']);
		$team5 = filter($_POST['team5']);
		$team6 = filter($_POST['team6']);
		$strategy1 = filter($_POST['strategy1']);
		$strategy2 = filter($_POST['strategy2']);
		$strategy3 = filter($_POST['strategy3']);
		$strategy4 = filter($_POST['strategy4']);
		$strategy5 = filter($_POST['strategy5']);
		$strategy6 = filter($_POST['strategy6']);
		
		headScoutInput($matchNum,
						$team1,
						$team2,
						$team3,
						$team4,
						$team5,
						$team6,
						$strategy1,
						$strategy2,
						$strategy3,
						$strategy4,
						$strategy5,
						$strategy6);
	}
?>


<!--Rest of the code for the inputs-->
	<div id="input">
	<h1 style="text-decoration: underline; color: rgb(15,129,120); padding-left: 30px; font-size: 30px">Head Scout Input:</h1>



	<h4 style=" color: rgb(120,120,120); font-family: sans-serif; display: inline-block; padding-left: 30px">Match Number:</h4>

	<input style="display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px;width: 30%; margin-left: 30px; font-size: 16px; outline: none;" type="text" placeholder="Match Number" id="matchNum">


	<h3 style="font-size: 19px; font-family: sans-serif;font-weight: lighter;  padding-left: 30px; padding-bottom: 7px">Strategy:</h3>


<div id="inBox">
<!--Team 1-->
	<input id="team1" id="team1"  type="text" placeholder="Team 1">

<input id="strategy1"  type="text" placeholder="Strategy 1">


<br/>
<br>
<br/>

<!--Team 2-->

<input id="team2"  type="text" placeholder="Team 2">

<input id="strategy2"  type="text" placeholder="Strategy 2">



<br/>
<br/>
<br/>

<!--Team 3-->

<input id="team3"  type="text" placeholder="Team 3">

<input id="strategy3"  type="text" placeholder="Strategy 3">



<br/>
<br/>
<br/>

<!--Team 4-->

<input id="team4"  type="text" placeholder="Team 4">

<input id="strategy4"  type="text" placeholder="Strategy 4">


<br/>
<br/>
<br/>

<!--Team 5-->

<input id="team5"  type="text" placeholder="Team 5">

<input id="strategy5"  type="text" placeholder="Strategy 5">


<br/>
<br/>
<br/>

<!--Team 6-->

<input id="team6" type="text" placeholder="Team 6">

<input id="strategy6"type="text" placeholder="Strategy 6">
</div>
<br/>


<input style="background-color: rgb(15,129,120); padding-left: 25px; padding-right: 25px; padding-top: 8px; padding-bottom: 8px; font-size: 15px; font-weight: medium; color: white; margin-left: 30px; border-radius: 5px; margin-top: 5px;" type="submit" name="submit" value="Submit data" onclick="postwith('');">


</div>


<style type="text/css">
	#input{
		margin-left: 10%;
		padding-left: 10px;
		/*border-style: inset;  */
		margin-right: 10%;
		padding-bottom: 5px;
		padding-top: 5px;
		box-shadow:0px 0px 12px #000000;
  /*  0 0 0 10px hsl(0, 0%, 70%),
    0 0 0 15px hsl(0, 0%, 100%);*/

	}

/*style for the textboxes*/
  

  	#team1{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}
  	

  	#team2{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}

  	#team3{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}

  	#team4{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}

  	#team5{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}

  	#team6{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}



  	#strategy1{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}

	#strategy2{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}

  		#strategy3{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}

  		#strategy4{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}

  		#strategy5{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}

  		#strategy6{
  		display: inline-block; border:none; border-bottom: solid; border-color: rgba(120,120,120,50); border-width: 2px; width: 30%; margin-left: 30px; font-size: 15px; outline: none; padding-bottom: 10px;
  	}



  	#team1:hover{
  		border-color: orange;
  	}

  	#team2:hover{
  		border-color: orange;
  	}

  	#team3:hover{
  		border-color: orange;
  	}

  	#team4:hover{
  		border-color: orange;
  	}

  	#team5:hover{
  		border-color: orange;
  	}

  	#team6:hover{
  		border-color: orange;
  	}



  	#strategy1:hover{
  		border-color: orange;
  	}

  	#strategy2:hover{
  		border-color: orange;
  	}

  	#strategy3:hover{
  		border-color: orange;
  	}

  	#strategy4:hover{
  		border-color: orange;
  	}

  	#strategy5:hover{
  		border-color: orange;
  	}

  	#strategy6:hover{
  		border-color: orange;
  	}
</style>
<script>
function postwith(to){
		
		var myForm = document.createElement("form");
		myForm.method="post";
		myForm.action = to;
		
		var names = [
		'matchNum',
		'team1',
		'team2',
		'team3',
		'team4',
		'team5',
		'team6',
		'strategy1',
		'strategy2',
		'strategy3',
		'strategy4',
		'strategy5',
		'strategy6'
		];
		
		var nums = [
		document.getElementById('matchNum').value,
		document.getElementById('team1').value,
		document.getElementById('team2').value,
		document.getElementById('team3').value,
		document.getElementById('team4').value,
		document.getElementById('team5').value,
		document.getElementById('team6').value,
		document.getElementById('strategy1').value,
		document.getElementById('strategy2').value,
		document.getElementById('strategy3').value,
		document.getElementById('strategy4').value,
		document.getElementById('strategy5').value,
		document.getElementById('strategy6').value
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



</body>

</html>
<?php include("footer.php"); ?>