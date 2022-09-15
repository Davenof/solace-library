<?php 
session_start();

if(!isset($_SESSION['admin']))
	die('Please login');

require "../config/config.php";
require "../config/functions.php";

$GLOBALS['global_report'] = '';

if(isset($_POST['ch']) && $_POST['ch'] == 'delete_book') {
	
	$id =  intval($_POST['id']);
	
	$pdo = new mypdo();
		
	$book = $pdo->get_one("SELECT * FROM books WHERE id = $id");
	if($book == null) die(); 
	
	$bfr_path =  '../uploads/books/'.get_cleaned_title($book['title']).$book['picture'];
	@unlink($bfr_path);
			
	$pdo->exec_query("DELETE FROM books WHERE id = $id");
		
	die('success');
}

if(isset($_POST['ch']) && $_POST['ch'] == 'delete_user') {
	
	$id =  intval($_POST['id']);
	
	$pdo = new mypdo();
		
	$user = $pdo->get_one("SELECT * FROM user WHERE id = $id");
	if($user == null) die();
	
	$bfr_path =  '../uploads/profiles/'.$user['username'].'_'.$user['picture'];
	@unlink($bfr_path);
			
	$books = $pdo->get_all("SELECT * FROM books WHERE uid = $id");
	foreach($books as $book){
		$bfr_path =  '../uploads/books/'.get_cleaned_title($book['title']).$book['picture'];
		@unlink($bfr_path);
	}
	
	$pdo->exec_query("DELETE FROM books WHERE uid = $id");
	$pdo->exec_query("DELETE FROM user WHERE id = $id");
		
	die('success');
}
