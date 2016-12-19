<!-- advisor_view.php -->
<!-- This file shows the advisor what appointments they have scheduled -->
<!--
File call/redirect
	Receive: validate_advisor_login.php, advisor_view.php, validate_appointment.php, cancel_advisor_appointment.php, view_students.php
	Send: main_login.html, cancel_advisor_appointment.php, add_appointment.html, view_students.php
-->

<html>
<head>
<title>View Appointments</title>
</head>
<link href='../../css/advisor_view_style.css' rel='stylesheet' type='text/css' />
<body>

<?php
require_once('../mysql_connect.php');

// set the timezone to the east coast
date_default_timezone_set('America/New_York');

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

//Includes the list view code
include("advisor_list_view.php");

//Include the calendar view code
include("advisor_calendar_view.php");
?>
</div>
</body>
</html>


<!-- Java Functions -->
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
