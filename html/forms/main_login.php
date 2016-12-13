
<link rel="import" href="../header.html")>
<link rel='stylesheet' type='text/css' href='../../css/style.css'/>

	
<?php
	if(session_status() == PHP_SESSION_NONE){
		session_start();
	}
	if(!isset($_SESSION['user'])){
		$_SESSION['user'] = "student";
	}
?>

<!-- Code -->
<div class="main">
	
	<div class="switch">
		<button value="Student" class="button" onclick="RegistrationChange(this.value)">Student</button>
		<button value="Advisor" class="button" onclick="RegistrationChange(this.value)">Advisor</button>
	</div>

	<!-- Advisor Page -->

	<div id="AdvisorRegistration" <?php if($_SESSION['user'] == "student"){ echo 'style="display:none"';} ?>>
		<h1>Advisor Login</h1>
		<?php
			if(isset($_SESSION['error_message'])){
				echo($_SESSION['error_message']);
			}
			include("login_advisor.html");
		?>
	</div>

	<!--Student Page -->
	<div id="StudentRegistration" <?php if($_SESSION['user'] == "advisor"){ echo 'style="display:none"';} ?>>
		<h1>Student Registration</h1>
		<?php
			if(isset($_SESSION['error_message'])){
				echo($_SESSION['error_message']);
				unset($_SESSION['error_message']);
			}
			include("register_student.html");
		?>
	</div>
</div>

<script>

function RegistrationChange(value)
{
  if(value == "Student")
  {
    document.getElementById("StudentRegistration").style.display = "block";
    document.getElementById("AdvisorRegistration").style.display = "none";
  }
  else if (value == "Advisor") {
    document.getElementById("StudentRegistration").style.display = "none";
    document.getElementById("AdvisorRegistration").style.display = "block";
  }
}
			
</script>
	
<link rel="import" href="../footer.html")>
	
