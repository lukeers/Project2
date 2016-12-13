<html>
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
      <a href="#" class="nav_links"><p class="nav_links">Make Reports</p></a>
      <a href="../../html/forms/register_advisor.php" class="nav_links"><p class="nav_links">Register Advisor</p></a>

    <div id="fillRest">
      <a class="nav_links"><p name="Show Self" class="nav_links">Season Status: <?php echo $status['status']; ?></p></a>
    </div>
    </td>
    <td id="content">

<style>

table.navigation_bars
{
  /* border: 1px #122232 solid; */
  height: 100%;
  width: 100%;
  border-collapse: collapse;
}
/*styling links for left navigation bar*/
a.nav_links
{
  text-decoration: none;
  color: white;
  position: relative;
}
p.nav_links
{
  margin: 0px;
  padding: 10px 3 10px 3;
  background-color: #122232;
}
/*hover effects for left bar*/
p.nav_links:hover
{
  background-color: #BEC6CE;
  color: black;
}
.top_container
{
}
.bottom_container
{
}
.swapView
{
  margin: 0 15px;
}
/*logout on right side of header*/
#logout
{
  float: right;
}
/*top navigation bar*/
#header
{
  height: 22px;
  background-color: #122232;
  border: 1px white solid;
  color: white;
  text-align: left;
}
/*side navigation bar for user*/
#nav
{
  vertical-align: top;
  text-align: left;
  width:160px;
  background-color: #122232;
  position: relative;
}
/*What is changing in the view*/
#content
{
  text-align: center;
  vertical-align: top;
}
/*Lower to bottom of the screen for side nav*/
#fillRest
{
  position: absolute;
  bottom: 0px;
  width: inherit;
  height: auto;
  vertical-align: bottom;
}
</style>
