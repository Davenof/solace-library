<?php
session_start();

require '../config/config.php';
require '../config/functions.php';

$active_link = "search";

if(!isset($_SESSION['admin'])) {
    header("Location: ./login.php");
}


$page_title = "Book Catalogue - ". glob_site_name;


include_once 'admin_header.php';

?>

<main>

 <div class="container" style="clear:both">
        <form onSubmit="search_books(event)">
            <div class="search_area">
                <select id="search_ch" onChange="update_search_selection(event)"><option value="author_name">Author Search</option><option value="title">Title Search</option><option value="subject">Subject Search</option><option value="publisher">Publisher Search</option><option selected="selected" value="all">Show all books</option></select>
                <input id="subject" style="display:none" list="subjectlist" placeholder="Enter Subject area">
                <input id="search" style="display:none" placeholder="author name search">
                <button type="submit" style="display:none" id="search_btn">Search</button>
            </div>
        </form>

    </div>

    <section class="">
        <div class="container main_book_body" id="main_search_body" style="min-height:300px;">

            <p style="text-align:center; background-color:#E4E4E4; width:100%; padding:30px; margin-top:20px;"> Search Books</p>
        </div>
    </section>



    
    <datalist id="subjectlist"><option value="Architecture"><option value="Art Instruction"><option value="Art History"><option value="Dance"><option value="Design"><option value="Fashion"><option value="Film"><option value="Graphic Design"><option value="Music"><option value="Music Theory"><option value="Painting"><option value="Photography"><option value="Bears"><option value="Cats"><option value="Kittens"><option value="Dogs"><option value="Puppies"><option value="Fantasy"><option value="Historical Fiction"><option value="Horror"><option value="Humor"><option value="Literature"><option value="Magic"><option value="Mystery and detective stories"><option value="Plays"><option value="Poetry"><option value="Romance"><option value="Science Fiction"><option value="Short Stories"><option value="Thriller"><option value="Young Adult"><option value="Biology"><option value="Chemistry"><option value="Mathematics"><option value="Physics"><option value="Programming"><option value="Management"><option value="Entrepreneurship"><option value="Business Economics"><option value="Business Success"><option value="Finance"><option value="Kids Books"><option value="Stories in Rhyme"><option value="Baby Books"><option value="Bedtime Books"><option value="Picture Books"><option value="Ancient Civilization"><option value="Archaeology"><option value="Anthropology"><option value="World War II"><option value="Social Life and Customs"><option value="Cooking"><option value="Cookbooks"><option value="Mental Health"><option value="Exercise"><option value="Nutrition"><option value="Self-help"><option value="Autobiographies"><option value="History"><option value="Politics and Government"><option value="World War II"><option value="Women"><option value="Kings and Rulers"><option value="Composers"><option value="Artists"><option value="Anthropology"><option value="Religion"><option value="Political Science"><option value="Psychology"><option value="Brazil"><option value="India"><option value="Indonesia"><option value="United States"><option value="History"><option value="Mathematics"><option value="Geography"><option value="Psychology"><option value="Algebra"><option value="Education"><option value="Business & Economics"><option value="Science"><option value="Chemistry"><option value="English Language"><option value="Physics"><option value="Computer Science"><option value="English"><option value="French"><option value="Spanish"><option value="German"><option value="Russian"><option value="Italian"><option value="Chinese"><option value="Japanese"></datalist> 
    
    <div id="delete_modal" style="z-index:4000; position:fixed; top:0px; left:0px; width:100vw; height:100vh; background-color:rgba(2,2,2,0.7); display:none; justify-content: center; align-items:center"><div style="background:#FFF; padding:20px; min-width:300px; min-height:200px;"><p style="margin-bottom:40px; border-bottom:1px solid #CCC; padding-bottom:20px;" id="delete_modal_msg"></p><div id="process_ediv"><button onClick="document.getElementById('delete_modal').style.display = 'none'" style="background-color:#CCC; color:#444; padding:7px 15px; border-radius:5px; cursor:pointer" id="delete_modal_cancel"><span class="fa fa-times"></span> Cancel</button><button style="float:right; background-color:#F00; color:#FFF; padding:7px 15px; border-radius:5px; cursor:pointer" id="delete_modal_delete"><span class="fa fa-trash-o"></span> Delete</button></div></div></div>
            
</main>
<script> var loadstarted = 'all_books';</script>
<?php
    include_once 'admin_footer.php';
?>