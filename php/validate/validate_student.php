<!-- validate_student.php -->
<!-- This file checks if the student registering is entering valid information -->

<?php
require_once('../mysql_connect.php');
// Finds all the student IDs from the database
$sql = "SELECT studentID FROM students";
$rs = mysql_query($sql, $conn);

//By default no errors
$errors = False;
$error_message = "";

//Loop through student IDs, check for match
while($IDs = mysql_fetch_array($rs)) 
{
  if ($_POST['studentID'] == $IDs['studentID']) 
  {
    //Match found - BAD - there is an error
    $errors = True;
    $error_message = "User ID already taken<br>";
    break;
  }
}

if ($errors != True) 
{
  //No errors - GOOD - Insert into database
  $sql = "INSERT INTO students (major, email, firstName, lastName, studentID) VALUES (\"" . $_POST['major'] . "\", \"" . $_POST['email'] . "\", \"" . $_POST['firstName'] . "\", \"" . $_POST['lastName'] . "\", \"" . $_POST['studentID'] . "\")";
  $rs = mysql_query($sql, $conn);
  session_start();
  $_SESSION['studentID'] = $_POST['studentID'];

  // Go to the student_view.php file
  header('Location:../view/student_view.php');
}
else
{
  // Go to the login_student.html file
  echo($error_message);
  require('../../html/forms/login_student.html');
}
?>