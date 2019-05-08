<?php
	//  replace mysqllogin and mysqlpassword with your own
	$conn = mysqli_connect("21706089@intweb.bucks.ac.uk", "root", "", "db1_21706089");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

?>
