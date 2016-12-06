<html>
<style>
table.navigation_bars
{
  /* border: 1px #122232 solid; */
  height: 100%;
  width: 100%;
  border-collapse: collapse;
}
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
#logout
{
  float: right;
}
#header
{
  height: 22px;
  background-color: #122232;
  border: 1px white solid;
  color: white;
  text-align: left;
}
#nav
{
  vertical-align: top;
  text-align: left;
  width:160px;
  background-color: #122232;
  position: relative;
}
#content
{
  text-align: center;
  vertical-align: middle;
}
#fillRest
{
  position: absolute;
  bottom: 0px;
  width: inherit;
  height: auto;
  vertical-align: bottom;
}

</style>

<body>
  <?php echo(session_status()); ?>
  <?php echo($_SESSION['username']); ?>
<table class="navigation_bars">
  <tr>
    <td id="header" colspan="2">
      Logged in as: <?php echo $_SESSION["username"]; ?>
      <a href="../../html/forms/first_page.html"><button id="logout">Logout</button></a>
    </td>
  </tr>
  <tr>
    <td id="nav">
      <a href="../../php/view/advisor_view.php" class="nav_links"><p class="nav_links">View Appointments</p></a>
      <a href="../../html/forms/add_appointment.php" class="nav_links"><p class="nav_links">Add Appointment</p></a>
      <a href="#" class="nav_links"><p class="nav_links">Make Reports</p></a>
      <a href="#" class="nav_links"><p class="nav_links">Remove Appointment</p></a>
    <div id="fillRest">
      <a class="nav_links"><p name="Show Self" class="nav_links">Show All Advisors</p></a>
    </div>
    </td>
    <td id="content">
