<?php
session_start();

require './config/config.php';
require './config/functions.php';

$active_link = "recent";
$page_title = "Recent activities";

$pdo = new mypdo();

$books = $pdo->get_all("SELECT a.*, b.fname, b.username FROM books a LEFT JOIN user b ON a.uid = b.id ORDER BY date_added DESC LIMIT 12");
$users = $pdo->get_all("SELECT * FROM user ORDER BY reg_date DESC LIMIT 10");

include_once 'header.php';
?>

<main>
	<div class="container-activities">
        <?php 
            if(!(isset($_SESSION['id']) || isset($_SESSION['admin']))) { 
        ?>
            <p> 
                Thanks for coming around. Want to Share a book? <a href="guest.php?login=">Login</a> or 
            <a href="guest.php?sign-up=">Sign up</a> now!</p> 
        <?php
        }
        ?>
    </div>

    <h3 class="sub_heading">Recently Added Books</h3>
    <section class="posts">
        <h6 class="hidden-heading">Slider</h6>
        <div class="container main_book_body">
        
        <?php foreach($books as $book){  ?>
        	<div class="book">
        	<div class="main_content">
                <div class="cover" style="background-image:url(<?php echo glob_site_url; ?>/uploads/books/<?php echo get_cleaned_title($book['title']).$book['picture']; ?>);"></div>
                <div class="title"><?php echo $book['title']; ?></div>
                <div class="author"><span>Author:</span> <?php echo $book['author_name']; ?></div>
            </div>
            <div class="side_content">
            	<div class="added_by"><span>Added by:</span><a href="profile.php?u=<?php echo $book['username']; ?>"><?php echo $book['fname']; ?></a></div>
            	<table>
                	<tr><th>Author:</th><td><?php echo $book['author_name']; ?></td></tr>
                    <tr><th>Joint Authors:</th><td> <?php echo $book['joint_authors']; ?></td></tr>
                    <tr><th>Subject Area:</th><td><?php echo $book['subject']; ?></td></tr>
                    <tr><th>Publisher:</th><td><?php echo $book['publisher']; ?></td></tr>
                    <tr><th>Year of Publication:</th><td><?php echo $book['pub_year']; ?></td></tr>  
                </table>
            </div>
        </div>
        
        <?php } ?>
        </div>
    </section>
    
    <h3 class="sub_heading">Newly Registered Members</h3>
    <section>
        <h6 class="hidden-heading">Slider</h6>
    	<div class="container">
    		<?php foreach($users as $user){ ?>
                <div class="search_elm"><span class="avatar"  style="background-image:url(<?php echo glob_site_url; ?>/uploads/profiles/<?php echo ($user['picture'] == 'avater.jpg')?$user['picture'] : $user['username'].'_'.$user['picture']; ?>)"></span>
                <div class="name"><strong><a href="profile.php?u=<?php echo $user['username']; ?>"><?php echo $user['fname']; ?></a></strong><div class="age_s"><?php echo $user['city']; ?></div></div>
                <span class="add"><a href="profile.php?u=<?php echo $user['username']; ?>">view profile</a></span></div> 
            <?php } ?>
    	</div>
    </section>  
</main>

<?php
    include_once 'footer.php';
?>