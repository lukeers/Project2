<!-- view_students.php -->
<!-- This file prints out the students that are signed up for a specific appointment -->

<!--
Receives from: advisor_view.php, view_students.php
Sends to:
-->

<html>
<head>
<title>View Students</title>
<link href="../../css/view_students_style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
require_once('../mysql_connect.php');
include "../advisor_nav_bar.php";

//If button was pushed before handle those inputs
//2 options:
// - Adding student
// - Changing meeting info
if(isset($_POST['typeOfSubmit']))
{
  //If added student was clicked
  if($_POST['typeOfSubmit'] == "Add")
  {
    $sql = "INSERT INTO students (major, email, firstName, lastName, studentID, Appt, plans) VALUES ('" . $_POST['major'] . "','" . $_POST['email'] . "','" . $_POST['firstName'] . "','" . $_POST['lastName'] . "','" . $_POST['studentID'] . "','" . $_POST['ID'] . "', '" . $_POST['response1'] . "')";
    //echo "<br>" . $sql . "<br>";
    mysql_query($sql, $conn);
    $sql = "UPDATE appointments SET NumStudents=NumStudents+1 WHERE id='" . $_POST['ID'] . "'";
    //echo "<br>" . $sql . "<br>";
    mysql_query($sql, $conn);
    //Warning does not validate anything for student insert
  }
  //If update meeting was selected
  elseif ($_POST['typeOfSubmit'] == "Update") {
    $sql = "SELECT * FROM appointments WHERE Date='" . $_POST['Date'] . "' AND Time='" . $_POST['Time'] . "' AND AdvisorUsername='" . $_SESSION['username'] . "' AND id!='". $_POST['ID'] ."'";
    //echo $sql;
    $rs = mysql_query($sql, $conn);
    if(mysql_num_rows($rs) == 0)
    {
      $sql = "UPDATE appointments SET Date='" . $_POST['Date'] . "', Time='" . $_POST['Time'] . "', Location='" . $_POST['Location'] . "' WHERE  id='" . $_POST['ID'] . "'";
      //echo $sql;
      mysql_query($sql, $conn);
    }
    else {
      echo "<span class='error'>Error: Appointment date and time already exist</span><br><br>";
    }
    //Warning: Doesn't check if repeat room
  }
}
//Prints out meeting information
$sql = "SELECT * FROM appointments WHERE id=" . $_POST['ID'];
$rs = mysql_query($sql, $conn);
$appoint = mysql_fetch_array($rs);
echo "<table id='meetingInformation'>";
echo "<tr><th colspan='2'>Meeting Information</th></tr>";
echo "<td>Advisor: " . $appoint['Advisor'] . "</td>";
echo "<td>Date: " . date('D, F d, Y',strtotime($appoint['Date'])) . " at " . date('g:ia',strtotime($appoint['Time'])) . " - " . date('g:ia',strtotime('+30 minutes', strtotime($appoint['Time']))) . "</td>";
echo "</tr><tr>";
echo "<td>Location: " . $appoint['Location'] . "</td>";
echo "<td>Enrolled in Group: " . $appoint['NumStudents'] . " out of " . $appoint['size'] . " spaces</td>";
echo "</tr>";
echo "</table>";

//Used to obtain the meeting info for an overlay of screen on buttons: new student, update appointment, and delete
include "../Overlay/view_student_overlay.php";


// Select all the students that have the selected appointment
$sql = "SELECT * FROM students WHERE Appt=" . $_POST['ID'];
$rs = mysql_query($sql, $conn);
$student = mysql_fetch_array($rs);

// Print out the titles of the table and will print all students in appointment
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
    echo "What are your current post-UMBC plans?<br>" . "&nbsp;&nbsp;&nbsp;&nbsp;" . $student['plans'];
    echo "<br>Questions or concerns for advising<br>" . "&nbsp;&nbsp;&nbsp;&nbsp;" . $student['concerns'];
    echo "<br>";
    echo "</div></td>";
    echo "</tr>";
    $student = mysql_fetch_array($rs);
  }
  //Making option buttons
  echo "<tr>";
  //Add student
  echo "<td colspan='2' class='ButtonContainers'><button class='addStudentButton' onclick='showOverlay(this.value)' value='addStudent'>Add Student</button></td>";
  //Edit meeting
  echo "<td colspan='2' class='ButtonContainers'><button class='editMeeting' onclick='showOverlay(this.value)' value='updateMeeting'>Edit Meeting</button></td>";
  //Delete Meeting
  echo "<td colspan='2' class='ButtonContainers'>";
  echo "<button onclick='showOverlay(this.value)' value='deleteMeetingCheck' class='deleteMeetingButton'>Delete Meeting</button>";
  echo "</td>";
  echo "</table>";
}
else {
  //Option buttons when no students are enrolled in the appointment
  //Add student
  echo "<br><br><button class='addStudentButton' onclick='showOverlay(this.value)' value='addStudent'>Add Student</button>";
  //Edit meeting
  echo "<button class='editMeeting' onclick='showOverlay(this.value)' value='updateMeeting'>Edit Meeting</button>";
  //Delete meeting
  echo "<button onclick='showOverlay(this.value)' value='deleteMeetingCheck' class='deleteMeetingButton'>Delete Meeting</button><br>";
}
?>

<p><a href="advisor_view.php"> Go Back to Advisor View </a></p>

</body>
<!-- Java Functions -->
<script>
  //Shows and Hides students details when clicked on row
  function showDetails(element)
  {
    //Gets the id of the student clicked
    showRows = document.getElementsByClassName(element.id);
    //Shows concerns and plans for the student
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
