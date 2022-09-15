<?php 
session_start();
require "../config/config.php";
require "../config/functions.php";

$GLOBALS['global_report'] = '';

$pdo = new mypdo();

$fname = validate('Full name', 3, 50, $_POST['fname']);
$email = validate('Email Adddress', 3, 50, $_POST['email']);

$username = validate('username', 3, 20, $_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	
if($GLOBALS['global_report'] !== '')
	die($GLOBALS['global_report']);

if($pdo->check_username($username)){
	die('Username already exists');
}

if($pdo->check_email($email)){
	die('Email address already exists');
}

$reg_date = date('Y-m-d');

$response = $pdo->new_user($username, $fname, $email, $password, $reg_date);

if(substr($response, 0, 7) == 'success') {
	
	$_SESSION['id'] = substr($response, 7);
	$_SESSION['u'] = $username;
	$_SESSION['p'] = 'avatar.jpg';
	die('success');
}	

die('Error while creating account');


