<!-- table_handler.php -->
<!-- This file contains the information the will update the tables after a students signs up for an appointment -->

<?php
  include('mysql_connect.php');
  $apptID = $_POST['ID'];
  echo $apptID;
  session_start();

  //query for appointment info
  $sql = "SELECT * FROM appointments WHERE id=$apptID";
  echo $sql;
  $rs = mysql_query($sql, $conn);
  $appt = mysql_fetch_array($rs);

  // This checks if the appointment is about to be full
  if($appt['NumStudents'] == ($appt['size'] - 1))
  {
    $sql = "UPDATE appointments SET isFull=1, NumStudents=(NumStudents+1) WHERE id=$apptID";
    mysql_query($sql, $conn);
  }
  else
  {
    $sql = "UPDATE appointments SET NumStudents=(NumStudents+1) WHERE id=$apptID";
    mysql_query($sql, $conn);
  }

  echo "Update students table <br/>";
    //update student
  $sql = "UPDATE students SET Appt ='$apptID' WHERE studentID='" . $_SESSION['studentID'] . "'";
  echo "<br>Students Table:" . $sql;
  mysql_query($sql, $conn);

  header('Location:view/student_view.php');

?>
<br>
<a href="view/student_view.php">Link to student view</a>
