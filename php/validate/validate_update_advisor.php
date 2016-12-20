<?php

require_once("../mysql_connect.php");
session_start();

echo $_SESSION['username'];
echo "username" . empty($_POST['username']) . $_POST['username'] . "<br>";
echo "password" . empty($_POST['password']) . $_POST['password'] ."<br>";
echo "fullname" . empty($_POST['fullName']) . $_POST['fullName'] ."<br>";

//If username is to be updated
if(!empty($_POST['username']))
{
  //Update advisor database to show username change
  $sql = "UPDATE advisors SET Username='". $_POST['username'] ."' WHERE Username='". $_SESSION['username'] ."'";
	mysql_query($sql, $conn);
  echo "<br>" . $sql . "<br>";

  //Update Appointments to show username change
  $sql = "UPDATE appointments SET AdvisorUsername='". $_POST['username'] ."' WHERE AdvisorUsername='". $_SESSION['username'] ."'";
	mysql_query($sql, $conn);
  echo "<br>" . $sql . "<br>";

  //Update session username to show change
  $_SESSION['username'] = $_POST['username'];
}

//If password field is to be updated
if(!empty($_POST['password']))
{
  if($_POST['password'] == $_POST['confirm'])
  {
    $sql = "UPDATE advisorpasswords SET password='". sha1($_POST['password']). "' WHERE username='". $_SESSION['username'] ."'";
    mysql_query($sql, $conn);
    echo "<br>" . $sql . "<br>";
  }
}

//If Advisor name is to be update
if(!empty($_POST['fullName']))
{
  //Update advisor database to show username change
  $sql = "UPDATE advisors SET fullName='". $_POST['fullName'] ."' WHERE Username='". $_SESSION['username'] ."'";
  mysql_query($sql, $conn);
  echo ("<br>" . $sql . "<br>");

  //Update Appointments to show username change
  $sql = "UPDATE appointments SET Advisor='". $_POST['fullName'] ."' WHERE AdvisorUsername='". $_SESSION['username'] ."'";
  mysql_query($sql, $conn);
  echo "<br>" . $sql . "<br>";
}

header("../view/advisor_view.php");

 ?>
<a href="../view/advisor_view.php">Back</a>
