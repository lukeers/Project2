<?php

require_once("../mysql_connect.php");
session_start();

//If username is to be updated
if(isset($_POST['username']))
{
  //Update advisor database to show username change
  $sql = "UPDATE advisors SET Username='". $_POST['username'] ."' WHERE Username='". $_SESSION['username'] ."'";
	$rs = mysql_query($sql, $conn);
  echo "<br>" . $sql . "<br>";

  //Update Appointments to show username change
  $sql = "UPDATE appointments SET AdvisorUsername='". $_POST['username'] ."' WHERE AdvisorUsername='". $_SESSION['username'] ."'";
	$rs = mysql_query($sql, $conn);
  echo "<br>" . $sql . "<br>";

  //Update session username to show change
  $_SESSION['username'] = $_POST['username'];
}

//If password field is to be updated
if(isset($_POST['password']))
{
  if($_POST['password'] == $_POST['passwordCheck'])
  {
    $sql = "UPDATE advisorpasswords SET password='". sha1($_POST['password']). "' WHERE username='". $_SESSION['username'] ."'";
    $rs = mysql_query($sql, $conn);
    echo "<br>" . $sql . "<br>";
  }
}

//If Advisor name is to be update
if(isset($_POST['fullname']))
{
  //Update advisor database to show username change
  $sql = "UPDATE advisors SET fullName='". $_POST['fullname'] ."' WHERE Username='". $_SESSION['username'] ."'"
  $rs = mysql_query($sql, $conn);
  echo "<br>" . $sql . "<br>";

  //Update Appointments to show username change
  $sql = "UPDATE appointments SET Advisor='". $_POST['fullname'] ."' WHERE AdvisorUsername='". $_SESSION['username'] ."'"
  $rs = mysql_query($sql, $conn);
  echo "<br>" . $sql . "<br>";
}

//header("../view/advisor_view.php");

 ?>
