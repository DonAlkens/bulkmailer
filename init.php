<?php 

$con = new mysqli("localhost","root","");

$createDB = $con->query("CREATE DATABASE bulkmailer");

if($createDB){
	$mysqli = new mysqli("localhost","root","","bulkmailer");

	$adminTable = $mysqli->query("CREATE TABLE IF NOT EXISTS admin(
		sn int(9) not null auto_increment,
		firstname varchar(255) null,
		lastname varchar(255) null,
		email varchar(255) not null,
		password varchar(255) not null,
		PRIMARY KEY(sn),
		UNIQUE(email)
	)");


	if($adminTable) {
		$email = 'admin@test.com';
		$password = md5('admin');
		$createSuperUser = $mysqli->query("INSERT INTO admin(email,password) VALUES('$email','$password')");
	}

	$createStatusTable = $mysqli->query('CREATE TABLE IF NOT EXISTS mail_status(
		sn int(9) not null auto_increment,
		email varchar(200) not null,
		status tinyint not null,
		date varchar(100) not null,
		PRIMARY KEY(sn)
	)');

	$createTitle = $mysqli->query("CREATE TABLE IF NOT EXISTS mail_title(
		sn int(9) not null auto_increment,
		title text not null,
		date varchar(100) not null,
		PRIMARY KEY(sn)
	)");
}

?>