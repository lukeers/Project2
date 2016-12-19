<link href='../../css/advisor_list_style.css' rel='stylesheet' type='text/css' />
<?php
// Prints out the titles of the table
//Prints out inorder
//Group, individual, Old
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
    PrintListRow($appt);
    $appt = mysql_fetch_array($rs);
}

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
    PrintListRow($catch_case_appointments[$i]);
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
    //Print row with no cancel button
    PrintListRow($old_appointments[$i], 0);
  }
  echo "</table>";
}

else
{
  echo "<h3>You have not scheduled any appointments<br>";
  echo "<button class='swapView' id='showTable' onclick='showTableButton()'>Table View</button>";
  echo "<button class='swapView' id='showList' onclick='showListButton()'>List View</button></h3>";
}
?>

<!-- PHP FUNCTIONS -->
<?php
//Prints the row for the appointment
function PrintListRow($appt, $prtCancel = 1)
{
  if(strcasecmp($_SESSION['username'] , $appt['AdvisorUsername']) == 0)
  {
    echo "<tr class='userRow'>";
  }
  else
  {
    echo "<tr class='otherUserRow'>";
  }
  //Canceling Appoitnment Button
  if($prtCancel == 1)
  {
    //Printing appointment
    PrintListAppointment($appt);

    echo "<td>";
    echo "<form method=post action='../cancel_advisor_appointment.php'>";
    echo "<button type='submit' name='ID' value='" . $appt['id'] . "'>Cancel</button>";
    echo "</form>";
    echo "</td>";
  }
  else {
    //Printing appointment with no cancel button
    PrintListAppointment($appt, 0);
  }
  echo "</tr>";
}

//Prints the info for each appointment
function PrintListAppointment($appt, $isCurrent = 1)
{
  //Prints who is the advisor
  echo "<td>" . $appt['Advisor'] . "</td>";
  //Prints date of appointment
  echo "<td>" . date("D, M j, Y", strtotime($appt['Date'])) . "</td>";
  //Prints time of appointment
  echo "<td>" . date("g:ia", strtotime($appt['Time'])) . "</td>";
  //Prints location
  echo "<td>" . $appt['Location'] . "</td>";
  //If old appointment prints if was group
  if($isCurrent == 0)
  {
    $tmp = ($appt['isGroup'] == 0 ? "No" : "Yes");
    echo "<td>" . $tmp . "</td>";
  }
  //Prints number of students
  echo "<td>" . $appt['NumStudents'] . " of " . $appt['size'] . "</td>";
  //Print out the check students button if there are students signed up for the appointment
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
}
 ?>
