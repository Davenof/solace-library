<?php 
session_start();

require "../config/config.php";
require "../config/functions.php";


if(isset($_POST['search_ch']) && $_POST['search_ch'] == 'openlibrary'){
	
	$search = $_POST['search'];
	$url = 'http://openlibrary.org/search.json?q='.urlencode($search).'&fields=title,author_name,cover_i,isbn,publisher,first_publish_year,subject&limit=20';
	
	die(get_url_content($url));	
	
}

if(isset($_POST['ch']) && $_POST['ch'] == 'users') {
	
	$search_ch = $_POST['search_ch'];
	$search = $_POST['search'];
	
	$pdo = new mypdo();
	
	if($search_ch == 'all'){
			$books = $pdo->get_all("SELECT * FROM user ORDER by reg_date DESC");	
	}
	elseif($search_ch == 'search'){
			$books = $pdo->get_all_var("SELECT *  FROM user  WHERE MATCH(username, fname)
AGAINST(? IN NATURAL LANGUAGE MODE)", $search);	
	}
	
	die(json_encode($books));
}

else {
	$search_ch = $_POST['search_ch'];
	$search = $_POST['search'];
	$subject = $_POST['subject'];
	
	$possible_ch = array("author_name", "title", "publisher", "subject");
	
	$pdo = new mypdo();
	
	if($search_ch == 'all'){
			$books = $pdo->get_all("SELECT a.*, b.fname, b.username FROM books a LEFT JOIN user b ON a.uid = b.id");	
	}
	elseif($search_ch == 'author_name'){
			$books = $pdo->get_all_var("SELECT  a.*, b.fname, b.username FROM books a LEFT JOIN user b ON a.uid = b.id  WHERE MATCH(a.author_name, a.joint_authors)
AGAINST(? IN NATURAL LANGUAGE MODE)", $search);	
	}
	elseif($search_ch == 'title'){
			$books = $pdo->get_all_var("SELECT  a.*, b.fname, b.username FROM books a LEFT JOIN user b ON a.uid = b.id  WHERE MATCH(a.title)
AGAINST(? IN NATURAL LANGUAGE MODE)", $search);	
	}
	elseif($search_ch == 'publisher'){
			$books = $pdo->get_all_var("SELECT  a.*, b.fname, b.username FROM books a LEFT JOIN user b ON a.uid = b.id  WHERE MATCH(a.publisher)
AGAINST(? IN NATURAL LANGUAGE MODE)", $search);	
	}
	elseif($search_ch == 'subject'){
			$books = $pdo->get_all_var("SELECT  a.*, b.fname, b.username FROM books a LEFT JOIN user b ON a.uid = b.id  WHERE MATCH(a.subject)
AGAINST(? IN NATURAL LANGUAGE MODE)", $subject);	
	}
	
	die(json_encode($books));
}

function get_url_content($url) {
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36");
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt( $ch, CURLOPT_MAXREDIRS, 5 );
		$content = curl_exec( $ch );
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ( $ch );	
		return $content;
}