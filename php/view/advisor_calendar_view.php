<link href='../../css/advisor_calendar_style.css' rel='stylesheet' type='text/css' />
<?php
// preparation for calendar creation
if(isset($_POST['monthEval']))
{
  $_SESSION['monthEval'] = $_POST['monthEval'];
  $countTime = $_POST['monthEval'];
}
else {
  $_SESSION['monthEval'] = "0";
  $countTime = 0;
}
//Creating Days of the week
$days = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
//Setting up the month to look at
$recordTime = strtotime('first day of +' . $countTime . ' month');
//If firstday of month not weekday get next monday
if(date("D",$recordTime) == "Sat" || date("D",$recordTime) == "Sun")
{
  $recordTime = strtotime('monday', $recordTime);
}
// end calendar preparation

// CALENDAR VIEW
echo("<table id='calendar_view'><tr>");
echo("<td colspan='5' id='Month'>");
//Back button for month
echo("<form action='advisor_view.php' method='post'>");
echo("<button type='submit' name='monthEval' value=" . ($countTime - 1) . ">&#60</button>");
//Month print
echo(date("F",$recordTime));
//Forward button for month
echo("<button type='submit' name='monthEval' value=" . ($countTime + 1) . ">&#62</button>");
echo("</form>");
echo("</td></tr><tr>");
//Text day of week printing
for($i = 0 ; $i < (count($days) - 2) ; $i++)
{
  echo("<td id='td_dayOfWeek'>" . $days[$i] . "</td>");
}
echo("</tr><tr>");
//Setup so i=0 once in loop
$i = -1;

//Printing day till last day of month
while($recordTime != strtotime('last day of +0 months',$recordTime))
{
  //Increment the day being looked at
  $i += 1;
  //Printing the day only if weekday
  if((date('D',$recordTime) == $days[$i]) && ($days[$i] != "Sat") && ($days[$i] != "Sun"))
  {
    echo("<th>" . date('j',$recordTime));
    echo("<div class='appointmentButton'>");
    //Passes the day to find what appointments fit there
    printAppointments($recordTime, $storage_array);
    echo("</div>");
    echo("</th>");
    $recordTime = strtotime('+1 days',$recordTime);

  }
  //Skip any printing on Saturday
  elseif($days[$i] == "Sat"){
    echo("");
  }
  //Prepare next week
  elseif($days[$i] == "Sun")
  {
    echo("</tr><tr>");
    $recordTime = strtotime('next week',$recordTime);
    $i = -1;
  }
  //The first day of the month isn't monday
  else
  {
    echo("<td></td>");
  }
  //echo(date("m/d/y",$recordTime) . "<br>");
}
//Printing to complete the month boxes
$i += 2;
//If end of printing is not Saturday or Sunday, then print the final day
if((date('D',$recordTime) != "Sat") && (date('D',$recordTime) != "Sun"))
{
  echo("<th>" . date('j',$recordTime));
  echo("<div class='appointmentButton'>");
  //Function at the bottom
  printAppointments($recordTime, $storage_array);
  echo("</div>");
  //echo("<div class='appointmentButton'><button>11am-12pm | 3/6</button></div>");
  echo("</th>");
}
//Print to complete the calendar boxes
for(; $i < (count($days) - 2) ; $i++)
{
  echo("<td></td>");
}
//Fill in for appointments
echo("</tr>");
echo("</table>");
?>

<!-- PHP FUNCTIONS -->
<?php
function printAppointments($timeEvaluation, $appointmentArray)
{
  for($i = 0 ; $i < count($appointmentArray) ; $i++)
  {
    //If appointments are further than the current date evaluation then haven't gotten
    //appointments yet
    //Ex: Looking at 21st and Appointment on 23rd then need 2 more days till appointments begin
    if(date("Y-m-d", $timeEvaluation) < $appointmentArray[$i]['Date']){
      return;
    }
    elseif(date("Y-m-d", $timeEvaluation) == $appointmentArray[$i]['Date']){
      //echo $appointmentArray[$i]['Date'] . ": " . date("Y-m-d", $timeEvaluation) . "<br>"  . $timeEvaluation . " =?= " . strtotime($appointmentArray[$i]['Date']);
      $appointmentTime = strtotime($appointmentArray[$i]['Time']);
      $EndAppointTime = strtotime("+30 minutes", $appointmentTime);
      $buttonString = date("g:ia", $appointmentTime) . "-" . date("g:ia", $EndAppointTime) . " | " . $appointmentArray[$i]['NumStudents']. "/" . $appointmentArray[$i]['size'];
      echo "<form method='post' action='view_students.php'>";
      //Returns 0 if they are equal (doesn't look at case)
      if(strcasecmp($_SESSION['username'] , $appointmentArray[$i]['AdvisorUsername']) === 0){
        echo("<button type='submit' name='ID' class='userButton' value='" . $appointmentArray[$i]['id'] . "'>" . $buttonString . "</button><br>");
      }
      else {
        echo("<button type='submit' name='ID' class='otherUserButton' value='" . $appointmentArray[$i]['id'] . "'>" . $buttonString . "</button><br>");
      }
      echo "</form>";
    }
  }
}
?>
