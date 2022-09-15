<?php
session_start();

require './config/config.php';
require './config/functions.php';

$page_title = "Catalogue Search -  ". glob_site_name; ;
$active_link = "search";

include_once 'header.php';
?>

<main>
	<div class="search-bar-container">
        <form onSubmit="search_books(event)">
        <p>Search books in <?php echo glob_site_name;?> catalogue or select "Search Open Library" <br> from the dropdown menu to search the <a href="https://openlibrary.org/" target="_blank">Open Library</a> catalogue </p>
            <div class="search_area">
                <select id="search_ch" onChange="update_search_selection(event)"><option value="author_name">Author Search</option>
                <option value="title">Title Search</option><option value="subject">Subject Search</option>
                <option value="publisher">Publisher Search</option><option selected="selected" value="all">Show all books</option>
                <option value="openlibrary">Search Open Library</option></select>
                <input id="subject" list="subjectlist" placeholder="Enter subject area">
                <input id="search" placeholder="Enter author name">
                <button type="submit" id="search_btn">Search</button>
            </div>
        </form>
    </div>

    <section class="search-display">
    <h6 class="hidden-heading">Slider</h6>
        <div class="container main_book_body" id="main_search_body">
            
        </div>
    </section>

    <datalist id="subjectlist">
        <option value="Architecture"><option value="Art Instruction"><option value="Art History"><option value="Dance"><option value="Design"><option value="Fashion"><option value="Film"><option value="Graphic Design"><option value="Music"><option value="Music Theory"><option value="Painting"><option value="Photography"><option value="Bears"><option value="Cats"><option value="Kittens"><option value="Dogs">
        <option value="Puppies"><option value="Fantasy"><option value="Historical Fiction"><option value="Horror"><option value="Humor"><option value="Literature"><option value="Magic"><option value="Mystery and detective stories"><option value="Plays"><option value="Poetry"><option value="Romance"><option value="Science Fiction"><option value="Short Stories"><option value="Thriller"><option value="Young Adult">
        <option value="Biology"><option value="Chemistry"><option value="Mathematics"><option value="Physics"><option value="Programming"><option value="Management"><option value="Entrepreneurship"><option value="Business Economics"><option value="Business Success"><option value="Finance"><option value="Kids Books"><option value="Stories in Rhyme"><option value="Baby Books"><option value="Bedtime Books">
        <option value="Picture Books"><option value="Ancient Civilization"><option value="Archaeology"><option value="Anthropology"><option value="World War II"><option value="Social Life and Customs"><option value="Cooking"><option value="Cookbooks"><option value="Mental Health"><option value="Exercise"><option value="Nutrition"><option value="Self-help"><option value="Autobiographies"><option value="History">
        <option value="Politics and Government"><option value="World War II"><option value="Women"><option value="Kings and Rulers"><option value="Composers"><option value="Artists"><option value="Anthropology"><option value="Religion"><option value="Political Science"><option value="Psychology"><option value="Brazil"><option value="India"><option value="Indonesia"><option value="United States"><option value="History">
        <option value="Mathematics"><option value="Geography"><option value="Psychology"><option value="Algebra"><option value="Education"><option value="Business & Economics"><option value="Science"><option value="Chemistry"><option value="English Language"><option value="Physics"><option value="Computer Science"><option value="English"><option value="French"><option value="Spanish"><option value="German">
        <option value="Russian"><option value="Italian"><option value="Chinese"><option value="Japanese">
    </datalist>  
</main>

<script> var loadstarted = 'all_books'; </script>

<?php
    include_once 'footer.php';
?>