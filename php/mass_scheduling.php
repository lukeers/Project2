<?php


require_once('mysql_connect.php');
session_start();


$startOfWeek = $_POST["startdate"];
$groupSize = $_POST["group_size"];
$location = $_POST["location"];
$group = 1;

// look at the group size
if($groupSize == "1") {
  $group = 0;
}

// TODO : get it to get the current advisor
$username = $_SESSION['username'];


// Get the information from the advisors database for the fullName
// This will be used in the next query
$sql = "SELECT fullName FROM advisors WHERE Username = \"" . $username . "\"";
$rs = mysql_query($sql, $conn);
$fullName = mysql_fetch_array($rs)['fullName'];


if(!empty($_POST["mon"])) {
  $monday_times = $_POST["mon"];
  $date = $startOfWeek;
  foreach ($monday_times as $time) {
    if($time == "8") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "830") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "9") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "930") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "10") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1030") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "11") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "12") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "2") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "3") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "330") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "4") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "430") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }

  }
}
///// TUESDAY
if(!empty($_POST["tues"])) {
  $tuesday_times = $_POST["tues"];
  $date = date('Y-m-d',strtotime($startOfWeek . ' +1 day'));
  foreach ($tuesday_times as $time) {
    if($time == "8") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "830") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "9") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "930") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "10") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1030") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "11") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "12") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "2") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "3") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "330") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "4") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "430") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }

  }
}
//// WED

if(!empty($_POST["wed"])) {
  $wednesday_times = $_POST["wed"];
  $date = date('Y-m-d',strtotime($startOfWeek . ' +2 day'));
  foreach ($wednesday_times as $time) {
    if($time == "8") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "830") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "9") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "930") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "10") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1030") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "11") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "12") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "2") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "3") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "330") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "4") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "430") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }

  }
}

///// THURSDAY
if(!empty($_POST["thurs"])) {
  $thursday_times = $_POST["thurs"];
  $date = date('Y-m-d',strtotime($startOfWeek . ' +3 day'));
  foreach ($thursday_times as $time) {
    if($time == "8") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "830") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "9") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "930") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "10") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1030") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "11") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "12") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "2") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "3") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "330") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "4") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "430") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }

  }
}
//// FRIDAY

if(!empty($_POST["fri"])) {
  $friday_times = $_POST["fri"];
  $date = date('Y-m-d',strtotime($startOfWeek . ' +4 day'));
  foreach ($friday_timesd as $time) {
    if($time == "8") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "830") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "8:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "9") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "930") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "9:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "10") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1030") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "10:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "11") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "11:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "12") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "12:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "1") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "130") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "13:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "2") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "230") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "14:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "3") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "330") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "15:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "4") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:00" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }
    elseif($time == "430") {
      $sql = "INSERT INTO appointments (Date, Time, Location, isGroup, Advisor, AdvisorUsername, size) VALUES ('" . $date . "', '" . "16:30" . "', '" . $location . "', '" . $group . "', '" . $fullName . "', '" . $username . "','" . $groupSize . "')";
      $rs = mysql_query($sql, $conn);
    }

  }
}

header("Location: ../view/advisor_view.php");

?>
