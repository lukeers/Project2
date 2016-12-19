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
    <th onclick="onSwapClick(this)" name="mon[]">Monday</th>
    <th onclick="onSwapClick(this)" name="tues[]">Tuesday</th>
    <th onclick="onSwapClick(this)" name="wed[]">Wednesday</th>
    <th onclick="onSwapClick(this)" name="thurs[]">Thursday</th>
    <th onclick="onSwapClick(this)" name="fri[]">Friday</th>
  </tr><tr>
    <td><input type="checkbox" name="mon[]" value="8">8:00 - 8:30 AM</td>
    <td><input type="checkbox" name="tues[]" value="8">8:00 - 8:30 AM</td>
    <td><input type="checkbox" name="wed[]" value="8">8:00 - 8:30 AM</td>
    <td><input type="checkbox" name="thurs[]" value="8">8:00 - 8:30 AM</td>
    <td><input type="checkbox" name="fri[]" value="8">8:00 - 8:30 AM</td>
  </tr><tr>
    <td><input type="checkbox" name="mon[]" value="830">8:30 - 9:00 AM</td>
    <td><input type="checkbox" name="tues[]" value="830">8:30 - 9:00 AM</td>
    <td><input type="checkbox" name="wed[]" value="830">8:30 - 9:00 AM</td>
    <td><input type="checkbox" name="thurs[]" value="830">8:30 - 9:00 AM</td>
    <td><input type="checkbox" name="fri[]" value="830">8:30 - 9:00 AM</td>
  </tr><tr>
    <td><input type="checkbox" name="mon[]" value="9">9:00 - 9:30 AM</td>
    <td><input type="checkbox" name="tues[]" value="9">9:00 - 9:30 AM</td>
    <td><input type="checkbox" name="wed[]" value="9">9:00 - 9:30 AM</td>
    <td><input type="checkbox" name="thurs[]" value="9">9:00 - 9:30 AM</td>
    <td><input type="checkbox" name="fri[]" value="9">9:00 - 9:30 AM</td>
  </tr><tr>
    <td><input type="checkbox" name="mon[]" value="930">9:30 - 10:00 AM</td>
    <td><input type="checkbox" name="tues[]" value="930">9:30 - 10:00 AM</td>
    <td><input type="checkbox" name="wed[]" value="930">9:30 - 10:00 AM</td>
    <td><input type="checkbox" name="thurs[]" value="930">9:30 - 10:00 AM</td>
    <td><input type="checkbox" name="fri[]" value="930">9:30 - 10:00 AM</td>
  </tr><tr>
    <td><input type="checkbox" name="mon[]" value="10">10:00 - 10:30 AM</td>
    <td><input type="checkbox" name="tues[]" value="10">10:00 - 10:30 AM</td>
    <td><input type="checkbox" name="wed[]" value="10">10:00 - 10:30 AM</td>
    <td><input type="checkbox" name="thurs[]" value="10">10:00 - 10:30 AM</td>
    <td><input type="checkbox" name="fri[]" value="10">10:00 - 10:30 AM</td>
  </tr><tr>
    <td><input type="checkbox" name="mon[]" value="1030">10:30 - 11:00 AM</td>
    <td><input type="checkbox" name="tues[]" value="1030">10:30 - 11:00 AM</td>
    <td><input type="checkbox" name="wed[]" value="1030">10:30 - 11:00 AM</td>
    <td><input type="checkbox" name="thurs[]" value="1030">10:30 - 11:00 AM</td>
    <td><input type="checkbox" name="fri[]" value="1030">10:30 - 11:00 AM</td>
  </tr><tr>
    <td><input type="checkbox" name="mon[]" value="11">11:00 - 11:30 AM</td>
    <td><input type="checkbox" name="tues[]" value="11">11:00 - 11:30 AM</td>
    <td><input type="checkbox" name="wed[]" value="11">11:00 - 11:30 AM</td>
    <td><input type="checkbox" name="thurs[]" value="11">11:00 - 11:30 AM</td>
    <td><input type="checkbox" name="fri[]" value="11">11:00 - 11:30 AM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="1130">11:30 - 12:00 PM</td>
    <td><input type="checkbox" name="tues[]" value="1130">11:30 - 12:00 PM</td>
    <td><input type="checkbox" name="wed[]" value="1130">11:30 - 12:00 PM</td>
    <td><input type="checkbox" name="thurs[]" value="1130">11:30 - 12:00 PM</td>
    <td><input type="checkbox" name="fri[]" value="1130">11:30 - 12:00 PM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="12">12:00 - 1:00 PM</td>
    <td><input type="checkbox" name="tues[]" value="12">12:00 - 1:00 PM</td>
    <td><input type="checkbox" name="wed[]" value="12">12:00 - 1:00 PM</td>
    <td><input type="checkbox" name="thurs[]" value="12">12:00 - 1:00 PM</td>
    <td><input type="checkbox" name="fri[]" value="12">12:00 - 1:00 PM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="1">1:00 - 1:30 PM</td>
    <td><input type="checkbox" name="tues[]" value="1">1:00 - 1:30 PM</td>
    <td><input type="checkbox" name="wed[]" value="1">1:00 - 1:30 PM</td>
    <td><input type="checkbox" name="thurs[]" value="1">1:00 - 1:30 PM</td>
    <td><input type="checkbox" name="fri[]" value="1">1:00 - 1:30 PM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="130">1:30 - 2:00 PM</td>
    <td><input type="checkbox" name="tues[]" value="130">1:30 - 2:00 PM</td>
    <td><input type="checkbox" name="wed[]" value="130">1:30 - 2:00 PM</td>
    <td><input type="checkbox" name="thurs[]" value="130">1:30 - 2:00 PM</td>
    <td><input type="checkbox" name="fri[]" value="130">1:30 - 2:00 PM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="2">2:00 - 2:30 PM</td>
    <td><input type="checkbox" name="tues[]" value="2">2:00 - 2:30 PM</td>
    <td><input type="checkbox" name="wed[]" value="2">2:00 - 2:30 PM</td>
    <td><input type="checkbox" name="thurs[]" value="2">2:00 - 2:30 PM</td>
    <td><input type="checkbox" name="fri[]" value="2">2:00 - 2:30 PM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="230">2:30 - 3:00 PM</td>
    <td><input type="checkbox" name="tues[]" value="230">2:30 - 3:00 PM</td>
    <td><input type="checkbox" name="wed[]" value="230">2:30 - 3:00 PM</td>
    <td><input type="checkbox" name="thurs[]" value="230">2:30 - 3:00 PM</td>
    <td><input type="checkbox" name="fri[]" value="230">2:30 - 3:00 PM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="3">3:00 - 3:30 PM</td>
    <td><input type="checkbox" name="tues[]" value="3">3:00 - 3:30 PM</td>
    <td><input type="checkbox" name="wed[]" value="3">3:00 - 3:30 PM</td>
    <td><input type="checkbox" name="thurs[]" value="3">3:00 - 3:30 PM</td>
    <td><input type="checkbox" name="fri[]" value="3">3:00 - 3:30 PM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="330">3:30 - 4:00 PM</td>
    <td><input type="checkbox" name="tues[]" value="330">3:30 - 4:00 PM</td>
    <td><input type="checkbox" name="wed[]" value="330">3:30 - 4:00 PM</td>
    <td><input type="checkbox" name="thurs[]" value="330">3:30 - 4:00 PM</td>
    <td><input type="checkbox" name="fri[]" value="330">3:30 - 4:00 PM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="4">4:00 - 4:30 PM</td>
    <td><input type="checkbox" name="tues[]" value="4">4:00 - 4:30 PM</td>
    <td><input type="checkbox" name="wed[]" value="4">4:00 - 4:30 PM</td>
    <td><input type="checkbox" name="thurs[]" value="4">4:00 - 4:30 PM</td>
    <td><input type="checkbox" name="fri[]" value="4">4:00 - 4:30 PM</td>
  </tr><tr>

    <td><input type="checkbox" name="mon[]" value="430">4:30 - 5:00 PM</td>
    <td><input type="checkbox" name="tues[]" value="430">4:30 - 5:00 PM</td>
    <td><input type="checkbox" name="wed[]" value="430">4:30 - 5:00 PM</td>
    <td><input type="checkbox" name="thurs[]" value="430">4:30 - 5:00 PM</td>
    <td><input type="checkbox" name="fri[]" value="430">4:30 - 5:00 PM</td>
  </tr></table>

  <p><input type=submit value="Submit"/></p>
</form>
</html>

<script>
function onSwapClick(element)
{
  elements = document.getElementsByName(element.getAttribute("name"));
  console.log(element.getAttribute("name"));
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
