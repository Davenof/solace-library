<?php 
session_start();

require "../config/config.php";
require "../config/functions.php";


$GLOBALS['global_report'] = '';

$pdo = new mypdo();

$username = $_POST['username'];
$password = $_POST['password'];

$user = $pdo->get_user('username', $username);
if($user == null){
	die('Username and password not match');	
}

$verify = password_verify($password,  $user['password']);
if($verify){
	
	unset($_SESSION['admin']);

	$_SESSION['id'] = $user['id'];
	$_SESSION['u'] = $user['username'];
	$_SESSION['p'] = $user['picture'];
	die('success');  
}
else{
	    die('Password or user detail not match'); 
	}