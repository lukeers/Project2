<!-- add_appointment.html -->
<!-- This file is the form for the advisor to create and appointment -->
<!--
File call/redirect
	Receive: advisor_view.php
	Send: validate_appointment.php
-->
<style>
.appointSize
{
  margin-left: 10px;
  margin-top: 5px;
}
.appointSize_other
{
  margin-top: 5px;
  min-width: 35px;
  width: 50px;
}
</style>
<?php include('../../php/advisor_nav_bar.php'); ?>
    <h1>Add an appointment </h1>
    <form method=post action="../../php/validate/validate_appointment.php">
    <!-- Gets the necessary information about the appontment, date, time, location, group -->
    <p>Date: <input type=date name="date" id="dateSelector" required></p>
    <p>
      <!-- Time is restricted to only having the times between 8:00am and 4:30 pm selected in 30 minutes increments -->
      Time: <select name="time" required>
  <option value="" selected>Select the time</option>
	<option value="08:00">08:00am</option>
	<option value="08:30">08:30am</option>
	<option value="09:00">09:00am</option>
	<option value="09:30">09:30am</option>
	<option value="10:00">10:00am</option>
	<option value="10:30">10:30am</option>
	<option value="11:00">11:00am</option>
	<option value="11:30">11:30am</option>
	<option value="12:00">12:00pm</option>
	<option value="12:30">12:30pm</option>
	<option value="13:00">01:00pm</option>
	<option value="13:30">01:30pm</option>
	<option value="14:00">02:00pm</option>
	<option value="14:30">02:30pm</option>
	<option value="15:00">03:00pm</option>
	<option value="15:30">03:30pm</option>
	<option value="16:00">04:00pm</option>
	<option value="16:30">04:30pm</option>
      </select>
    </p>
    <p>Location: <input type=text name="location" required></p>
    <p>Group? <select name="group">
	<option value=1 selected>Yes</option>
	<option value=0>No</option>
  </select>
      <br>
      <input type="radio" class="appointSize" name="group_size" value="1" required>1
      <input type="radio" class="appointSize" name="group_size" value="5">5
      <input type="radio" class="appointSize" name="group_size" value="10">10
      <input type="radio" class="appointSize" name="group_size" value="15">15
      <input type="radio" class="appointSize" name="group_size" value="20">20
      <input type="radio" class="appointSize" name="group_size" value="" id="other">
          <input class="appointSize_other" type="number" min="0" onkeyup="groupSizeOther(this.value)">
    </p>
    <p><input type=submit value="Submit"/></p>
    </form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    todayDate = new Date();
    todayDate = todayDate.getFullYear() + "-" + (todayDate.getMonth()+1) + "-" + todayDate.getDay();
    console.log(todayDate);
    // document.getElementById('dateSelector').min = todayDate;
    console.log(new Date());
}, false);
function groupSizeOther(groupSize)
{
  document.getElementById('other').value = groupSize;
}
function evaluation()
{
  element = document.getElementById('dateSelector').value;
  console.log("Contain: " + element);
  if(element < todayDate)
  {
  console.log("Check: " + todayDate);
  }
}

</script>
