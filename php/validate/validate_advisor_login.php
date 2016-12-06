<!-- validate_advisor_login.php -->
<!-- This file contains validation for the advisor login, it will post the correct error message to the advisor_login_error.html page -->

<?php

require_once('../mysql_connect.php');

// Make the query to get the info out of advisors table
$sql = "SELECT username FROM advisors";
$rs = mysql_query($sql, $conn);
$name_found = False;
$error_message  = "";
$password_found = false;

//Checking if name in db - GOOD if found
while($username = mysql_fetch_array($rs))
{

  if ($_POST['entered_username'] == $username['username'])
  {
    $name_found = True;
  }
}

$sql = "SELECT `password` FROM `advisorpasswords` WHERE `username`='" . $_POST['entered_username']. "'";
$rs = mysql_query($sql, $conn);

if (!$rs) {
  die("Error running $sql: " . mysql_error());
}

$password = mysql_fetch_array($rs);

if (sha1($_POST['entered_password']) == $password['password']) {
    $password_match = True;
}


// This is the pass case
if ($name_found && $password)
{
  session_start();
  $_SESSION['username'] = $_POST['entered_username'];
  header('Location:../../php/view/advisor_view.php');
}

// This is the fail case
else
{
  // Username field left blank
  if ($_POST['entered_username'] == "")
  {
    $error_message .= "Username field can't be blank.<br>";
  }

  // Username does not exists in the table
  else
  {
    $error_message = "Username and/or password not recognized.<br>";
  }

  include('../../html/error_forms/advisor_login_error.html');
}
?>
