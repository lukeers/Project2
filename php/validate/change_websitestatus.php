<?php

  require_once('../mysql_connect.php');

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
      echo("<p>username found</b>");
    }
  }
  if($name_found) {
    $sql = "SELECT `password` FROM `advisorpasswords` WHERE `username`='" . $_POST['entered_username']. "'";
    $rs = mysql_query($sql, $conn);

    if (!$rs) {
      die("Error running $sql: " . mysql_error());
    }

    $password = mysql_fetch_array($rs);

    if (sha1($_POST['entered_password']) == $password['password']) {
        $password_match = True;
        echo("<p>password matched</b>");
    }
  }

  // This is the pass case
  if ($name_found && $password_match)
  {
    // UPDATE THE DB

    // get the current status
    $sql = "SELECT `status` FROM `websitestatus` WHERE id=1";
    $rs = mysql_query($sql, $conn);

    // reverse the status
    $status = mysql_fetch_array($rs);
    $newStatus = $status['status'];

    if($newStatus == "On") {
      $newStatus = "Off";
    }
    else {
      $newStatus = "On";
    }

    // update the status
    $sql = "UPDATE `websitestatus` SET `status`='" . $newStatus . "' WHERE id=1";
    $rs = mysql_query($sql, $conn);


    // TODO needs a path to go to when comeplete
    header("Location: ../view/advisor_view.php");

  }

  // This is the fail case
  else
  {
    // Username field left blank
    if ($_POST['entered_username'] == "")
    {
      $error_message = "Username field can't be blank.<br>";
    }

    // Username does not exists in the table
    else
    {
      $error_message = "Username and/or password not recognized.<br>";
    }
    // NEED A WAY TO HANDLE WHEN THIS HAPPENS
    $sql = "SELECT `status` FROM `websitestatus` WHERE id=1";
    $rs = mysql_query($sql, $conn);

    // reverse the status
    $status = mysql_fetch_array($rs);

    // revert back to old page
    if($status == "On") {
      include("../../html/forms/website_shut_down.php");
    }
    else {
      include("../../html/forms/website_restart.php");
    }


  }



?>
