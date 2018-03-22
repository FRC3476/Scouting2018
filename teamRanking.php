<html>
<?php session_start();
include("header.php")?>
<body>
	<?php include("navbar.php")?>

	<div class="container row-offcanvas row-offcanvas-left">
		<div class="well column  col-lg-12  col-sm-12 col-xs-12" id="content">
			<h2>Team Ranking</h2>
			<table  class="sortable table table-hover" id="RawData" border="1">
				<tr>
					<th>Team Number</th>
					<th>Avg Switch A</th>
					<th>Max Switch A</th>
					<th>Avg Scale A</th>
					<th>Max Scale A</th>
					<th>Avg Switch T</th>
					<th>Max Switch T</th>
					<th>Avg Scale T</th>
					<th>Max Scale T</th>
					<th>Avg Opp Switch</th>
					<th>Max Opp Switch</th>
					<th>Avg Exchange</th>
					<th>Max Exchange</th>
					<th>Total 1 Climb</th>
					<th>Total 2 Climb</th>
					<th>Total 3 Climb</th>
					<th>Total Defence</th>
				</tr>
			<?php
				include("databaseLibrary.php");
				$teamList = getTeamList();
				//$TeamDat = array();
				
				foreach($teamList as $TeamNumber){
		 
					   $i=0;
					   $avgSwitchA = getAvgOwnSwitchA($TeamNumber);
					   $avgScaleA = getAvgOwnScaleA($TeamNumber);
					   $avgSwitchT = getAvgOwnSwitchT($TeamNumber);
					   $avgScaleT = getAvgOwnScaleT($TeamNumber);
					   $avgOppSwitchT = getAvgOppSwitchT($TeamNumber);
					   $avgExchangeT = getAvgExchangeT($TeamNumber);
					   $totalClimb = getTotalClimb($TeamNumber);
					   $twoClimb = getTotalClimbTwo($TeamNumber);
					   $threeClimb = getTotalClimbThree($TeamNumber);
					   $totalDefense = getTotalDefense($TeamNumber);
					   $maxSwitchA = max(getSwitchA($TeamNumber));
					   $maxSwitchT = max(getSwitchT($TeamNumber));
					   $maxScaleT = max(getScaleT($TeamNumber));
					   $maxScaleA = max(getScaleA($TeamNumber));
					   $maxOppSwitchT = max(getOppSwitchT($TeamNumber));
					   $maxExchangeT = max(getExchangeT($TeamNumber));
				
					
					echo("<tr>
					<td><a href='teamData.php?team=".$TeamNumber."'>".$TeamNumber."</a></td>
					<th>".$avgSwitchA."</th>
					<th>".$maxSwitchA."</th>
					<th>".$avgScaleA."</th>
					<th>".$maxScaleA."</th>
					<th>".$avgSwitchT."</th>
					<th>".$maxSwitchT."</th>
					<th>".$avgScaleT."</th>
					<th>".$maxScaleT."</th>
					<th>".$avgOppSwitchT."</th>
					<th>".$maxOppSwitchT."</th>
					<th>".$avgExchangeT."</th>
					<th>".$maxExchangeT."</th>
					<th>".$totalClimb."</th>
					<th>".$twoClimb."</th>
					<th>".$threeClimb."</th>
					<th>".$totalDefense."</th>
					</tr>");
				}
				
			?>
			</table>
		</div>
	</div>
</body>
<?php include("footer.php") ?>