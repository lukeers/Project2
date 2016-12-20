<!-- login_advisor.html -->
<!-- This file will get a username from the user then compare it to the database, if there is a match then the user will be logged in -->

<?php
	include('../php/advisor_nav_bar.php');
?>
<html>
<h1>Change Advisor Info</h1>
<h2>(All of these fields are optional, you don't have to fill them in)</h2>
<form name="advisoreditform" method=post action='/validate/validate_change_advisor.php' onsubmit="return validateEditForm();">
	<!-- Gets information from the potential advisor, username, first name, last name -->
	<p>New Username: <input type=text name="username" /></p>
	<p>New Name: <input type=text name="fullName" /></p>
	<p>New Password: <input type=password name="password" /></p>
	<p>Confirm Password: <input type=password name="confirm" /></p>
	<p id="passErr"></p>
	
	<p><input type=submit id="submit" class="button" value="Submit"/></p>
</form>

<script>
function validateEditForm() {
	var x = document.forms["advisorform"];
	var isValid = true;

	//Checks if password is at least 6 characters long
	if(x.password.value.length !== 0 && x.password.value.length < 6) {
		x.password.style.borderColor = "red";
		document.getElementById("passErr").innerHTML = "Password must be at least 6 characters long.";
		isValid = false;
	}
	else if(x.password.value !== x.confirm.value){
		x.password.style.borderColor = "red";
		document.getElementById("passErr").innerHTML = "Passwords don't match.";
		isValid = false;
	}
	return isValid;
}
</script>

</html>