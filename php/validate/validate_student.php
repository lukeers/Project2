<!-- validate_student.php -->
<!-- This file checks if the student registering is entering valid information -->

<?php
require_once('../mysql_connect.php');
// Finds all the student IDs from the database
$sql = "SELECT * FROM students WHERE studentID='" . $_POST['studentID'] . "'";
$rs = mysql_query($sql, $conn);


//By default no errors
$errors = False;
$error_message = "";

session_start();

//Loop through student IDs, check for match
$IDs = mysql_fetch_array($rs);

if(mysql_num_rows($rs) == 0){
  $sql = "INSERT INTO students (major, email, firstName, lastName, studentID) VALUES (\"" . $_POST['major'] . "\", \"" . $_POST['email'] . "\", \"" . $_POST['firstName'] . "\", \"" . $_POST['lastName'] . "\", \"" . $_POST['studentID'] . "\")";
  $rs = mysql_query($sql, $conn);

}
else if (strcasecmp($_POST['firstName'], $IDs['firstName']) != 0 
    || strcasecmp($_POST['lastName'], $IDs['lastName']) != 0
    || strcasecmp($_POST['email'], $IDs['email']) != 0){
    //Match found - BAD - there is an error
    $errors = True;
    $error_message = "User ID already taken<br>";
}

if ($errors != True) 
{
  //No errors - GOOD - Insert into database
  $_SESSION['studentID'] = $_POST['studentID'];

  // Go to the student_major_plans.html file
  require('../../html/forms/student_major_plans.html');
}
else
{
  // Go to the main_login.html file
  $_SESSION['error_message'] = $error_message;
  $_SESSION['user'] = "student";
  require('../../html/forms/main_login.php');
}
?>