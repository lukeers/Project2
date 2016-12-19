<?php


  require_once('php/mysql_connect.php');


  // get website status
  $sql = "SELECT `status` FROM `websitestatus` WHERE id=1";
  $rs = mysql_query($sql, $conn);

  // reverse the status
  $status = mysql_fetch_array($rs);
  $webisteStatus = $status['status'];

  // direct to correct site
  if($webisteStatus == "On") {
    // the main page
    header("Location: html/forms/main_login.php");
  }
  else if($webisteStatus == "Off") {
    // advising season shut down page
    echo("Website is down");
    header("Location: html/forms/advising_unavailable.html");
  }
  else {
    // in case the database is unsure (should never happen but in the case of)
    // error case
    echo("Unknown error! Contact DB admin to correct");
    }


?>
