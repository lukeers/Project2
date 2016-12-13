<!-- advisor_view.php -->
<!-- This file shows the advisor what appointments they have scheduled -->
<!--
File call/redirect
	Receive: validate_advisor_login.php, advisor_view.php, validate_appointment.php, cancel_advisor_appointment.php, view_students.php
	Send: first_page.html, cancel_advisor_appointment.php, add_appointment.html, view_students.php
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
h3
{
  margin: 0px
}
#CheckBoxContainer
{
  margin: 1px 0px;
}
/* Calendar View Style */
.list_view
{
  display: none;
  margin-top: 10px;
}
#calendar_view
{
  display: inline-block;
}
#td_dayOfWeek
{
  min-width: 140px;
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
/* Container for buttons */
.appointmentButton
{
  border-top: 1px black dotted;
  padding-top: 5px;
  text-align: center;
  height: 132px;
  overflow: auto;
}
#calendar_view button.userButton, #calendar_view button.otherUserButton
{
  border-radius: 7px;
  border: 1px black solid;
  margin: 1px;
  min-width: 135px;
}
/* End of Calendar View Style */

/* List View Style */
.list_view form
{
  height: 0px;
}
.list_view tr
{
  height: 25px;
}
/* End of List View Style */

/* Defines the colors for the user and other-users */
.userRow, .userButton, .userButtonColor
{
  background-color: palegreen;
}
.otherUserRow, .otherUserButton, .otherUserButtonColor
{
  background-color: lightblue;
}

/* Spaces out the checkboxes */
#CheckBoxStyle.otherUserButtonColor
{
  margin-left: 80px;
}
/* Applies custom checkbox style */
#CheckBoxStyle
{
  -webkit-appearance: none;
  border: 1px black solid;
  padding: 5px;
  margin: 0px 2px;
  border-radius: 5px;
  position: relative;
}
#CheckBoxStyle:focus
{
  outline: none;
}
#CheckBoxStyle:checked:after
{
  content: '\2714';
  font-size: 14px;
  position: absolute;
  top: -6px;
  left: 1px;
}
</style>
</head>
<body>

<?php
require_once('../mysql_connect.php');

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

// Includes the navigation bar
include "../advisor_nav_bar.php";

//Fetching appointments
$sql = "SELECT * FROM appointments ORDER BY Date ASC, Time ASC";
$rs = mysql_query($sql, $conn);

$appt = mysql_fetch_array($rs);
$storage_array = array();
//Used to store appoints in the past
$old_appointments = array();
//Used to store individual appointments
$catch_case_appointments = array();

// Prints out the titles of the table
if($appt)
{
  //Buttons for the two views
  echo "<div class='top_container'>";
  echo "<h3>Scheduled Appointments<br>";
  echo "<button class='swapView' id='showTable' onclick='showTableButton()'>Table View</button>";
  echo "<button class='swapView' id='showList' onclick='showListButton()'>List View</button></h3>";
  echo "<p id='CheckBoxContainer'><input type='checkbox' id='CheckBoxStyle' class='userButtonColor' onchange='toggleCheckbox(this)' value='user' checked>My Appointments";
  echo "<input type='checkbox' id='CheckBoxStyle' class='otherUserButtonColor' onchange='toggleCheckbox(this)' value='otherUser' checked>Other Appointments</p>";
  echo "</div>";

  //Table starting
  echo "<div class='bottom_container'>";
  echo "<table class='list_view'>";
  echo "<tr><th colspan='6'>Group Appointments</th></tr>";
  echo "<tr>";
  echo "<th>Advisor</th>";
  echo "<th>Date</th>";
  echo "<th>Time</th>";
  echo "<th>Location</th>";
  echo "<th>#Students</th>";
  echo "<th>View Registered Students</th>";
  echo "</tr>";

  // Now this cycles through the section of the query
  while ($appt) {
    array_push($storage_array,$appt);
    //Sorts into past appointments and future
    //If appoint was in past store for later
    if(strtotime($appt['Date']) < strtotime("Now"))
    {
      array_push($old_appointments, $appt);
      $appt = mysql_fetch_array($rs);
      continue;
    }
    //If appointment is individual store for later
    if($appt['isGroup'] == 0)
    {
      array_push($catch_case_appointments, $appt);
      $appt = mysql_fetch_array($rs);
      continue;
    }
    //Returns 0 if they are equal (doesn't look at case)
    if(strcasecmp($_SESSION['username'] , $appt['AdvisorUsername']) == 0)
    {
      echo "<tr class='userRow'>";
    }
    else
    {
      echo "<tr class='otherUserRow'>";
    }
    echo "<td>" . $appt['Advisor'] . "</td>";
    echo "<td>" . $appt['Date'] . "</td>";
    echo "<td>" . date("g:ia", strtotime($appt['Time'])) . "</td>";
    echo "<td>" . $appt['Location'] . "</td>";
    echo "<td>" . $appt['NumStudents'] . "</td>";

    $apptID = $appt['id'];

    // Print out the check students button if there are students signed up for the appointment
    if ($appt['NumStudents'] > 0)
    {
      echo "<td>";
      echo "<form method=post action='view_students.php'>";
      echo "<button type='submit' name='ID' value='" . $appt['id'] . "'>View Registered Students</button>";
      echo "</form>";
      echo "</td>";
      // If there are not any students signed up then tell the user that
    } else {
      echo "<td>No Students Registered</td>";
    }

  //Canceling Appoitnment Button
  echo "<td>";
  echo "<form method=post action='../cancel_advisor_appointment.php'>";
  echo "<button type='submit' name='ID' value='" . $appt['id'] . "'>Cancel</button>";
  echo "</form>";
	echo "</td>";

  echo "</tr>";
  $appt = mysql_fetch_array($rs);
} // End the table printing loop
  echo "</table><br class='list_view'>";

  //Printing individual appointments
  echo "<table class='list_view'>";
  echo "<tr><th colspan='6'>individual Appointments</th></tr>";
  echo "<tr>";
  echo "<th>Advisor</th>";
  echo "<th>Date</th>";
  echo "<th>Time</th>";
  echo "<th>Location</th>";
  echo "<th>#Students</th>";
  echo "<th>View Registered Students</th>";
  echo "</tr>";
  for($i = 0 ; $i < count($catch_case_appointments) ; $i++)
  {
    //Returns 0 if they are equal (doesn't look at case)
    if(!strcasecmp($_SESSION['username'] , $catch_case_appointments[$i]['AdvisorUsername']))
    {
      echo "<tr class='userRow'>";
    }
    else
    {
      echo "<tr class='otherUserRow'>";
    }
    echo "<td>" . $catch_case_appointments[$i]['Advisor'] . "</td>";
    echo "<td>" . $catch_case_appointments[$i]['Date'] . "</td>";
    echo "<td>" . date("g:ia", strtotime($catch_case_appointments[$i]['Time'])) . "</td>";
    echo "<td>" . $catch_case_appointments[$i]['Location'] . "</td>";
    echo "<td>" . $catch_case_appointments[$i]['NumStudents'] . "</td>";
    // Print out the check students button if there are students signed up for the appointment
    if ($catch_case_appointments[$i]['NumStudents'] > 0)
    {
      echo "<td>";
      echo "<form method=post action='view_students.php'>";
      echo "<input type=hidden name='ID' value='" . $catch_case_appointments[$i]['id'] . "'>";
      echo "<input type=submit value='View Registered Students'>";
      echo "</form>";
      echo "</td>";
    }
    // If there are not any students signed up then tell the user that
    else
    {
      echo "<td>No Students Registered</td>";
    }
    echo "<td><form method=post action='../cancel_advisor_appointment.php'>";
    echo "<input type=hidden name='ID' value='" . $catch_case_appointments[$i]['id'] . "' />";
    echo "<input type=submit value='Cancel'/>";
	  echo "</form></td>";
    echo "</tr>";
  }
  echo "</table><br class='list_view'>";

  //Printing Old Appointment table
  echo "<table class='list_view'>";
  echo "<tr><th colspan='7'>Past Appointments</th></tr>";
  echo "<tr>";
  echo "<th>Advisor</th>";
  echo "<th>Date</th>";
  echo "<th>Time</th>";
  echo "<th>Location</th>";
  echo "<th>Group</th>";
  echo "<th>#Students</th>";
  echo "<th>View Registered Students</th>";
  echo "</tr>";
  for($i = 0 ; $i < count($old_appointments) ; $i++)
  {
    //Returns 0 if they are equal (doesn't look at case)
    if(!strcasecmp($_SESSION['username'] , $old_appointments[$i]['AdvisorUsername']))
    {
      echo "<tr class='userRow'>";
    }
    else
    {
      echo "<tr class='otherUserRow'>";
    }
    echo "<td>" . $old_appointments[$i]['Advisor'] . "</td>";
    echo "<td>" . $old_appointments[$i]['Date'] . "</td>";
    echo "<td>" . date("g:ia", strtotime($old_appointments[$i]['Time'])) . "</td>";
    echo "<td>" . $old_appointments[$i]['Location'] . "</td>";
    //Prints if group appointment
    if($old_appointments[$i]['isGroup'] == 0)
    {
      echo "<td>" . "No" . "</td>";
    }
    else
    {
      echo "<td>" . "Yes" . "</td>";
    }
    echo "<td>" . $old_appointments[$i]['NumStudents'] . "</td>";
    // Print out the check students button if there are students signed up for the appointment
    if ($old_appointments[$i]['NumStudents'] > 0)
    {
      echo "<td>";
      echo "<form method=post action='view_students.php'>";
      echo "<input type=hidden name='ID' value='" . $old_appointments[$i]['id'] . "'>";
      echo "<input type=submit value='View Registered Students'>";
      echo "</form>";
      echo "</td>";
    }
    // If there are not any students signed up then tell the user that
    else
    {
      echo "<td>No Students Registered</td>";
    }
    echo "</tr>";
  }
  echo "</table>";
}

else
{
  echo "<h3>You have not scheduled any appointments<br>";
  echo "<button class='swapView' id='showTable' onclick='showTableButton()'>Table View</button>";
  echo "<button class='swapView' id='showList' onclick='showListButton()'>List View</button></h3>";
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
  //Function at the bottom
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

<!-- PHP FUNCTIONS -->
<?php
function printAppointments($timeEvaluation, $appointmentArray)
{
  for($i = 0 ; $i < count($appointmentArray) ; $i++)
  {
    //If appointments are further than the current date evaluation then haven't gotten
    //appointments yet
    //Ex: Looking at 21st and Appointment on 23rd then need 2 more days till appointments begin
    if(date("Y-m-d", $timeEvaluation) < $appointmentArray[$i]['Date']){
      return;
    }
    elseif(date("Y-m-d", $timeEvaluation) == $appointmentArray[$i]['Date']){
      //echo $appointmentArray[$i]['Date'] . ": " . date("Y-m-d", $timeEvaluation) . "<br>"  . $timeEvaluation . " =?= " . strtotime($appointmentArray[$i]['Date']);
      $appointmentTime = strtotime($appointmentArray[$i]['Time']);
      $EndAppointTime = strtotime("+30 minutes", $appointmentTime);
      $buttonString = date("g:ia", $appointmentTime) . "-" . date("g:ia", $EndAppointTime) . " | " . $appointmentArray[$i]['NumStudents']. "/" . $appointmentArray[$i]['size'];
      echo "<form method='post' action='view_students.php'>";
      //Returns 0 if they are equal (doesn't look at case)
      if(strcasecmp($_SESSION['username'] , $appointmentArray[$i]['AdvisorUsername']) === 0){
        echo("<button type='submit' name='ID' class='userButton' value='" . $appointmentArray[$i]['id'] . "'>" . $buttonString . "</button><br>");
      }
      else {
        echo("<button type='submit' name='ID' class='otherUserButton' value='" . $appointmentArray[$i]['id'] . "'>" . $buttonString . "</button><br>");
      }
      echo "</form>";
    }
  }
}

 ?>

<script>
//Button will swap between advisor view of Calendar to the List View
function showListButton()
{
  elements = document.getElementsByClassName('list_view');
  document.getElementById('calendar_view').style.display = "none";
  for(i = 0 ; i < elements.length ; i++)
  {
    elements[i].style.display = "inline-block";
  }
}
//Button will swap between advisor view of List to the Calendar
function showTableButton()
{
  document.getElementById('calendar_view').style.display = "inline-block";
  elements = document.getElementsByClassName('list_view');
  for(i = 0 ; i < elements.length ; i++)
  {
    elements[i].style.display = "none";
  }
}
//When checkbox is hit
function toggleCheckbox(element)
{
  appointElements = document.getElementsByClassName(element.value + "Row");
  console.log("Row:");
  console.log(appointElements);
  for(i = 0 ; i < appointElements.length ; i++)
  {
    if(element.checked == true)
    {
      appointElements[i].style.display = "table-row";
    }
    else {
      appointElements[i].style.display = "none";
    }
  }
  appointElements2 = document.getElementsByClassName(element.value + "Button");
  console.log("Buttons: ");
  console.log(appointElements2);
  for(i = 0 ; i < appointElements2.length ; i++)
  {
    if(element.checked == true)
    {
      appointElements2[i].style.display = "inline-block";
    }
    else {
      appointElements2[i].style.display = "none";
    }
  }
}
</script>
