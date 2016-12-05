<!-- validate_student_login.php -->
<!-- This file will check if the student logging in is entering a valid value --> 

<?php

require_once('../mysql_connect.php');

// Make a query to get the usernames from the students database
$sql = "SELECT studentID FROM students";
$rs = mysql_query($sql, $conn);
$name_found = False;
$error_message = "";

//Checking if name in db - GOOD if found
while($IDs = mysql_fetch_array($rs)) 
{
  if ($_POST['studentID'] == $IDs['studentID']) 
  {
    $name_found = True;
  }
}

// This is the pass case
if ($name_found) 
{
  session_start();
  $_SESSION['studentID'] = $_POST['studentID'];

  // go to the student_view.php page
  header('Location:../../php/view/student_view.php');
} 

// This is the fail case
else
{
  // Check if the username was left blank
  if ($_POST['studentID'] == "") 
  {
    $error_message .= "Student ID can't be blank.<br>";
  }
  
  // Check if the username was not found in the data base
  else 
  {
    $error_message = "Student ID not recognized.<br>";
  } 
  
  // go to the student_login_error.html file 
  echo($error_message);
  include('../../html/forms/login_student.html');
}
?>
