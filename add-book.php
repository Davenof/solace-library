<?php
session_start();

require './config/config.php';
require './config/functions.php';

$page_title = "Add Book | ". glob_site_name; ;
$active_link = "addbook"; 

include_once 'header.php';

?>

<main>

	<div class="container" style="padding-bottom:0px; clear:both">
        <h2 style="text-align:center">Add a Book</h2>
    </div>

    <section class="settings">
    <h6 class="hidden-heading">Slider</h6>
        <div class="container" style="text-align:center; padding-top:0px;">
            <div class="wrapper">
                <form onSubmit="add_book(event)" id="form">

                    <div class="form-group">
                        <label>Author's Name</label>
                        <input name="aname" required maxlength="50" minlength="3">
                    </div>
                    <div class="form-group">
                        <label>Joint Authors</label>
                        <input name="jname"  maxlength="200" minlength="3">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" required maxlength="150" minlength="3">
                    </div>
                    <div class="form-group">
                        <label>Subject Area</label>
                        <input required name="subject" list="subjectlist" multiple="multiple">
                    </div>
                    <div class="form-group">
                        <label>Publisher</label>
                        <input name="publisher" required maxlength="150" minlength="3">
                    </div>
                    <div class="form-group">
                        <label>Year of Publication</label>
                        <input type="number" max="2024" min="1240" name="pub_year" required>
                    </div>
                    <div class="form-group">
                        <label>Cover Photo</label>
                        <input required type="file" name="photo" accept="image/*">
                    </div>
                    
                    <div id="report" class="report"></div>

                    <div style="margin-top:30px;" id = "process_div">
                        <button class="btn-primary"><span class="fa fa-plus"></span> Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

<datalist id="subjectlist"><option value="Architecture"><option value="Art Instruction"><option value="Art History"><option value="Dance"><option value="Design"><option value="Fashion"><option value="Film"><option value="Graphic Design"><option value="Music"><option value="Music Theory"><option value="Painting"><option value="Photography"><option value="Bears"><option value="Cats"><option value="Kittens"><option value="Dogs"><option value="Puppies"><option value="Fantasy"><option value="Historical Fiction"><option value="Horror"><option value="Humor"><option value="Literature"><option value="Magic"><option value="Mystery and detective stories"><option value="Plays"><option value="Poetry"><option value="Romance"><option value="Science Fiction"><option value="Short Stories"><option value="Thriller"><option value="Young Adult"><option value="Biology"><option value="Chemistry"><option value="Mathematics"><option value="Physics"><option value="Programming"><option value="Management"><option value="Entrepreneurship"><option value="Business Economics"><option value="Business Success"><option value="Finance"><option value="Kids Books"><option value="Stories in Rhyme"><option value="Baby Books"><option value="Bedtime Books"><option value="Picture Books"><option value="Ancient Civilization"><option value="Archaeology"><option value="Anthropology"><option value="World War II"><option value="Social Life and Customs"><option value="Cooking"><option value="Cookbooks"><option value="Mental Health"><option value="Exercise"><option value="Nutrition"><option value="Self-help"><option value="Autobiographies"><option value="History"><option value="Politics and Government"><option value="World War II"><option value="Women"><option value="Kings and Rulers"><option value="Composers"><option value="Artists"><option value="Anthropology"><option value="Religion"><option value="Political Science"><option value="Psychology"><option value="Brazil"><option value="India"><option value="Indonesia"><option value="United States"><option value="History"><option value="Mathematics"><option value="Geography"><option value="Psychology"><option value="Algebra"><option value="Education"><option value="Business & Economics"><option value="Science"><option value="Chemistry"><option value="English Language"><option value="Physics"><option value="Computer Science"><option value="English"><option value="French"><option value="Spanish"><option value="German"><option value="Russian"><option value="Italian"><option value="Chinese"><option value="Japanese"></datalist> 
       
</main>

<?php
    include_once 'footer.php';
?>