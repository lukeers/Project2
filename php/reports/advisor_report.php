<style>
table, th, td {
border: 1px solid black;
border-collapse: collapse;
}
</style>

<?php 
	require_once('../mysql_connect.php'); 
	session_start();
?>

<div class='top_container'><h3>Scheduled Appointments<br>
  <div class='bottom_container'>
    <table id='list_view'>
		<tr>
			<th>Advisor</th>
			<th>Time</th>
			<th>Time</th>
			<th>Location</th>
			<th>Size</th>
			<th>Registered Students</th>
			<th>Student IDs</th>
			<th>Student Majors</th>
			<?php if(isset($_POST['extra_info'])){
				echo "<th>Student Plans</th>";
				echo "<th>Student Questions</th>";
			}?>
		</tr>
	<?php
	if(isset($_POST['all_appointments']))
		$sql = "SELECT * FROM appointments WHERE Date>='". $_POST['start_date'] ."' AND Date<='". $_POST['end_date'] ."' ORDER BY Date ASC, Time ASC";
	else{
		$advisorQuery = "SELECT fullName FROM advisors WHERE Username='". $_SESSION['username'] . "'";
		$advisorName = mysql_fetch_array(mysql_query($advisorQuery, $conn))['fullName'];
		$sql = "SELECT * FROM appointments WHERE Advisor='". $advisorName . "'AND Date>='". $_POST['start_date'] ."' AND Date<='". $_POST['end_date'] ."' ORDER BY Date ASC, Time ASC";
	}
	$rs = mysql_query($sql, $conn);
	$appt = mysql_fetch_array($rs);
	while($appt){
	    echo "<tr><td>" . $appt['Advisor'] . "</td>";
        echo "<td>" . $appt['Date'] . "</td>";
        echo "<td>" . date("g:ia", strtotime($appt['Time'])) . "</td>";
        echo "<td>" . $appt['Location'] . "</td>";
        echo "<td>" . $appt['size'] . "</td>";
	    $sql = "SELECT * FROM students WHERE Appt='" . $appt['id'] . "' ORDER BY lastName";
	    $rs1 = mysql_query($sql, $conn);
	    $students = mysql_fetch_array($rs1);
	    echo "<td colspan=5><table>";
	    while($students){
			echo "<tr><td>" . $students['lastName'].", ".$students['firstName']."</td>";
			echo "<td>" . $students['studentID'] ."</td>";
			echo "<td>" . $students['Major'] ."</td>";
			if(isset($_POST['extra_info'])){
				echo "<td>" . $students['plans'] ."</td>";
				echo "<td>" . $students['concerns'] ."</td>";
			}
			echo "</tr>";
			$students = mysql_fetch_array($rs1);
		}
		echo "</table></td></tr>";
		$appt = mysql_fetch_array($rs);
	}
	?>
    </table>
	<input type="button" value="Print this page" onClick="window.print()">
  </div>
</div>  
