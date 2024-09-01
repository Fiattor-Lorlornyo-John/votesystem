<?php
	$conn = new mysqli('sql5728810', 'thepapisogram', 'Tony2004.', 'chatterly');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>