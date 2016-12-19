<html>
<link href="../../css/advisor_nav_bar_style.css" rel="stylesheet" type="text/css">
<body>
  <?php
  session_start();
  require_once('mysql_connect.php');
  $sql = "SELECT `status` FROM `websitestatus` WHERE id=1";
  $rs = mysql_query($sql, $conn);
  $status = mysql_fetch_array($rs);
  ?>

<table class="navigation_bars">
  <tr>
    <td id="header" colspan="2">
      Logged in as: <?php echo $_SESSION["username"]; ?>
      <a href="../../html/forms/main_login.php"><button id="logout">Logout</button></a>
    </td>
  </tr>
  <tr>
    <td id="nav">
      <a href="../../php/view/advisor_view.php" class="nav_links"><p class="nav_links">View Appointments</p></a>
      <a href="../../html/forms/add_appointment.php" class="nav_links"><p class="nav_links">Add Appointment</p></a>
      <a href="../../html/forms/mass_scheduler.php" class="nav_links"><p class="nav_links">Weekly Scheduler</p></a>
      <a href="#" class="nav_links"><p class="nav_links">Make Reports</p></a>
      <a href="../../html/forms/register_advisor.php" class="nav_links"><p class="nav_links">Register Advisor</p></a>
      <a href="#" class="nav_links"><p class="nav_links">Edit Profile</p></a>
    <div id="fillRest">
      <a class="nav_links" href="website_shut_down.html"><p name="Show Self" id="shutdown" class="nav_links">
        Season Status: <?php echo $status['status']; ?>
      </p></a>
    </div>
    </td>
    <td id="content">
