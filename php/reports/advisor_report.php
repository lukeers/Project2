<style>
table, th, td {
border: 1px solid black;
border-collapse: collapse;
}
</style>

<?php

require_once('../mysql_connect.php');

?>

<div class='top_container'><h3>Scheduled Appointments<br>
  <div class='bottom_container'>
    <table id='list_view'>
    <tr>
      <th>Date</th>
      <th>Time</th>
      <th>Location</th>
      <th>Group</th>
      <th>#Students</th>
      <th>View Registered Students</th>
    </tr>
<?php
  $sql = "SELECT * FROM appointments ORDER BY Date ASC, Time ASC";

?>
  
