<link href="../../css/mass_scheduler_style.css" rel="stylesheet" type="text/css">
<html>
<?php
include("../../php/advisor_nav_bar.php");
?>
<title>Mass Scheduler</title>

<h3>Appointment details</h3>

<form method=post action="../../php/mass_scheduling.php">

  <p>Location: <input type=text name="location"/></p>
  <p>Group Size:
    <input type="radio" class="appointSize" name="group_size" value="1">1
    <input type="radio" class="appointSize" name="group_size" value="5">5
    <input type="radio" class="appointSize" name="group_size" value="10">10
    <input type="radio" class="appointSize" name="group_size" value="15">15
    <input type="radio" class="appointSize" name="group_size" value="20">20
    <input type="radio" class="appointSize" name="group_size" value="" id="other">
    <input class="appointSize_other" type="number" min="0" placeholder="Other" onkeyup="document.getElementById('other').value = this.value">
  </p>


  <?php

  // get the start and end of the week
  $currentDate = date('Y-m-d');
  $startOfWeek = date('Y-m-d', strtotime("next monday"));

  $date = date('Y-m-d',strtotime($startOfWeek . ' +1 day'));
  $endOfWeek = date('Y-m-d', strtotime("next friday next week"));

  //
  echo("<h1>Start Week: ". $startOfWeek . "</h1>");
  echo("<h2>End Week: ". $endOfWeek . "</h2>");
  echo("<h3>Date: " . $date . "</h3>");

  echo("Week Start Date: ");
  echo("<input type=\"date\"name=\"startdate\" value=\"". $startOfWeek ."\">");
  ?>


  <script>
  // allow only Mondays to be selected  TODO
  $(document).ready(function(){
      $('input').datepicker({beforeShowDay: function(date){ return [date.getDay() == 1, '']; }});
  });
  </script>




  <h3>Repeat:</h3>
  <table class="massScheduleTable">
  <tr>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
  </tr>
    <?php
    $times = array(
      "8:00 - 8:30 AM", "8:30 - 9:00 AM", "9:00 - 9:30 AM", "9:30 - 10:00 AM",
      "10:00 - 10:30 AM", "10:30 - 11:00 AM", "11:00 - 11:30 AM", "11:30 - 12:00 PM",
      "12:00 - 1:00 PM", "1:00 - 1:30 PM", "1:30 - 2:00 PM", "2:00 - 2:30 PM",
      "2:30 - 3:00 PM", "3:00 - 3:30 PM", "3:30 - 4:00 PM", "4:00 - 4:30 PM",
      "4:30 - 5:00 PM"
    );
    $values = array(
      "'8'", "'830'", "'9'", "'9:30'", "'10'", "'1030'", "'11'", "'1130'",
      "'12'", "'1230'", "'1'", "'130'", "'2'", "'230'", "'3'", "'330'",
      "'4'", "'430'"
    );
    $day = array(
      "'mon[]'", "'tues[]'", "'wed[]'", "'thurs[]'", "'fri[]'"
    );
    for($i = 0 ; $i < count($times) ; $i++)
    {
      echo "<tr>";
      for($j = 0 ; $j < count($day) ; $j++)
      {
        echo "<td><input type='checkbox' name=" . $day[$j] . " value=". $values[$i] .">". $times[$i] ."</td>";
      }
      echo "</tr>";
    }
   ?>
  </table>
  <p><input type=submit value="Submit"/></p>
</form>
</html>
