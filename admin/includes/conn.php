<?php
	$conn = new mysqli('http://sql5.freesqldatabase.com/', 'thepapisogram', 'Tony2004.', 'chatterly');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>