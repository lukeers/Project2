
<link rel="import" href="../header.html">
<link rel='stylesheet' type='text/css' href='../../css/style.css'/>

<div id="AdvisorRegistration" class="main">
  <h1>Advisor Login</h1>

<table class="formContainer"><form name="advisorform" method=post action='../../php/validate/validate_advisor_login.php' onsubmit="return validateAdvisorForm();">

	<!-- Gets information from the potential advisor, username, first name, last name -->
	<p><tr><td>Username: </td><td><input type=text name="username" required/></td></tr></p>
	<p><tr><td>Password: </td><td><input type=password name="password" required/></td></tr></p>
	<p id="passErr"></p>
	<p><tr><td><input type=submit id="submit" class="button" value="Submit"/></td></tr></p>
</form></table>

</div>

<script>
function validateAdvisorForm() {
	var x = document.forms["advisorform"];
	var isValid = true;

	//Checks if password is atleast 6 characters long
	if(x.password.value.length < 6) {
		x.password.style.borderColor = "red";
		document.getElementById("passErr").innerHTML = "Password must be at least 6 characters long.";
		isValid = false;
	}
	return isValid;
}
</script>

<link rel="import" href="../footer.html")>
