<?php
include("databaseName.php");
	//Input- runQuery, establishes connection with server, runs query, closes connection.
	//Output- queryOutput, data to/from the tables in phpMyAdmin databases.
	function runQuery($queryString){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $pitScoutTable;
		global $matchScoutTable;
		//Establish Connection
		try{
			$conn = connectToDB();
		}
		catch(Exception $e){
			error_log("CREATING DB");
			createDB();
			$conn = connectToDB();
		}
		//new mysqli($servername, $username, $password, $dbname);
		//error_log($queryString);
		
		try{
			$statement = $conn->prepare($queryString);
		}
		catch(PDOException $e){
			error_log($e->getMessage());
			error_log($e->getCode());
			if($e->getCode() == "42S02"){
				error_log("CREATING TABLES");
				createTables();
			}
			$statement = $conn->prepare($queryString);
		}
		
		if(!$statement->execute()){
			die("Failed!" );
		}
		
		try{
			return $statement->fetchAll();
		}
		catch(Exception $e){
			return;
		}
		// Check connection
		/*if ($conn->connect_error) {
			//Try to create tables
			createTables();
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		}
		//Assign output of query to seperate var
		$queryOutput = 0;
		try {
			$queryOutput = $conn->query($queryString);
		}catch (mysqli_sql_exception $e) {
			error_log("Error Code <br>".$e->getCode());
			error_log("Error Message <br>".$e->getMessage());
			error_log("Strack Trace <br>".nl2br($e->getTraceAsString()));
		}
		//$queryOutput = $conn->query($queryString);
		//Close connection
		$conn->close();
		//Return output
		return($queryOutput);*/
	}
	function createDB(){
		global $dbname;
		$connection = connectToServer();
		$statement = $connection->prepare('CREATE DATABASE IF NOT EXISTS '.$dbname);
		if(!$statement->execute()){
			throw new Exception("constructDatabase Error: CREATE DATABASE query failed.");
		}
	}
	
	function connectToServer(){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $charset;
		
		$dsn = "mysql:host=".$servername.";charset=".$charset;
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false
		];
		return(new PDO($dsn, $username, $password, $opt));
	}
	
	function connectToDB(){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $charset;
		
		$dsn = "mysql:host=".$servername.";dbname=".$dbname.";charset=".$charset;
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false
		];
		return(new PDO($dsn, $username, $password, $opt));
	
	}
	
	function createTables(){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $pitScoutTable;
		global $matchScoutTable;
		global $headScoutTable;
		
		$conn = connectToDB();
		$query = "CREATE TABLE ".$dbname.".".$pitScoutTable. " (
			teamNumber VARCHAR(50) NOT NULL PRIMARY KEY,
			teamName VARCHAR(60) NOT NULL,
			weight VARCHAR(20) NOT NULL,
			height VARCHAR(20) NOT NULL,
			numBatteries VARCHAR(20) NOT NULL,
			chargedBatteries VARCHAR(20) NOT NULL,
			driveTrain VARCHAR(20) NOT NULL,
			pitComments VARCHAR(100) NOT NULL
		)";
		$statement = $conn->prepare($query);
		if(!$statement->execute()){
			throw new Exception("constructDatabase Error: CREATE TABLE pitScoutTable query failed.");
		}
		
		$query = "CREATE TABLE ".$dbname.".".$matchScoutTable. " (
			user VARCHAR(20) NOT NULL,
			ID VARCHAR(8) NOT NULL PRIMARY KEY,
			matchNum INT(11) NOT NULL,
			teamNum INT(11) NOT NULL,
			allianceColor TEXT NOT NULL,
			autoPath LONGTEXT NOT NULL,
			crossLineA INT(11) NOT NULL,
			ownSwitchA INT(11) NOT NULL,
			ownScaleA INT(11) NOT NULL,
			ownSwitchT INT(11) NOT NULL,
			ownScaleT INT(11) NOT NULL,
			oppSwitchT INT(11) NOT NULL,
			exchangeT INT(11) NOT NULL,
			climb TINYINT(4) NOT NULL,
			climbTwo TINYINT(4) NOT NULL,
			climbThree TINYINT(4) NOT NULL,
			issues LONGTEXT NOT NULL,
			defenseBot TINYINT(4) NOT NULL,
			defenseComments LONGTEXT NOT NULL,
			matchComments LONGTEXT NOT NULL
		)";
		$statement = $conn->prepare($query);
		if(!$statement->execute()){
			throw new Exception("constructDatabase Error: CREATE TABLE pitScoutTable query failed.");
		}
		
		$query = "CREATE TABLE ".$dbname.".".$headScoutTable. " (
			matchNum INT(11) NOT NULL PRIMARY KEY,
			team1 INT(11) NOT NULL,
			team2 INT(11) NOT NULL,
			team3 INT(11) NOT NULL,
			team4 INT(11) NOT NULL,
			team5 INT(11) NOT NULL,
			team6 INT(11) NOT NULL,
			strategy1 LONGTEXT NOT NULL,
			strategy2 LONGTEXT NOT NULL,
			strategy3 LONGTEXT NOT NULL,
			strategy4 LONGTEXT NOT NULL,
			strategy5 LONGTEXT NOT NULL,
			strategy6 LONGTEXT NOT NULL
		)";
		$statement = $conn->prepare($query);
		if(!$statement->execute()){
			throw new Exception("constructDatabase Error: CREATE TABLE pitScoutTable query failed.");
		}
	}
	//Input- pitScoutInput, Data from pit scout form is assigned to columns in 17template_pitscout.
	//Output- queryString and "Success" statement, data put in columns.
	function pitScoutInput($teamNum, $teamName, $weight, $height, $numBatteries,$chargedBatteries, $driveTrain, $pitComments){
		global $pitScoutTable;
		$queryString = "REPLACE INTO `".$pitScoutTable.'`(`teamNumber`, `teamName`, `weight`, `height`, `numBatteries`,`chargedBatteries`, `driveTrain`, `pitComments`)
				VALUES ("'.$teamNum.'", "'.$teamName.'", "'.$weight.'", "'.$height.'", "'.$numBatteries.'", "'.$chargedBatteries.'", "'.$driveTrain.'", "'.$pitComments.'")';
		$queryOutput = runQuery($queryString);	
		if ($queryOutput === TRUE) {
			return "Success";
		} else {
			return "Error: " . $queryOutput . "<br>";
		}		
	}
	//Input- getTeamList, accesses pit scout table and gets team numbers from it.
	//Output- array, list of teams in teamNumber column of 17template_pitscout table.
	function getTeamList(){
		global $pitScoutTable;
		$queryString = "SELECT `teamNumber` FROM `".$pitScoutTable."`";
		$result = runQuery($queryString);
		$teams = array();
			foreach ($result as $row_key => $row){
				array_push($teams, $row["teamNumber"]);
			}
		return($teams);
		
	}
	//Input- pitScoutInput, Data from pit scout form is assigned to columns in 17template_matchinput.
	//Output- queryString and "Success" statement, data put in columns.
	function matchInput( $user,
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
						 $matchComments){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $matchScoutTable;
		$queryString = "REPLACE INTO `".$matchScoutTable.'`(  `user`,
															 `ID`,
															 `matchNum`,
															 `teamNum`,
															 `allianceColor`,
															 `autoPath`,
															 `crossLineA`,
															 `ownSwitchA`,
															 `ownScaleA`,
															 `ownSwitchT`,
															 `ownScaleT`,
															 `oppSwitchT`,
															 `exchangeT`,
															 `climb`,
															 `climbTwo`,
															 `climbThree`,
															 `issues`,
															 `defenseBot`,
															 `defenseComments`,
															 `matchComments`)
													VALUES ( "'.$user.'",
															 "'.$ID.'",
															 "'.$matchNum.'",
															 "'.$teamNum.'",
															 "'.$allianceColor.'",
															 "'.$autoPath.'",
															 "'.$crossLineA.'",
															 "'.$ownSwitchA.'",
															 "'.$ownScaleA.'",
															 "'.$ownSwitchT.'",
															 "'.$ownScaleT.'",
															 "'.$oppSwitchT.'",
															 "'.$exchangeT.'",
															 "'.$climb.'",
															 "'.$climbTwo.'",
															 "'.$climbThree.'",
															 "'.$issues.'",
															 "'.$defenseBot.'",
															 "'.$defenseComments.'",
															 "'.$matchComments.'")';
		$queryOutput = runQuery($queryString);	
		if ($queryOutput === TRUE) {
			return "Success";
		} else {
			return "Error: " . $queryOutput . "<br>";
		}		
	}
	function headScoutInput($matchNum,
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
							$strategy6){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $headScoutTable;
		$queryString = "REPLACE INTO `".$headScoutTable.'`(  `matchNum`,
															`team1`,
															`team2`,
															`team3`,
															`team4`,
															`team5`,
															`team6`,
															`strategy1`,
															`strategy2`,
															`strategy3`,
															`strategy4`,
															`strategy5`,
															`strategy6`) 
															VALUES 
															("'.$matchNum.'",
															"'.$team1.'",
															"'.$team2.'",
															"'.$team3.'",
															"'.$team4.'",
															"'.$team5.'",
															"'.$team6.'",
															"'.$strategy1.'",
															"'.$strategy2.'",
															"'.$strategy3.'",
															"'.$strategy4.'",
															"'.$strategy5.'",
															"'.$strategy6.'")';
		error_log($queryString);
		$queryOutput = runQuery($queryString);	
		if ($queryOutput === TRUE) {
			return "Success";
		} else {
			return "Error: " . $queryOutput . "<br>";
		}		
	}
	
	function getAllMatchData(){
		global $matchScoutTable;
		$qs1 = "SELECT * FROM `".$matchScoutTable."`";
		return runQuery($qs1);
	}
	
	function getAllHeadScoutData(){
		global $headScoutTable;
		$qs1 = "SELECT * FROM `".$headScoutTable."`";
		return runQuery($qs1);

	}
	
	function getTeamData($teamNumber){
		global $servername;
		global $username;
		global $password;
		global $dbname;
		global $pitScoutTable;
		global $matchScoutTable;
		global $headScoutTable;
		
		$qs1 = "SELECT * FROM `".$pitScoutTable."` WHERE teamNumber = ".$teamNumber."";
		$qs2 = "SELECT * FROM `".$matchScoutTable."`  WHERE teamNum = ".$teamNumber."";
		$qs3 = "SELECT * FROM `".$headScoutTable."`";
		$result = runQuery($qs1);
		$result2 = runQuery($qs2);
		$result3 = runQuery($qs3);
		$teamData = array();
		$pitExists = False;
		if($result != FALSE){					
				// output data of each row
				foreach ($result as $row_key => $row){
					array_push( $teamData, $row["teamName"], $row["weight"], $row["height"], $row["numBatteries"], $row["chargedBatteries"], $row["driveTrain"], $row["pitComments"], array(), array());
					$pitExists = True;
			}
		}
		if(!$pitExists){
			array_push( $teamData, $teamNumber, "NA", "NA", "NA", "NA", "NA", "NA", array(), array());
		}
		if($result2 != FALSE){
			foreach ($result2 as $row_key => $row){
				array_push(	$teamData[7], array($row["user"], $row["ID"], $row["matchNum"], 
							$row["teamNum"], $row["allianceColor"], $row["autoPath"], 
							$row["crossLineA"], $row["ownSwitchA"], $row["ownScaleA"], 
							$row["ownSwitchT"], $row["ownScaleT"], $row["oppSwitchT"], 
							$row["exchangeT"],  $row["climb"], $row["climbTwo"], 
							$row["climbThree"], $row["issues"], $row["defenseBot"], 
							$row["defenseComments"], $row["matchComments"]));
			}	
		}
		if($result3 != FALSE){
			foreach ($result3 as $row_key => $row){
				array_push(	$teamData[8], array($row["matchNum"], $row["team1"], $row["team2"], 
							$row["team3"], $row["team4"], $row["team5"], $row["team6"], 
							$row["strategy1"], $row["strategy2"], $row["strategy3"], 
							$row["strategy4"], $row["strategy5"], $row["strategy6"]));
			}
		}
		return($teamData);
	}
	
	function getAvgOwnSwitchA($teamNumber){
		$teamData = getTeamData($teamNumber);
		$cubeCount = 0;
		$matchCount  = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeCount = $cubeCount + $teamData[7][$i][7];
			$matchCount++;
		}
		return($cubeCount/$matchCount);
	}
	function getAvgOwnScaleA($teamNumber){
		$teamData = getTeamData($teamNumber);
		$cubeCount = 0;
		$matchCount  = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeCount = $cubeCount + $teamData[7][$i][8];
			$matchCount++;
		}
		return ($cubeCount/$matchCount);
	}
	function getAvgOwnSwitchT($teamNumber){
		$teamData = getTeamData($teamNumber);
		$cubeCount = 0;
		$matchCount  = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeCount = $cubeCount + $teamData[7][$i][9];
			$matchCount++;
		}
		return($cubeCount/$matchCount);
	}
	function getAvgOwnScaleT($teamNumber){
		$teamData = getTeamData($teamNumber);
		$cubeCount = 0;
		$matchCount  = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeCount = $cubeCount + $teamData[7][$i][10];
			$matchCount++;
		}
		return ($cubeCount/$matchCount);
	}
	function getAvgOppSwitchT($teamNumber){
		$teamData = getTeamData($teamNumber);
		$cubeCount = 0;
		$matchCount  = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeCount = $cubeCount + $teamData[7][$i][11];
			$matchCount++;
		}
		return($cubeCount/$matchCount);
	}
	function getAvgExchangeT($teamNumber){
		$teamData = getTeamData($teamNumber);
		$cubeCount = 0;
		$matchCount  = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeCount = $cubeCount + $teamData[7][$i][12];
			$matchCount++;
		}
		return($cubeCount/$matchCount);
	}
	function getTotalClimb($teamNumber){
		$teamData = getTeamData($teamNumber);
		$climbCount = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$climbCount = $climbCount + $teamData[7][$i][13];
		}
		return ($climbCount);
	}
	function getTotalClimbTwo($teamNumber){
		$teamData = getTeamData($teamNumber);
		$climbCount = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$climbCount = $climbCount + $teamData[7][$i][14];
		}
		return ($climbCount);
	}
	function getTotalClimbThree($teamNumber){
		$teamData = getTeamData($teamNumber);
		$climbCount = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$climbCount = $climbCount + $teamData[7][$i][15];
		}
		return ($climbCount);
	}
	function getTotalDefense($teamNumber){
		$teamData = getTeamData($teamNumber);
		$defenseCount = 0;
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$defenseCount = $defenseCount + $teamData[7][$i][17];
		}
		return ($defenseCount);
	}
	function getSwitchA($teamNumber){
		$teamData = getTeamData($teamNumber);
		$matchN = matchNum($teamNumber);
		$cubeGraphA = array();
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeGraphA[$teamData[7][$i][2]] = $teamData[7][$i][7];
		}
		$out = array();
		for($i = 0; $i != sizeof($matchN); $i++){
			array_push($out , $cubeGraphA[$matchN[$i]]);
		}
		return ($out);
	}
	function getScaleA($teamNumber){
		$teamData = getTeamData($teamNumber);
		$matchN = matchNum($teamNumber);
		$cubeGraphA = array();
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeGraphA[$teamData[7][$i][2]] = $teamData[7][$i][8];
		}
		$out = array();
		for($i = 0; $i != sizeof($matchN); $i++){
			array_push($out , $cubeGraphA[$matchN[$i]]);
		}
		return ($out);
	}
	function getSwitchT($teamNumber){
		$teamData = getTeamData($teamNumber);
		$matchN = matchNum($teamNumber);
		$cubeGraphT = array();
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeGraphT[$teamData[7][$i][2]] = $teamData[7][$i][9];
		}
		$out = array();
		for($i = 0; $i != sizeof($matchN); $i++){
			array_push($out , $cubeGraphT[$matchN[$i]]);
		}
		return ($out);
	}
	function getScaleT($teamNumber){
		$teamData = getTeamData($teamNumber);
		$matchN = matchNum($teamNumber);
		$cubeGraphT = array();
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeGraphT[$teamData[7][$i][2]] = $teamData[7][$i][10];
		}
		$out = array();
		for($i = 0; $i != sizeof($matchN); $i++){
			array_push($out , $cubeGraphT[$matchN[$i]]);
		}
		return ($out);
	}
	function getOppSwitchT($teamNumber){
		$teamData = getTeamData($teamNumber);
		$matchN = matchNum($teamNumber);
		$cubeGraphT = array();
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeGraphT[$teamData[7][$i][2]] = $teamData[7][$i][11];
		}
		$out = array();
		for($i = 0; $i != sizeof($matchN); $i++){
			array_push($out , $cubeGraphT[$matchN[$i]]);
		}
		return ($out);
	}
	function getExchangeT($teamNumber){
		$teamData = getTeamData($teamNumber);
		$matchN = matchNum($teamNumber);
		$cubeGraphT = array();
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			$cubeGraphT[$teamData[7][$i][2]] = $teamData[7][$i][12];
		}
		$out = array();
		for($i = 0; $i != sizeof($matchN); $i++){
			array_push($out , $cubeGraphT[$matchN[$i]]);
		}
		return ($out);
	}
	function matchNum($teamNumber){
		$teamData = getTeamData($teamNumber);
		$matchNum = array();
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			array_push($matchNum, $teamData[7][$i][2]);
		}
		sort($matchNum);
		return ($matchNum);
	}
	function defenseComments($teamNumber){
		$teamData = getTeamData($teamNumber);
		$defenseComments = array();
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			array_push($defenseComments, $teamData[7][$i][18]);
		}
		return ($defenseComments);
	}
	function matchComments($teamNumber){
		$teamData = getTeamData($teamNumber);
		$matchComments = array();
		for($i = 0; $i != sizeof($teamData[7]); $i++){
			array_push($matchComments, $teamData[7][$i][19]);
		}
		return ($matchComments);
	}
	function headScoutComments($teamNumber){
		$teamData = getTeamData($teamNumber);
		$headScoutComments = array();
		for($i = 0; $i != sizeof($teamData[8]); $i++){
			if($teamData[8][$i][1] == $teamNumber){
				array_push($headScoutComments, $teamData[8][$i][7]);
			}
			if($teamData[8][$i][2] == $teamNumber){
				array_push($headScoutComments, $teamData[8][$i][8]);
			}
			if($teamData[8][$i][3] == $teamNumber){
				array_push($headScoutComments, $teamData[8][$i][9]);
			}
			if($teamData[8][$i][4] == $teamNumber){
				array_push($headScoutComments, $teamData[8][$i][10]);
			}
			if($teamData[8][$i][5] == $teamNumber){
				array_push($headScoutComments, $teamData[8][$i][11]);
			}
			if($teamData[8][$i][6] == $teamNumber){
				array_push($headScoutComments, $teamData[8][$i][12]);
			}
		}
		return ($headScoutComments);
	}
?>