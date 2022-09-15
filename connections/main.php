<?php 
session_start();

if(!isset($_SESSION['id']))
	die('Please login');

$uid = $_SESSION['id']; 

require "../config/config.php";
require "../config/functions.php";

$GLOBALS['global_report'] = '';

if(isset($_POST['ch']) && $_POST['ch'] == 'update_profile'){

	$fname = validate('Full name', 3, 50, $_POST['fname']);
	$email = validate('Email', 5, 50, $_POST['email']);
	$address = validate('Address', 5, 150, $_POST['address']);
	$city = validate('City', 2, 50, $_POST['city']);
	$phone = validate('Phone', 0, 20, $_POST['phone']);
		
	if($GLOBALS['global_report'] !== '')
		die($GLOBALS['global_report']);
		
	$pdo = new mypdo();
	
	$buser =  $pdo->get_one("SELECT * FROM user WHERE id = $uid");
	if($buser['email'] != $email && $pdo->check_email($email))
			die('Email address already exists. Please contact support for help if you suspect account compromise');
	
	$response = $pdo->update_user($uid, $fname, $email, $phone, $address, $city);
	
	die('success');
}

if(isset($_POST['ch']) && $_POST['ch'] == 'update_password') {

		$password =  $_POST['password'];
		$password_1 =  $_POST['password1'];
		$password_2 =  $_POST['password2'];
		
		if(($password_1 != $password_2)  || (strlen($password_1) < 6))
			die('Please retype password. Passwords do not match');
		
		$pdo = new mypdo();
		
		$user = $pdo->get_user('id', $uid);
		
		$verify = password_verify($password, $user['password']);
	  	if(!$verify)
			die('Old password is incorrect');
	   
	   $password =  password_hash($password_1, PASSWORD_DEFAULT);
	 	
	   die($pdo->update_password($uid, $password));		
}

if(isset($_POST['ch']) && $_POST['ch'] == 'update_photo') {
	
	$mime = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
	$mime = strtolower($mime);
	if($mime != "jpg" && $mime != "jpeg" && $mime != "png" && $mime != "gif")
		die("Error! Wrong file type");
	
	$time_now = time();
	
	$pdo = new mypdo();
		
	$user = $pdo->get_user('id', $uid);
	
	$old_file = $user['username'].'_'.$user['picture'];
	@unlink('../uploads/profiles/'.$old_file);
	
	$time_now = $time_now.'.'.$mime; 
	
	$picture = $user['username'].'_'.$time_now;
	
	move_uploaded_file($_FILES["photo"]['tmp_name'], '../uploads/profiles/'.$picture);
	
	$pdo->exec_query("UPDATE user SET picture = '$time_now' WHERE id = $uid");
	
	$_SESSION['p'] = $time_now;
		
	die('success./uploads/profiles/'.$picture);
}

if(isset($_POST['ch']) && $_POST['ch'] == 'add_book') {

	$aname = validate('Authors Name', 2, 50, $_POST['aname']);
	$jname = validate('Joint Name', 0, 200, $_POST['jname']);
	$title = validate('Title', 2, 150, $_POST['title']);
	$subject = validate('Subject', 1, 150, $_POST['subject']);
	$publisher = validate('Publisher', 2, 150, $_POST['publisher']);
	$pub_year = validate('Publish Year', 4, 4, $_POST['pub_year']);
		
	if($GLOBALS['global_report'] !== '')
		die($GLOBALS['global_report']);
		
	$mime = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
	$mime = strtolower($mime);
	
	if($mime != "jpg" && $mime != "jpeg" && $mime != "png" && $mime != "gif")
		die("Error! Wrong cover photo");
	
	$time_now = time();
	$picture =  get_cleaned_title($title).$time_now.'.'.$mime;
	
	$pdo = new mypdo();
	$response = $pdo->add_book($uid, $aname, $jname, $title, $subject, $publisher, $pub_year, $time_now.'.'.$mime, date('Y-m-d H:i', $time_now));
	
	if(substr($response, 0, 7) == 'success') {
		move_uploaded_file($_FILES["photo"]['tmp_name'], '../uploads/books/'.$picture);
	}
	die('success');
}

if(isset($_POST['ch']) && $_POST['ch'] == 'update_book') {

	$aname = validate('Authors Name', 2, 50, $_POST['aname']);
	$jname = validate('Joint Name', 0, 200, $_POST['jname']);
	$title = validate('Title', 2, 150, $_POST['title']);
	$subject = validate('Subject', 1, 150, $_POST['subject']);
	$publisher = validate('Publisher', 2, 150, $_POST['publisher']);
	$pub_year = validate('Publish Year', 4, 4, $_POST['pub_year']);
	
	$id =  intval($_POST['id']);
		
	if($GLOBALS['global_report'] !== '')
		die($GLOBALS['global_report']);
		
	$pdo = new mypdo();
	
	$book = $pdo->get_one("SELECT * FROM books WHERE id = $id AND uid = $uid");
	if($book == null) die();
		
	$time_now = time();
	
	$response = $pdo->update_book($id, $uid, $aname, $jname, $title, $subject, $publisher, $pub_year);
	
	if(substr($response, 0, 7) == 'success') {
		
		if($book['title'] != $title){
			$bfr_path =  '../uploads/books/'.get_cleaned_title($book['title']).$book['picture'];
	    	$new_path =  str_replace(get_cleaned_title($book['title']), get_cleaned_title($title), $bfr_path);
			
			copy($bfr_path, $new_path);
			
			unlink($bfr_path);
		}	
	}
	die('success');
}

if(isset($_POST['ch']) && $_POST['ch'] == 'update_bphoto') {
	
	$id =  intval($_POST['id']);
	
	$mime = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
	$mime = strtolower($mime);
	if($mime != "jpg" && $mime != "jpeg" && $mime != "png" && $mime != "gif")
		die("Error! Wrong file type");
	
	$time_now = time();
	
	$pdo = new mypdo();
		
	$book = $pdo->get_one("SELECT * FROM books WHERE id = $id AND uid = $uid");
	if($book == null) die();
	
	$bfr_path =  '../uploads/books/'.get_cleaned_title($book['title']).$book['picture'];
	@unlink($bfr_path);
			
	$picture = $time_now.'.'.$mime; 
	
	move_uploaded_file($_FILES["photo"]['tmp_name'], '../uploads/books/'.get_cleaned_title($book['title']).$picture); 
	
	$pdo->exec_query("UPDATE books SET picture = '$picture' WHERE id = $id");
		
	die('success./uploads/books/'.get_cleaned_title($book['title']).$picture);
}


if(isset($_POST['ch']) && $_POST['ch'] == 'delete_book') {
	
	$id =  intval($_POST['id']);
	
	$pdo = new mypdo();
		
	$book = $pdo->get_one("SELECT * FROM books WHERE id = $id AND uid = $uid");
	if($book == null) die();
	
	$bfr_path =  '../uploads/books/'.get_cleaned_title($book['title']).$book['picture'];
	@unlink($bfr_path);
			
	$pdo->exec_query("DELETE FROM books WHERE id = $id AND uid = $uid");
		
	die('success');
}

if(isset($_POST['ch']) && $_POST['ch'] == 'delete_account') {
	
	$id = $_SESSION['id'];
	
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
	
	session_unset();
  	session_destroy();
		
	die('success');
}
