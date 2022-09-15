<?php


function validate($field, $l_limit, $u_limit, $value, $extra = '') {
	
	if(strlen($value) < $l_limit){
		$GLOBALS['global_report'] .=  'Too few characters for '.$field.' minimum: '.$l_limit.'<br>';
		return;
	}
	if(strlen($value) > $u_limit){
		$GLOBALS['global_report'] .=  'Too long characters for '.$field.' maximum: '.$u_limit.'<br>';
		return;
	}    

	return htmlspecialchars($value,  ENT_COMPAT);
}

function get_cleaned_title($str) {
	
	$str = preg_replace('/[^A-Za-z0-9]/', '_', $str);
	$str = preg_replace('/_{2, }/', '_', $str);
	return $str;		
}

class mypdo {
	 public $pdc = null;
	 public function __construct(){
		 $host = dbhost;
		 $db   =  dbname;
		 $user  =  dbuser;
		 $pass  =   dbpass;
		 $charset = 'utf8mb4';
		 $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		 $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false,];
		 $this->pdc = new PDO($dsn, $user, $pass, $opt);
		 }
	 	  
    public function exec_query($qry){
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->execute();
	}
	  
    public function get_one($qry){
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->execute();
		 if($stmt->rowCount() > 0)
		 	return $stmt->fetch();
		 else
		 	return null;		
	}
	
	public function get_all($qry){
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->execute();
		 return $stmt->fetchAll();		
	}

	public function get_all_var($qry, $val){
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $val, PDO::PARAM_STR);
		 $stmt->execute();
		 return $stmt->fetchAll();		
	}

	public function get_all_var2($qry, $val, $val2){
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $val, PDO::PARAM_STR);
		 $stmt->bindParam(2, $val2, PDO::PARAM_STR);
		 $stmt->execute();
		 return $stmt->fetchAll();		
	}
		  
    public function check_username($username){
		 $qry = "SELECT username FROM user WHERE username = ?";
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $username, PDO::PARAM_STR);
         $stmt->execute();
		 if($stmt->rowCount() > 0)
		 	return true;
		 else
		 	return false;		
	}
	  
    public function check_email($email){
		 $qry = "SELECT email FROM user WHERE email = ?";
		 $stmt = $this->pdc->prepare($qry);
	     $stmt->bindParam(1, $email, PDO::PARAM_STR);
         $stmt->execute();
		 if($stmt->rowCount() > 0)
		 	return true;
		 else
		 	return false;		
	}
	 
    public function get_user($col, $val){
		 $qry = "SELECT * FROM user WHERE $col = ?";
		 $stmt = $this->pdc->prepare($qry);
	     if($col == 'username')
		 	$stmt->bindParam(1, $val, PDO::PARAM_STR);
         else
		 	$stmt->bindParam(1, $val, PDO::PARAM_INT);
		 $stmt->execute();
		 if($stmt->rowCount() > 0)
		 	return $stmt->fetch();
		 else
		 	return null;		
	}
		
	public function new_user($username, $fname, $email, $password, $reg_date) {
		
		$qry = "INSERT INTO user(username, fname, email, password, reg_date)VALUES(?, ?, ?, ?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $username, PDO::PARAM_STR);
		$stmt->bindParam(2, $fname, PDO::PARAM_STR);
		$stmt->bindParam(3, $email, PDO::PARAM_STR);
		$stmt->bindParam(4, $password, PDO::PARAM_STR);
		$stmt->bindParam(5, $reg_date, PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount() > 0)
			return "success".$this->pdc->lastInsertId();
		return 'errror';
	}
	
	public function update_user($uid, $fname, $email, $phone, $address, $city) {
		
		$qry = "UPDATE user SET fname = ?, email = ?, phone = ?, address = ?, city = ? WHERE id = ?";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $fname, PDO::PARAM_STR);
		$stmt->bindParam(2, $email, PDO::PARAM_STR);
		$stmt->bindParam(3, $phone, PDO::PARAM_STR);
		$stmt->bindParam(4, $address, PDO::PARAM_STR);
		$stmt->bindParam(5, $city, PDO::PARAM_STR);
		$stmt->bindParam(6, $uid, PDO::PARAM_INT);
		$stmt->execute();
		if($stmt->rowCount() > 0)
			return "success";
		return 'No update was made';
	}
	 
	 public function update_password($uid, $password) {

		  $qry = "UPDATE user SET password = ? WHERE  id = ?";
		 $stmt = $this->pdc->prepare($qry);
		 $stmt->bindParam(1, $password, PDO::PARAM_STR);
		 $stmt->bindParam(2, $uid, PDO::PARAM_INT);
		 $stmt->execute();
		 if($stmt->rowCount() > 0) return 'success'; else die('No update was made');
	 }
	
	public function add_book($uid, $aname, $jname, $title, $subject, $publisher, $pub_year, $picture, $time_now) {
		
		$qry = "INSERT INTO books(uid, author_name, joint_authors, title, subject, publisher, pub_year,  picture, date_added)VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $uid, PDO::PARAM_INT);
		$stmt->bindParam(2, $aname, PDO::PARAM_STR);
		$stmt->bindParam(3, $jname, PDO::PARAM_STR);
		$stmt->bindParam(4, $title, PDO::PARAM_STR);
		$stmt->bindParam(5, $subject, PDO::PARAM_STR);
		$stmt->bindParam(6, $publisher, PDO::PARAM_STR);
		$stmt->bindParam(7, $pub_year, PDO::PARAM_STR);
		$stmt->bindParam(8, $picture, PDO::PARAM_STR);
		$stmt->bindParam(9, $time_now, PDO::PARAM_STR);
		$stmt->execute();
		if($stmt->rowCount() > 0)
			return "success".$this->pdc->lastInsertId();
		return 'errror';
	}
	
	public function update_book($id, $uid, $aname, $jname, $title, $subject, $publisher, $pub_year) {
		
		$qry = "UPDATE books SET author_name = ?, joint_authors  = ?, title  = ?, subject  = ?, publisher  = ?, pub_year  = ? WHERE id = ? AND uid = ?";
		$stmt = $this->pdc->prepare($qry);
		$stmt->bindParam(1, $aname, PDO::PARAM_STR);
		$stmt->bindParam(2, $jname, PDO::PARAM_STR);
		$stmt->bindParam(3, $title, PDO::PARAM_STR);
		$stmt->bindParam(4, $subject, PDO::PARAM_STR);
		$stmt->bindParam(5, $publisher, PDO::PARAM_STR);
		$stmt->bindParam(6, $pub_year, PDO::PARAM_STR);
		$stmt->bindParam(7, $id, PDO::PARAM_INT);
		$stmt->bindParam(8, $uid, PDO::PARAM_INT);
		$stmt->execute();
		if($stmt->rowCount() > 0)
			return "success";
		return 'errror';
	}
}


