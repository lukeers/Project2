<?php include("../../php/advisor_nav_bar.php"); ?>
<h1>Shut Website Down?</h1>
  <p> <b> Warning: this will <u>END</u> registration for students to register for advising </b></p>
    <form method=post action='../../php/validate/change_websitestatus.php'>
      <!-- Gets the only necessary data, a username from the user -->
      <p>Username: <input type=text name="entered_username"/></p>
      <p>Password: <input type=password name="entered_password"/></p>
      <p><input type=submit value="Submit"/></p>
    </form>
