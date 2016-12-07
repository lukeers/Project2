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
#displayStudents, #displayStudents th, #displayStudents td {
border: 1px solid black;
}

#displayStudents td, #displayStudents th {
text-align:center;
vertical-align:middle;
padding: 3px 6px;
}

#displayStudents
{
  display: inline-block;
  border-collapse: collapse;
}

</style>
</head>
<body>

<?php
require_once('../mysql_connect.php');
include "../advisor_nav_bar.php";

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
  echo "</table>";
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
