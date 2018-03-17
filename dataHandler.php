<?php
include("matchInput.php");
if( isset( $_POST['matchNum'] ) ) {
include("databaseLibrary.php");
 $user = ($_SESSION['userIDCookie']);
 $matchNum = filter_var($_POST['matchNum'], FILTER_SANITIZE_STRING);  
 $teamNum = filter_var($_POST['teamNum'], FILTER_SANITIZE_STRING);  
 $ID = $matchNum."-".$teamNum;
 $allianceColor = filter_var($_POST['allianceColor'], FILTER_SANITIZE_STRING); 
 $autoPath = filter_var($_POST['autoPath'], FILTER_SANITIZE_STRING);  
 $crossLineA = filter_var($_POST['crossLineA'], FILTER_SANITIZE_STRING);  
 $ownSwitchA = filter_var($_POST['ownSwitchA'], FILTER_SANITIZE_STRING); 
 $ownScaleA = filter_var($_POST['ownScaleA'], FILTER_SANITIZE_STRING); 
 $ownSwitchT = filter_var($_POST['ownSwitchT'], FILTER_SANITIZE_STRING); 
 $ownScaleT = filter_var($_POST['ownScaleT'], FILTER_SANITIZE_STRING); 
 $oppSwitchT = filter_var($_POST['oppSwitchT'], FILTER_SANITIZE_STRING); 
 $exchangeT = filter_var($_POST['exchangeT'], FILTER_SANITIZE_STRING); 
 $climb = filter_var($_POST['climb'], FILTER_SANITIZE_STRING); 
 $climbTwo = filter_var($_POST['climbTwo'], FILTER_SANITIZE_STRING); 
 $climbThree = filter_var($_POST['climbThree'], FILTER_SANITIZE_STRING); 
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
			 $ownSwitchA,
			 $ownScaleA,
			 $ownSwitchT,
			 $ownScaleT,
			 $oppSwitchT,
			 $exchangeT,
			 $climb,
			 $climbTwo,
			 $climbThree,
			 $issues,
			 $defenseBot,
			 $defenseComments,
			 $matchComments);
}

?>
<script>
function getMatchData() {
	$.ajax({
		type : "POST",
		url : "perrythescout/dataHandler.php?matchData:",
		data : JSON.stringify(nums),
		success : success,
	});
}


</script>