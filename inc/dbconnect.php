<?php

$mysqli = new mysqli("localhost","root","","bulkmailer");

if($mysqli->error) {
	echo "Fatal: Unable to connect to database ".$mysqli->error;
	exit;
}