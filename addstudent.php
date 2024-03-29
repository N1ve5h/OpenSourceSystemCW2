<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // build an sql statment to add the student details
      $sql = "INSERT INTO student VALUES ($_POST['txtid']".;
      $sql = "',' $_POST['txtpassword'].','$_POST['txtdob'].','$_POST['firstname'].','$_POST['lastname'].','$_POST['house'].','$_POST['town'].','$_POST['county'].',' $_POST['country'].','$_POST['postcode'])";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your details have been updated</p>";

   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2>Add My Details</h2>
   <form name="frmdetails" action="" method="post">
   Student ID :
   <input name="txtid" type="text"/><br/>
   Date of Birth :
   <input name = "txtdob" type="text"/><br/>
   First Name :
   <input name="txtfirstname" type="text"/><br/>
   Surname :
   <input name="txtlastname" type="text"/><br/>
   Number and Street :
   <input name="txthouse" type="text"/><br/>
   Town :
   <input name="txttown" type="text" /><br/>
   County :
   <input name="txtcounty" type="text"/><br/>
   Country :
   <input name="txtcountry" type="text"/><br/>
   Postcode :
   <input name="txtpostcode" type="text"  /><br/>
   <input type="submit" value="Add" name="add"/>
   </form>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
