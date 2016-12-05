<!-- advisor_view.php -->
<!-- This file shows the advisor what appointments they have scheduled -->
<!--
File call/redirect
	Receive: validate_advisor_login.php, advisor_view.php, validate_appointment.php, cancel_advisor_appointment.php
	Send: first_page.html, cancel_advisor_appointment.php, add_appointment.html
-->

<html>
<head>
<title>View Appointments</title>
<style>
table, th, td {
border: 1px solid black;
border-collapse: collapse;
}

td {
text-align:center;
vertical-align:middle;
}
/*
form {
position:relative;
top:8px;
}
*/
#list_view
{
  display: none;
}
#calendar_view
{
  display: inline-block;
}
#td_dayOfWeek
{
  width: 125px;
  text-align: center;
}
table#calendar_view th
{
  text-align: right;

}
#calendar_view tr, #calendar_view td, #calendar_view th
{
  border: 1px black solid
}
#Month
{
  text-align: center;
}
#calendar_view form
{
  height: 5px;
}
.appointmentButton
{
  border-top: 1px black dotted;
  padding-top: 5px;
  text-align: center;
  min-height: 79px;
}
</style>
</head>
<body>

<?php
require_once('../mysql_connect.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// set the timezone to the east coast
date_default_timezone_set('America/New_York');

// preparation for calendar creation
if(isset($_POST['monthEval']))
{
  $_SESSION['monthEval'] = $_POST['monthEval'];
  $countTime = $_POST['monthEval'];
}
else {
  $_SESSION['monthEval'] = "0";
  $countTime = 0;
}
//Creating Days of the week
$days = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
//Setting up the month to look at
$recordTime = strtotime('first day of +' . $countTime . ' month');
//If firstday of month not weekday get next monday
if(date("D",$recordTime) == "Sat" || date("D",$recordTime) == "Sun")
{
  $recordTime = strtotime('monday', $recordTime);
}
// end calendar preparation

//Fetching appointments
$sql = "SELECT * FROM appointments WHERE AdvisorUsername=\"" . $_SESSION['username'] . "\" ORDER BY Date ASC, Time ASC";
$rs = mysql_query($sql, $conn);

// Includes the navigation bar
include "../advisor_nav_bar.php";

$appt = mysql_fetch_array($rs);
$storage_array = array($appt);
// Prints out the titles of the table
if($appt)
{
  //Buttons for the two views
  echo "<div class='top_container'><h3>Scheduled Appointments<br>";
  echo "<button class='swapView' id='showTable' onclick='showTableButton()'>Table View</button><button class='swapView' id='showList' onclick='showListButton()'>List View</button></h3></div>";
  echo "<div class='bottom_container'>";
  echo "<table id='list_view'>";
  echo "<tr>";
  echo "<th>Date</th>";
  echo "<th>Time</th>";
  echo "<th>Location</th>";
  echo "<th>Group</th>";
  echo "<th>#Students</th>";
  echo "<th>View Registered Students</th>";
  echo "</tr>";

  // Now this cycles through the section of the query
  while ($appt) {
    echo "<tr>";
    echo "<td>" . $appt['Date'] . "</td>";
    echo "<td>" . date("g:ia", strtotime($appt['Time'])) . "</td>";
    echo "<td>" . $appt['Location'] . "</td>";

    // check if the appointment is a group appointment or not
    if($appt['isGroup'] == 0)
      echo "<td>" . "No" . "</td>";
    else
      // not a group appointment
      echo "<td>" . "Yes" . "</td>";

    echo "<td>" . $appt['NumStudents'] . "</td>";

    $apptID = $appt['id'];

    // Print out the check students button if there are students signed up for the appointment
    if ($appt['NumStudents'] > 0)
    {
      echo "<td>";
      echo "<form method=post action='view_students.php'>";
      echo "<input type=hidden name='ID' value=$apptID />";
      echo "<input type=submit value='View Registered Students'/>";
      echo "</form>";
      echo "</td>";

      // If there are not any students signed up then tell the user that
    } else {
      echo "<td>No Students Registered</td>";
    }

    ?>

    <td>
    <form method=post action="../cancel_advisor_appointment.php">
       <?php echo "<input type=hidden name='ID' value=$apptID />"; ?>
       <input type=submit value="Cancel"/>
       </form>
	 </td>
<?php
  echo "</tr>";
  $appt = mysql_fetch_array($rs);
  array_push($storage_array,$appt);
}
  echo "</table>";
}

else
{
  echo "<h3>You have not scheduled any appointments</h3>";
}

// CALENDAR VIEW
echo("<table id='calendar_view'><tr>");
echo("<td colspan='5' id='Month'>");
//Back button for month
echo("<form action='advisor_view.php' method='post'>");
echo("<button type='submit' name='monthEval' value=" . ($countTime - 1) . ">&#60</button>");
//Month print
echo(date("F",$recordTime));
//Forward button for month
echo("<button type='submit' name='monthEval' value=" . ($countTime + 1) . ">&#62</button>");
echo("</form>");
echo("</td></tr><tr>");
//Text day of week printing
for($i = 0 ; $i < (count($days) - 2) ; $i++)
{
  echo("<td id='td_dayOfWeek'>" . $days[$i] . "</td>");
}
echo("</tr><tr>");
//echo(date('m/d/y',strtotime('last day of +0 months',$recordTime)));
$i = -1;

//Printing day
while($recordTime != strtotime('last day of +0 months',$recordTime))
{
  //Increment the day being looked at
  $i += 1;
  //Printing if only weekday
  if((date('D',$recordTime) == $days[$i]) && ($days[$i] != "Sat") && ($days[$i] != "Sun"))
  {
    echo("<th>" . date('j',$recordTime));
    echo("<div class='appointmentButton'>");
    printAppointments($recordTime, $storage_array);
    echo("</div>");
    echo("</th>");
    $recordTime = strtotime('+1 days',$recordTime);

  }
  elseif($days[$i] == "Sat"){
    echo("");
  }
  //Prepare next week
  elseif($days[$i] == "Sun")
  {
    echo("</tr><tr>");
    $recordTime = strtotime('next week',$recordTime);
    $i = -1;
  }
  //The first day of the month isn't monday
  else
  {
    echo("<td></td>");
  }
  //echo(date("m/d/y",$recordTime) . "<br>");
}
//Printing to complete the month boxes
$i += 2;
//If end of printing is not Saturday or Sunday, then print the final day
if((date('D',$recordTime) != "Sat") && (date('D',$recordTime) != "Sun"))
{
  echo("<th>" . date('j',$recordTime));
  echo("<div class='appointmentButton'>");
  printAppointments($recordTime, $storage_array);
  echo("</div>");
  //echo("<div class='appointmentButton'><button>11am-12pm | 3/6</button></div>");
  echo("</th>");
}
//Print to complete the calendar boxes
for(; $i < (count($days) - 2) ; $i++)
{
  echo("<td></td>");
}
//Fill in for appointments
echo("</tr>");
echo("</table>");
?>
</div>
</body>
</html>
<script>
list_view
calendar_view
function showListButton()
{
  document.getElementById('list_view').style.display = "inline-block";
  document.getElementById('calendar_view').style.display = "none";
}
function showTableButton()
{
  document.getElementById('calendar_view').style.display = "inline-block";
  document.getElementById('list_view').style.display = "none";
}

</script>
<?php
//Functions
function printAppointments($timeEvaluation, $appointmentArray)
{
  for($i = 0 ; $i < count($appointmentArray) ; $i++)
  {
    //If appointments are further than the current date evaluation
    if(date("Y-m-d", $timeEvaluation) < $appointmentArray[$i]['Date']){
      return;
    }
    elseif(date("Y-m-d", $timeEvaluation) == $appointmentArray[$i]['Date']){
      //echo $appointmentArray[$i]['Date'] . ": " . date("Y-m-d", $timeEvaluation) . "<br>"  . $timeEvaluation . " =?= " . strtotime($appointmentArray[$i]['Date']);
      $appointmentTime = strtotime($appointmentArray[$i]['Time']);
      $EndAppointTime = strtotime("+30 minutes", $appointmentTime);
      $buttonString = date("g:ia", $appointmentTime) . "-" . date("g:ia", $EndAppointTime) . " | " . $appointmentArray[$i]['NumStudents']. "/?";
      echo("<button value='" . $appointmentArray[$i]['id'] . "'>" . $buttonString . "</button><br>");
    }
  }
}

 ?>
