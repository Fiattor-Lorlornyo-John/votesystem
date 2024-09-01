<?php
	$conn = new mysqli('localhost', 'thepapisogram', 'Tony2004.', 'chatterly');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>