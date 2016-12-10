<!-- view_students.php -->
<!-- This file prints out the students that are signed up for a specific appointment -->

<html>
<head>
<title>View Students</title>
<style>
.extraInfo
{
  display: none;
}
.studentExtraInfo
{
  text-align: left;
}
.expandInfo:hover
{
  background-color: black;
  color: white;
  font-weight: bolder;
}
#displayStudents th, #displayStudents td:not(.ButtonContainers) {
border: 1px solid black;
}

#displayStudents td, #displayStudents th {
text-align:center;
vertical-align:middle;
padding: 3px 6px;
}

#displayStudents, #meetingInformation
{
  display: inline-block;
  border-collapse: collapse;
}

#meetingInformation
{
  margin-top: 10px;
}

#meetingInformation td
{
  border: 1px black solid;
  padding: 3px 5px;
}
.addStudentButton
{
  float: left;
  margin-left: 10px;
}
.deleteMeetingButton
{
  float: right;
  background-color: darkred;
  color: white;
  border-radius: 7px;
}

</style>
</head>
<body>

<?php
require_once('../mysql_connect.php');
include "../advisor_nav_bar.php";

//Prints out meeting information
$sql = "SELECT * FROM appointments WHERE id=" . $_POST['ID'];
$rs = mysql_query($sql, $conn);
$appoint = mysql_fetch_array($rs);
echo "<table id='meetingInformation'>";
echo "<tr><th colspan='2'>Meeting Information</th></tr>";
echo "<td>Advisor: " . $appoint['Advisor'] . "</td>";
echo "<td>Date: " . date('D, F d, Y',strtotime($appoint['Date'])) . " at " . date('g:ia',strtotime($appoint['Date'])) . " - " . date('g:ia',strtotime('+30 minutes', strtotime($appoint['Date']))) . "</td>";
echo "</tr><tr>";
echo "<td>Location: " . $appoint['Location'] . "</td>";
echo "<td>Enrolled in Group: " . $appoint['NumStudents'] . " out of " . " spaces</td>";
echo "</tr>";
echo "</table>";


// Select all the students that have the selected appointment
$sql = "SELECT * FROM students WHERE Appt=" . $_POST['ID'];
$rs = mysql_query($sql, $conn);
$student = mysql_fetch_array($rs);

// Print out the titles of the table
if ($student)
{
  echo "<h3>Students Registered</h3>";
  echo "<table id='displayStudents'>";
  echo "<tr>";
  echo "<th>First Name</th>";
  echo "<th>Last Name</th>";
  echo "<th>Major</th>";
  echo "<th>Student ID</th>";
  echo "<th>Email</th>";
  echo "<th></th>";
  echo "</tr>";

  // Print out the information about each student signed up
  while ($student)
  {
    echo "<tr>";
    echo "<td>" . $student['firstName'] . "</td>";
    echo "<td>" . $student['lastName'] . "</td>";
    echo "<td>" . $student['Major'] . "</td>";
    echo "<td>" . $student['studentID'] . "</td>";
    echo "<td>" . $student['email'] . "</td>";
    echo "<td onclick='showDetails(this)' class='expandInfo' id='" . strtolower($student['studentID']) . "'>+</td>";
    echo "</tr>";
    echo "<tr class='extraInfo " . strtolower($student['studentID']) . "'>";
    echo "<td colspan='6'>";
    echo "<div class='studentExtraInfo'>";
    echo "What are your current post-UMBC plans?<br>" . "";
    echo "<br>Questions or concerns for advising<br>" . "";
    echo "<br>";
    echo "</div></td>";
    echo "</tr>";
    $student = mysql_fetch_array($rs);
  }
  //Making option buttons
  echo "<tr>";
  echo "<td colspan='3' class='ButtonContainers'><button class='addStudentButton'>Add Student</button></td>";
  echo "<td colspan='3' class='ButtonContainers'><form action='../cancel_advisor_appointment.php' method='post'>";
  echo "<button type='submit' name='ID' value='" . $_POST['ID'] . "' class='deleteMeetingButton'>Delete Meeting</button>";
  echo "</form></td>";
  echo "</table>";
}
else {
  echo "<br><br><button class='addStudentButton'>Add Student</button>";
  echo "<form action='../cancel_advisor_appointment.php' method='post'>";
  echo "<button type='submit' name='ID' value='" . $_POST['ID'] . "' class='deleteMeetingButton'>Delete Meeting</button>";
  echo "</form><br>";
}
?>

<p><a href = "advisor_view.php"> Go Back to Advisor View </a></p>

</body>
<script>
  //Shows and Hides students details when clicked on row
  function showDetails(element)
  {
    showRows = document.getElementsByClassName(element.id);
    for(i = 0 ; i < showRows.length ; i++)
    {
      if(showRows[i].style.display === "table-row"){
        showRows[i].style.display = "none";
      }
      else {
        showRows[i].style.display = "table-row";
      }
    }
  }
</script>
