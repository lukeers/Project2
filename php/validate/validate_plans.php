<!-- validate_student.php -->
<!-- This file checks if the student registering is entering valid information -->

<?php
require_once('../mysql_connect.php');

  // Go to the student_view.php file
  require('../../php/view/student_view.php');

  // updates the students inputted plans
  $sql = "UPDATE students SET plans='" . $_POST["plansForm"] . "', concerns='" . $_POST["questionsForm"] . "' WHERE studentID ='" . $_SESSION["studentID"] . "'";
  $rs = mysql_query($sql, $conn);
  
?>