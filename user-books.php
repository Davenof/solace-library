<?php
session_start();

require './config/config.php';
require './config/functions.php';

if (isset($_SESSION['id']))
    $uid = $_SESSION['id'];
else
    $uid = 0;

if (!isset($_GET['u']) && !isset($_SESSION['id']))
    die(header('Location: ./'));

if(!isset($_GET['u'])){
	$username = 'me';
	$active_link = "books";
}
else{
	$username = $_GET['u'];	
}

$pdo = new mypdo();

if ($username == 'me')
    $user = $pdo->get_user('id', $uid);
else
    $user = $pdo->get_user('username', $username);

if ($user == null)
    die(header('Location: ./'));

$this_uid =  $user['id'];

$books = $pdo->get_all("SELECT * FROM books WHERE uid = $this_uid ORDER BY date_added DESC");

$page_title = "Books added by " .$user['fname'];
$active_link = "books"; 

include_once 'header.php';

?>

<main>
    <h3 class="sub_heading">Books added by <?php echo ($uid == $this_uid)? 'you' : $user['fname']; ?></h3>
    <section class="posts">
        <h6 class="hidden-heading">Slider</h6>
        <div class="container main_book_body">
        
        <?php foreach($books as $book) {  ?>
        	<div class="book" id="book_<?php echo $book['id'];?>">
        	<div class="main_content">
                <div class="cover" style="background-image:url(<?php echo glob_site_url; ?>/uploads/books/<?php echo get_cleaned_title($book['title']).$book['picture']; ?>);"></div>
                <div class="title"><?php echo $book['title']; ?></div>
                <div class="author"><span>Author:</span> <?php echo $book['author_name']; ?></div>
            </div>
            <div class="side_content">
            	<table>
                	<tr><th>Author:</th><td><?php echo $book['author_name']; ?></td></tr>
                    <tr><th>Joint Authors:</th><td> <?php echo $book['joint_authors']; ?></td></tr>
                    <tr><th>Subject Area:</th><td><?php echo $book['subject']; ?></td></tr>
                    <tr><th>Publisher:</th><td><?php echo $book['publisher']; ?></td></tr>
                    <tr><th>Year of Publication:</th><td><?php echo $book['pub_year']; ?></td></tr>
                </table>
                <?php if($uid == $this_uid){ ?>
                <div class="edit_area"><a class="fa fa-edit" href="update-book.php?bid=<?php echo $book['id']; ?>"> Edit</a> <a class="fa fa-trash-o pull-right" onClick="delete_book(<?php echo $book['id']; ?>, 0)"> Delete</a></div>
                <?php } ?>
            </div>
        </div>
        
        <?php }
		if(count($books) == 0) { ?>
		 
         <p class="count_books"><?php echo $user['fname']; ?> has not added any book yet.</p>
         
        <?php } ?>
        </div>
    </section> 
    
    <div id="delete_modal">
        <div class="delete_modal_style"><p id="delete_modal_msg"></p>
            <div id="process_ediv">
                <button onClick="document.getElementById('delete_modal').style.display = 'none'" id="delete_modal_cancel">
                <span class="fa fa-times"></span> Cancel</button>
                <button id="delete_modal_delete">
                <span class="fa fa-trash-o"></span> Delete</button>
            </div>
        </div>
    </div>    
</main>

<?php
    include_once 'footer.php';
?>