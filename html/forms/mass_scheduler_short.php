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

  // get the start of the week
  $startOfWeek = date('Y-m-d', strtotime("next monday"));

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
    <th></th>
    <th onclick="onSwapClick(this)" name='mon[]'>Monday</th>
    <th onclick="onSwapClick(this)" name='tues[]'>Tuesday</th>
    <th onclick="onSwapClick(this)" name='wed[]'>Wednesday</th>
    <th onclick="onSwapClick(this)" name='thurs[]'>Thursday</th>
    <th onclick="onSwapClick(this)" name='fri[]'>Friday</th>
  </tr>
    <?php
    //The possible times for each appointment
    $times = array(
      "8:00 - 8:30 AM", "8:30 - 9:00 AM", "9:00 - 9:30 AM", "9:30 - 10:00 AM",
      "10:00 - 10:30 AM", "10:30 - 11:00 AM", "11:00 - 11:30 AM", "11:30 - 12:00 PM",
      "12:00 - 1:00 PM", "1:00 - 1:30 PM", "1:30 - 2:00 PM", "2:00 - 2:30 PM",
      "2:30 - 3:00 PM", "3:00 - 3:30 PM", "3:30 - 4:00 PM", "4:00 - 4:30 PM",
      "4:30 - 5:00 PM"
    );
    //Values for each appointment
    $values = array(
      "'8'", "'830'", "'9'", "'9:30'", "'10'", "'1030'", "'11'", "'1130'",
      "'12'", "'1230'", "'1'", "'130'", "'2'", "'230'", "'3'", "'330'",
      "'4'", "'430'"
    );
    //the day for each appointment
    $day = array(
      "'mon[]'", "'tues[]'", "'wed[]'", "'thurs[]'", "'fri[]'"
    );
    //Going through each appointment time
    for($i = 0 ; $i < count($times) ; $i++)
    {
      echo "<tr>";
      //Click for filling in a time across
      echo "<th onclick='onSwapClick(this)' name=". $values[$i] .">&rarr;</th>";
      //Going through each day
      for($j = 0 ; $j < count($day) ; $j++)
      {
        //Printing the checkbox for each time
        echo "<td><input type='checkbox' class='". substr($day[$j],1,-1) ." ". substr($values[$i],1,-1) ."' name=" . $day[$j] . " value=". $values[$i] .">". $times[$i] ."</td>";
      }
      echo "</tr>";
    }
   ?>
  </table>
  <p><input type=submit value="Submit"/></p>
</form>
</html>

<script>
function onSwapClick(element)
{
  elements = document.getElementsByClassName(element.getAttribute("name"));
  console.log(elements);
  counter = 0;
  for(i = 1 ; i < elements.length ; i++)
  {
    if(elements[i].checked == true)
    {
      counter++;
    }
    else {
        counter--;
    }
  }
  console.log(counter);
  for(i = 0 ; i < elements.length ; i++)
  {
    if(counter >= 0)
    {
      elements[i].checked = false;
    }
    else {
        elements[i].checked = true;
    }
  }
}
</script>
