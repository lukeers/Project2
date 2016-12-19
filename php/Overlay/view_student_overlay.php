<div id='overlay'>
  <!-- <p> -->
    <!-- Content to update meeting -->
    <table id='tOverlay'>
      <tr>
        <!-- Form to add a student to meeting -->
        <td id='addStudent' class='overlayForm'>
          <form action='#' method='post'>
            <input type='hidden' name='ID' value='<?php echo $appoint['id'] ?>' >
            <div class="overlayTextCenter">
              <b>Add Student</b><br><br><br>
            </div>
            <label>First Name: </label><input type='text' name='firstName' required><br><br>
            <label>Last Name:  </label><input type='text' name='lastName' required><br><br>
            <label>Student ID: </label><input type='text' name='studentID' pattern='[A-Za-z]{2}\d{5}' class='caps' required><br><br>
            <label>UMBC Email: </label><input type='email' name='email' required><br><br>
            <label>Major:      </label><select name="major" required>
  		        <!-- This creates a drop down box of the possible major choices -->
      				<option value = "Biological Sciences BA">Biological Sciences BA</option>
      				<option value = "Biological Sciences BS">Biological Sciences BS</option>
      				<option value = "Biochemistry & Molecular Biology BS">Biochemistry & Molecular Biology BS</option>
      				<option value = "Bioinformatics & Computational Biology BS">Bioinformatics & Computational Biology BS</option>
      				<option value = "Biology Education BA">Biology Education BA</option>
      				<option value = "Chemistry BA">Chemistry BA</option>
      				<option value = "Chemistry BS">Chemistry BS</option>
      				<option value = "Chemistry Education BA">Chemistry Education BA</option>
      				<option value = "Other">Other</option>
      			</select><br><br>
            What are your current post-UMBC plans?<br>
            <textarea name='response1' rows='5' cols='45'></textarea><br><br>
            <span class='centerSubmitButtons'>
              <input type='submit' name='typeOfSubmit' value='Add' class='submitButton'>
              <button type='button' onclick="hideOverlay()">Cancel</button>
            </span>
          </form>
        </td>
      <!-- Form to update meeting -->
        <td class='overlayForm' id='updateMeeting' >
          <form action='#' method='post'>
            <div class="overlayTextCenter">
              <b>Edit Meeting Info</b><br><br><br>
            </div>
            <input type='hidden' name='ID' value='<?php echo $appoint['id'] ?>' >
            Date: <input type='Date' name='Date' value='<?php echo $appoint['Date']; ?>' >
            <br><br>
            Time:
            <select name="Time">
            	<option value="08:00" <?php if($appoint['Time'] == "08:00"){echo "selected";} ?> >08:00am</option>
            	<option value="08:30" <?php if($appoint['Time'] == "08:30"){echo "selected";} ?> >08:30am</option>
            	<option value="09:00" <?php if($appoint['Time'] == "09:00"){echo "selected";} ?> >09:00am</option>
            	<option value="09:30" <?php if($appoint['Time'] == "09:30"){echo "selected";} ?> >09:30am</option>
            	<option value="10:00" <?php if($appoint['Time'] == "10:00"){echo "selected";} ?> >10:00am</option>
            	<option value="10:30" <?php if($appoint['Time'] == "10:30"){echo "selected";} ?> >10:30am</option>
            	<option value="11:00" <?php if($appoint['Time'] == "11:00"){echo "selected";} ?> >11:00am</option>
            	<option value="11:30" <?php if($appoint['Time'] == "11:30"){echo "selected";} ?> >11:30am</option>
            	<option value="12:00" <?php if($appoint['Time'] == "12:00"){echo "selected";} ?> >12:00pm</option>
            	<option value="12:30" <?php if($appoint['Time'] == "12:30"){echo "selected";} ?> >12:30pm</option>
            	<option value="13:00" <?php if($appoint['Time'] == "13:00"){echo "selected";} ?> >01:00pm</option>
            	<option value="13:30" <?php if($appoint['Time'] == "13:30"){echo "selected";} ?> >01:30pm</option>
            	<option value="14:00" <?php if($appoint['Time'] == "14:00"){echo "selected";} ?> >02:00pm</option>
            	<option value="14:30" <?php if($appoint['Time'] == "14:30"){echo "selected";} ?> >02:30pm</option>
            	<option value="15:00" <?php if($appoint['Time'] == "15:00"){echo "selected";} ?> >03:00pm</option>
            	<option value="15:30" <?php if($appoint['Time'] == "15:30"){echo "selected";} ?> >03:30pm</option>
            	<option value="16:00" <?php if($appoint['Time'] == "16:00"){echo "selected";} ?> >04:00pm</option>
            	<option value="16:30" <?php if($appoint['Time'] == "16:30"){echo "selected";} ?> >04:30pm</option>
            </select>
            <br><br>
            Location: <input type='text' name='Location' value='<?php echo $appoint['Location']; ?>'>
            <br><br>
            <span class="centerSubmitButtons">
              <input type='submit' name='typeOfSubmit' value='Update' class='submitButton'>
              <button type='button' onclick="hideOverlay()">Cancel</button>
            </span>
          </form>
        </td>

        <!-- Form to delete the meeting -->
        <td id='deleteMeetingCheck' class='overlayForm'>
          <form action='../cancel_advisor_appointment.php' method='post'>
            <div class='overlayTextCenter'>
              <b>
                <br>Are you Sure?
              </b><br><br>
              <button type='submit' name='ID' value='<?php echo $_POST['ID']; ?>' >Yes</button>
              <button type='button' onclick="hideOverlay()">No</button>
            </div>
          </form>
        </td>
      </tr>
    </table>
  <!-- </p> -->
</div>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
  var overlay_width = document.getElementById('overlay').offsetWidth;
  document.getElementById("overlay").style.left = ((window.outerWidth-overlay_width)/2) + "px";
  document.getElementById('overlay').style.display = "none";
});

window.addEventListener('resize', function(event){
  var overlay_width = document.getElementById('overlay').offsetWidth;
  var overlay_height = document.getElementById('overlay').offsetHeight;
  document.getElementById("overlay").style.left = ((window.outerWidth-overlay_width)/2) + "px";
  document.getElementById("overlay").style.top = ((window.outerHeight-overlay_height)/2) + "px";
});

function showOverlay(formType){
  console.log(formType);
  hideOverlay();
  document.getElementById('overlay').style.display = "block";
  document.getElementById(formType).style.display = "table-cell";
  var overlay_height = document.getElementById('overlay').offsetHeight;
  document.getElementById("overlay").style.top = ((window.outerHeight-overlay_height)/2) + "px";
}
function hideOverlay(){
  document.getElementById('overlay').style.display = "none";
  elements = document.getElementsByClassName('overlayForm');
  for(i = 0 ; i < elements.length ; i++)
  {
    elements[i].style.display = "none";
  }
}
</script>

<style>
.overlayTextCenter
{
  text-align: center;
}
.caps
{
  text-transform: uppercase;
}
label{
  width: 100px;
  display: inline-block;
}
table#tOverlay
{
  width: 100%;
  height: 100%;
}
table#tOverlay .centerSubmitButtons
{
  position: absolute;
  left: 38%;
}
table#tOverlay b
{
  text-align: center;
}
table#tOverlay input[type="submit"].submitButton
{
  float: right;
  margin: 0px 10px;
}
div#overlay
{
  position: fixed;
  /*top: 25%;*/
  width: 450px;
  /*height: 50%;*/
  background: rgba(230,230,230,.95);
  border: 1px black solid;
  border-radius: 10px;
  padding: 5px;
  color: black;
  text-align: center;
}
/*div#overlay form*/
div#overlay td
{
  display: none;
  /*width: 100%;*/
}
div#overlay textarea
{
  max-width: 330px;
}

</style>
