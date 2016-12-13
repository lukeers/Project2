<!-- register_advisor.html -->

<!-- Gets information from a potential advisor compares it to make sure
     there is not a match by username in the database then creates and logs in a new advisor
-->

<!-- Gets information from a potential advisor compares it to make sure
     there is not a match by username in the database then creates and logs in a new advisor
-->
<!-- Gets information from a potential advisor compares it to make sure
     there is not a match by username in the database then creates and logs in a new advisor
-->
    <?php
	include("../../php/advisor_nav_bar.php");
	if(isset($_SESSION['error_message'])){
	   echo($_SESSION['error_message']);
	   unset($_SESSION['error_message']);
	}
    ?>


    <h1>Advisor Registration</h1>
    <form method=post action='../../php/validate/validate_advisor.php'>
      <!-- Gets information from the potential advisor, username, first name, last name -->
      <p>Username: <input type=text name="username"/></p>
      <p>First Name: <input type=text name="fName"/></p>
      <p>Last Name: <input type=text name="lName"/></p>
      <p>Password: <input type=text name="password"/></p>
      <p>Office: <input type=text name="office"/></p>
      <p><input type=submit value="Submit"/></p>
    </form>

