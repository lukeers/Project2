<!-- schedule_student_appointment.php -->
<!-- This code shows a form to look up advisors by the date -->
<!--
File Call/Redirect
  Receive: get_appointments.php, search_advisor.php
  Send: first_page.html

-->

<?php
include ('../html/header.html');
include ('mysql_connect.php');
?>
<a href='view/student_view.php'><button>&#8592;</button></a>
<h1>Schedule an appointment </h1>
<form method=post action="get_appointments.php">
  <p><b>Type of Meeting:<br></b>
    <!-- value is passed to function where it shows and hides respectively -->
    <input type="radio" name="typeMeeting" id="BothMeetings" value="all" onclick="radioToggle(this)" checked>Either
    <input type="radio" name="typeMeeting" id="GroupMeeting" value="group1" onclick="radioToggle(this)">Group
    <input type="radio" name="typeMeeting" id="IndividMeeting" value="group0" onclick="radioToggle(this)">Individual
  </p>
  <p id="IndividOption"><b>
    Advisor:</b><br>
  <?php
    //Add advisors names and username
    $sql = "Select Username, fullName from advisors";
    $rs = mysql_query($sql, $conn);
    while($advisorsInfo = mysql_fetch_array($rs)){
      echo "<input type='checkbox' onchange='toggleCheckbox(this)' value='" . $advisorsInfo['Username'] . "' checked>" . $advisorsInfo['fullName'];
    }
  ?>
   </p>
   <!-- Day Options -->
   <p id="groupOption"><b>Day:</b><br>
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Mon" checked>Mon
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Tue" checked>Tues
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Wed" checked>Wed
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Thurs" checked>Thurs
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Fri" checked>Fri
  </p>

    <table>
      <th class='appointContent'>Advisor</th>
      <th class='appointContent'>Date</th>
      <th class='appointContent'>Time</th>
      <th class='appointContent'>Location</th>
      <th class='appointContent'>Size</th>
    </th>
    <?php
      $todayTimeStamp = strtotime("now");
      $sql = "SELECT * FROM appointments WHERE Date>='" . date("Y-m-d", $todayTimeStamp) . "' ORDER BY Date ASC, Time ASC";
      $rs = mysql_query($sql, $conn);
      while ($appoint = mysql_fetch_array($rs))
      {
        //Add group_YN to the class
        //echo "<button type='submit' class='appointList group" . $appoint['isGroup'] . " " . $appoint['AdvisorUsername'] . " " . date("D",strtotime($appoint['Date'])) . "' >";
        echo "<tr class='appointList group" . $appoint['isGroup'] . " " . $appoint['AdvisorUsername'] . " " . date("D",strtotime($appoint['Date'])) . "' >";
        echo "<td class='appointContent'>" . $appoint['Advisor'] . "</td>";
        echo "<td class='appointContent'>" . date("D, M j", strtotime($appoint['Date'])) . "</td>";
        $appointmentTime = strtotime($appoint['Time']);
        $EndAppointTime = strtotime("+30 minutes", $appointmentTime);
        echo "<td class='appointContent'>" . date("g:ia", $appointmentTime) . " - " . date("g:ia", $EndAppointTime) . "</td>";
        echo "<td class='appointContent'>" . $appoint['Location'] . "</td>";
        echo "<td class='appointContent'>" . $appoint['NumStudents'] . "</td>";
        echo "<td class='appointContent'><form class='appointForm' action='table_handler.php' method='post'>";
        echo "<button type='submit' name='ID' value='" . $appoint['id'] . "'>Register</button>";
        echo "</form></td>";
        echo "</tr>";
        //echo "<br class='appointList group" . $appoint['isGroup'] . " " . $appoint['AdvisorUsername'] . " " . date("D",strtotime($appoint['Date'])) . "'>";
      }

     ?>

<?php include ('../html/footer.html'); ?>



<script>
function toggleCheckbox(element)
{
  appointElements = document.getElementsByClassName(element.value);
  console.log(element.value);
  console.log(appointElements.length);
  for(i = 0 ; i < appointElements.length ; i++)
  {
    if(element.checked == true){
      appointElements[i].style.display = "table-row";
    }
    else {
      appointElements[i].style.display = "none";
    }
  }
}
function radioToggle(element)
{
  console.log(element);
  if(element.value === "all"){
    appointElements = document.getElementsByClassName('appointList');
    for(i = 0 ; i < appointElements.length ; i++)
    {
      appointElements[i].style.display = "table-row";
    }
  }
  else if(element.value === "group1"){
    appointElements = document.getElementsByClassName(element.value);
    for(i = 0 ; i < appointElements.length ; i++)
    {
      appointElements[i].style.display = "table-row";
    }
    appointElements = document.getElementsByClassName('group0');
    for(i = 0 ; i < appointElements.length ; i++)
    {
      appointElements[i].style.display = "none";
    }
  }
  else if(element.value === "group0"){
    appointElements = document.getElementsByClassName(element.value);
    for(i = 0 ; i < appointElements.length ; i++)
    {
      appointElements[i].style.display = "table-row";
    }
    appointElements = document.getElementsByClassName('group1');
    for(i = 0 ; i < appointElements.length ; i++)
    {
      appointElements[i].style.display = "none";
    }
  }
}
</script>

<style>
input[type='checkbox']
{
  margin: 3px 2px 3px 6px;
}
h1
{
  margin-top: 0px;
}
table{
  border-collapse: separate;
  border-spacing: 0px 5px;
}
.appointList
{
  margin: 3px 0px;
  border-radius: 10px;
}
.appointList:hover
{
  background-color: darkgray;
}
.appointList:nth-child(even)
{
  background-color: lightgray;
}
.appointList:nth-child(even):hover
{
  background-color: darkgray;
}
.appointContent
{
  border: 1px solid black;
  text-align: center;
  vertical-align: middle;
  padding: 2px 9px;
}
.appointContent:nth-child(even)
{
  border-left: none;
  border-right: none;
}
.appointContent:last-child
{
  border-top-right-radius: 7px;
  border-bottom-right-radius: 7px;
  border-right: 1px black solid;
}
.appointContent:first-child
{
  border-top-left-radius: 7px;
  border-bottom-left-radius: 7px;
}
.appointForm
{
  margin: 0px;
}
</style>
