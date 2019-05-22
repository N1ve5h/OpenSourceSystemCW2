<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // Build SQL statment that selects a student's modules
   $sql = "select * from student";
   $result = mysqli_query($conn,$sql);

   // prepare page content
   $data['content'] .= "<table border='1'>";
   $data['content'] .= "<tr><th colspan='5' align='center'>Student</th></tr>";
   $data['content'] .= "<tr><th></th><th>Student ID</th><th>Password</th><th>DOB</th><th>First Name</th><th>Last Name</th><th>House</th><th>Town</th></tr>";
   // Display the modules within the html table
   while($row = mysqli_fetch_array($result)) {
      $data['content'] .= "<tr><td><form action='' method='post'><input type='checkbox' name='student[]'</td><td> $row[studentid] </td><td> $row[password] </td><td> $row[dob] </td><td> $row[firstname] </td><td> $row[lastname] </td><td> $row[house] </td><td> $row[town] </td>";
      $studentdata = array //Store student information into an array
      (
        array("$row[studentid]","$row[password]","$row[dob]","$row[firstname]","$row[lastname]","$row[house]","$row[town]")
      );
   }
   echo "<input type='submit' name='delrecords' value='Delete'></form>";
   $data['content'] .= "</table>";

   if (isset($_POST['delrecords']))
   {
     $i = 0;
     while ($i < count($studentdata,0)) //Goes through all checkboxes have been ticked or not
     {
       if(isset($_POST['student["i"]'])) //delete if checked
       {
         mysqli_query($conn,"DELETE FROM student WHERE $studentdata[$i]");
         echo "$studentdata[$i]";
       }
     }
   }

   // render the template
   echo template("templates/default.php", $data);


   } else {
   header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

   ?>
