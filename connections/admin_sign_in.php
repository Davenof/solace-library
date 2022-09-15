<?php 
session_start();

require "../config/config.php";
require "../config/functions.php";

$GLOBALS['global_report'] = '';

$pdo = new mypdo();

$username = $_POST['username'];
$password = $_POST['password'];

$verify = ($username == 'admin' && $password == 'admin');
if($verify){
	
	unset($_SESSION['id']);
	unset($_SESSION['u']);
	unset($_SESSION['p']);
	$_SESSION['admin'] = 'admin';
	die('success');  
 
}
else{
	    die('Password or username is incorrect'); 
	
}