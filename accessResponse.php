<?php

$session = session_id();
if (!$session) {
	session_start();
	$session = session_id();
}

$accessArray = $_SESSION['accessResponse'];

?>
<head>
	<link rel="stylesheet" href="css/style.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
	body {
		background-color: #E7E3E0;
	}

	table.fullResponse tr {
		line-height: 30px;
	}

	table.fullResponse td {
		padding: 5px;
	}
</style>


<table class="fullResponse">

	<h3 class="heading"> Full list of Kount Access response fields</h3>

	<?php
	foreach ($accessArray as $key => $res) {
		switch($key) {
			case 'response_id':
				echo '<tr>';
				echo '<td><label class="formLabel" for="">' . strtoupper($key) . '</label></td>';
				echo "<td><input class='form-control' type='text' name='name' value='$res' readonly> </input></td>";
				echo '</tr>';
				break;
			case 'device':
				echo '<tr>';
				echo '<td><label class="headLabel" for="">' . "Device" . '</label></td>';
				echo '</tr>';
				foreach ($accessArray[$key] as $deviceKey => $val) {
					echo '<tr>';
					echo '<td><label class="formLabel" for="">' . strtoupper($deviceKey) . '</label></td>';
					echo "<td><input class='form-control' type='text' name='name' value='$val' readonly> </input></td>";
					echo '</tr>';
				}
				break;
			case 'velocity':
				echo '<tr>';
				echo '<td><label class="headLabel" for="">' . "Velocity" . '</label></td>';
				echo '</tr>';
				foreach ($accessArray[$key] as $velocityKey => $title) {
					echo '<tr>';
					echo '<td><label class="smallHeadLabel" for="">' . "$velocityKey" . '</label></td>';
					echo '</tr>';
					foreach ($accessArray[$key][$velocityKey] as $vKey => $vVal) {
						echo '<tr>';
						echo '<td><label class="formLabel" for="">' . strtoupper($vKey) . '</label></td>';
						echo "<td><input class='form-control' type='text' name='name' value='$vVal' readonly> </input></td>";
						echo '</tr>';
					}
				}
				break;
			case 'decision':
				echo '<tr>';
				echo '<td><label class="headLabel" style="font-weight: bold; font-size: 15px" for="">' . "Decision" . '</label></td>';
				echo '</tr>';
				echo '<tr>';
				if (!is_array($accessArray[$key]['reply']['ruleEvents'])) {
					foreach ($accessArray[$key]['reply']['ruleEvents'] as $decisionKey => $dRes) {
						echo '<tr>';
						echo '<td><label class="formLabel" for="">' . strtoupper($decisionKey) . '</label></td>';
						echo "<td><input class='form-control' type='text' name='name' value='$dRes' readonly> </input></td>";
						echo '</tr>';
					}
				} else {
					foreach ($accessArray[$key]['reply']['ruleEvents']['ruleEvents'][0] as $eventKey => $eventValue) {
						echo '<tr>';
						echo '<td><label class="formLabel" for="">' . strtoupper($eventKey) . '</label></td>';
						echo "<td><input class='form-control' type='text' name='name' value='$eventValue' readonly> </input></td>";
						echo '</tr>';
					}

				}
				break;
		}
	}
	?>
</table>



