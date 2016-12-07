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

<h1>Schedule an appointment </h1>
    <form method=post action="get_appointments.php">
  <p><label>Type of Meeting?<br></label>
    <!-- value is passed to function where it shows and hides respectively -->
    <input type="radio" name="typeMeeting" id="GroupMeeting" value="group1" onclick="radioToggle(this)">Group
    <input type="radio" name="typeMeeting" id="IndividMeeting" value="group0" onclick="radioToggle(this)">Individual
    <input type="radio" name="typeMeeting" id="BothMeetings" value="all" onclick="radioToggle(this)" checked>Either
  </p>
  <p id="IndividOption">
    Advisor<br>
    <?php
    //Add advisors names and username
    //<input type='checkbox' onchange='toggleCheckbox(this)' value=" .  . " checked>Ms. Michelle Bulger
     ?>

    <input type="checkbox" onchange="toggleCheckbox(this)" checked>Mrs. Julie Crosby
    <input type="checkbox" onchange="toggleCheckbox(this)" checked>Ms. Christine Powers
    <input type="checkbox" onchange="toggleCheckbox(this)" checked>CNMS Advisors
  </p>
  <p id="groupOption">Day:<br>
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Mon" checked>Mon
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Tue" checked>Tues
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Wed" checked>Wed
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Thurs" checked>Thurs
    <input type="checkbox" onchange="toggleCheckbox(this)" value="Fri" checked>Fri
  </p>
	<h3>When would you like to schedule the appointment?</h3>
	<p>Choose Week: <select name="week"/>
	<option value = 0 selected>this week</option>
	<option value = 1> next week</option>

	<!-- THIS CODE GETS THE NEXT TWO WEEK OPTIONS -->
	<?php
        // Set time zone to the east coast
	date_default_timezone_set('America/New_York');
	$date = date_create(); // Today
	$daysToSunday = (7 - date_format($date, 'w')) % 7;
	$nextSunday = date_modify($date, "+$daysToSunday day");
	$newSunday = date_modify($nextSunday, '+7 day');
	echo "<option value = 2>week of ";
	$string = date_format($newSunday, 'l, M. j');
        echo $string;
	echo " </option> ";
	$newSunday2 = date_modify($newSunday, '+7 day');
	echo "<option value = 3>week of ";
        $string2 = date_format($newSunday2, 'l, M. j');
        echo $string2;
	echo " </option> ";
	?>
	<!-- END PHP -->
	</select>
	</p>

    <p>Group?
	<select name="group">
	  <option value=1>Yes</option>
	  <option value=0>No</option>
	  <option value=2 selected>Don't care</option>
		</select>
	</p>
    <p><input type=submit value="Submit"/></p>
    </form>
    <!-- HyperLink to search appointments by advisor -->
    <p><a href = "search_advisor.php"> Or Look Up By Advisor </a></p>

    <?php
      $sql = "SELECT * FROM appointments";
      $rs = mysql_query($sql, $conn);
      while ($appoint = mysql_fetch_array($rs))
      {
        //Add group_YN to the class
        echo "<div class='appointList group" . $appoint['isGroup'] . " " . $appoint['AdvisorUsername'] . " " . date("D",strtotime($appoint['Date'])) . "' >";
        echo "<span class='appointContent'>" . $appoint['Advisor'] . "</span>";
        echo "<span class='appointContent'>" . $appoint['Date'] . "</span>";
        $appointmentTime = strtotime($appoint['Time']);
        $EndAppointTime = strtotime("+30 minutes", $appointmentTime);
        echo "<span class='appointContent'>" . date("g:ia", $appointmentTime) . "-" . date("g:ia", $EndAppointTime) . "</span>";
        echo "</div>";
        echo "<br class='appointList group" . $appoint['isGroup'] . " " . $appoint['AdvisorUsername'] . " " . date("D",strtotime($appoint['Date'])) . "'>";
      }
     ?>

<?php include ('../html/footer.html'); ?>



<script>
function toggleCheckbox(element)
{
  appointElements = document.getElementsByClassName(element.value);
  appointElements = document.getElementsByClassName("Wed");
  console.log(element.value);
  console.log(appointElements.length);
  for(i = 0 ; i < appointElements.length ; i++)
  {
    if(element.checked == true)
    {
      appointElements[i].style.display = "inline-block";
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
      appointElements[i].style.display = "inline-block";
    }
  }
  else if(element.value === "group1"){
    appointElements = document.getElementsByClassName(element.value);
    for(i = 0 ; i < appointElements.length ; i++)
    {
      appointElements[i].style.display = "inline-block";
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
      appointElements[i].style.display = "inline-block";
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
.appointList
{
  display: inline-block;
  border: 1px black solid;
  padding: 5px;
  margin: 5px 0px;
}
.appointList:hover
{
  background-color: beige;
}
.appointList:nth-of-type(even)
{
  background-color: lightgray;
}
.appointList:nth-of-type(even):hover
{
  background-color: beige;
}
.appointContent
{
  padding: 5px 6px;
  border-right: 1px solid black;
}
.appointContent:last-child
{
  border-right: 0px;
}
.appointContent:nth-child(1)
{
  max-width: 200px;
}
</style>
