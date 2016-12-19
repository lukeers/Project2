<?php
	include("../../php/advisor_nav_bar.php");
?>

<html>

	<h1>Printable Report</h1>
	
	<form method=post action="advisor_report.php">

		<p>Starting Date: <input type=date name="start_date"></p>
		<p>Ending Date: <input type=date name="end_date"></p>
		<p>Include all appointments? <input type=checkbox name="all_appointments"></p>
		<p>Goals and Questions? <input type=checkbox name="extra_info"></p>
		<p><input type=submit value="Submit"/></p>
	</form>
	
</html>