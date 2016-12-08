<!-- validate_advisor.php -->
<!-- This file will validate the registration of the advisor -->

<?php
require_once('../mysql_connect.php');

$sql = "SELECT username FROM advisors";
$rs = mysql_query($sql, $conn);

//By default no errors
$errors = False;
$error_message = "";

//Loop through usernames, check for match
while($username = mysql_fetch_array($rs))
{
  if ($_POST['username'] == $username['username'])
  {
    //Match found - BAD - there is an error
    $errors = True;
    $error_message = "Username already taken<br>";
  }
}

if ($errors != True)
{
  //No errors - GOOD - Insert into database
  $fullName = $_POST['fName'] . " " . $_POST['lName'];
  $sql = "INSERT INTO advisors (username, fullName, Office) VALUES (\"" . $_POST['username'] . "\" , \"" . $fullName . "\", \"" . $_POST['office'] . "\")";
  $rs = mysql_query($sql, $conn);

  $hashedPassword = sha1($_POST['password']);



  $sql = "INSERT INTO advisorpasswords (username, password) VALUES ('" . $_POST['username']. "' , '" . $hashedPassword . "')";
  $rs = mysql_query($sql, $conn);


  header('Location:../../php/view/advisor_view.php');
}


else
{
  $_session['error_message'] = $error_message;
  require('../../html/forms/register_advisor.php');
}
?>
