<html>
<link href="../../css/advisor_nav_bar_style.css" rel="stylesheet" type="text/css">
<body>
  <?php
  session_start();
  //Sends to login if no session
  if(session_status() == 2 && !isset($_SESSION['username']))
  {
    $_SESSION['user'] = "advisor";
    $_SESSION['error_message'] = "You've been logged out due to inactivity";
    header("Location:../../html/forms/main_login.php");
  }

  require_once('mysql_connect.php');
  //getting season status
  $sql = "SELECT `status` FROM `websitestatus` WHERE id=1";
  $rs = mysql_query($sql, $conn);
  $status = mysql_fetch_array($rs);
  ?>

<table class="navigation_bars">
  <!-- Displays the top bar for logout -->
  <tr>
    <td id="header" colspan="2">
      Logged in as: <?php echo $_SESSION["username"]; ?>
      <a href="../../html/forms/main_login.php"><button id="logout">Logout</button></a>
    </td>
  </tr>
  <!-- Displays the navigation links for moving around on the page -->
  <tr>
    <td id="nav">
      <a href="../../php/view/advisor_view.php" class="nav_links"><p class="nav_links">View Appointments</p></a>
      <a href="../../html/forms/add_appointment.php" class="nav_links"><p class="nav_links">Add Appointment</p></a>
      <a href="../../html/forms/mass_scheduler_short.php" class="nav_links"><p class="nav_links">Weekly Scheduler</p></a>
      <a href="#" class="nav_links"><p class="nav_links">Make Reports</p></a>
      <a href="../../html/forms/register_advisor.php" class="nav_links"><p class="nav_links">Register Advisor</p></a>
      <!-- Links will fall to bottom of the page -->
    <div id="fillRest">
      <?php
      if (strcasecmp($status['status'],"On") == 0)
      echo "
      <a class='nav_links' href='../../html/forms/website_shut_down.php'><p id='shutdown' class='nav_links'>
        Season Status: On
      </p></a>";
      else
      {
      echo "
      <a class='nav_links' href='../../html/forms/website_restart.php'><p id='restart' class='nav_links'>
        Season Status: Off
      </p></a>";
      }
      ?>
    </div>
    </td>
    <td id="content">
