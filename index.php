<?php
	session_start();
	
	require './config/config.php';
	require './config/functions.php';
	
	$page_title = glob_site_name; 
    $active_link = "home";
	
	include_once 'header.php';
	
?>

    <main>
        <section class="home-banner">
            <h6 class="hidden-heading">Slider</h6>
            <div class="banner">
                <p id="banner-txt1">A little kindness could put <br>a smile on a Solacean's face.<br>Let's rebuild Solace City.</p>
                <p id="banner-txt2">Lend someone a book today.</p>
                <form action="guest.php?sign-up=" method="GET"><button id="banner-btn">JOIN NOW</button></form>
            </div>
        </section>  
        <section class="project-info">
            <h6 class="hidden-heading">Slider</h6>
            <p>After the flood of July 2021, fifty percent of Solace City recidents  <br>
                lost everything they worked hard for. Being the people's library, we have lauched a therapy project <br>
                we call "Bibliotherapy".
            </p>
        </section>
        <section class="bibliotherapy">
            <h6 class="hidden-heading">Slider</h6>
            <p class="biblio">How Does Bibliotherapy Work?</p>
            <p>
                With Bibliotherapy, we aim to give solace to flood victims by making books <br>
                they like to read available to them. All you have to do to help is <a href="guest.php?sign-up=">Sign up</a>, <a href="guest.php?login=">login</a>, complete your profile <br>
                with your correct information, add a book you are willing to lend when called upon, and someone will <br>
                get in touch with you when your book is needed. Thank you.
            </p>
        </section>
        <section class="img-columns"> 
            <h6 class="hidden-heading">Slider</h6>
            <div class="col-grid">
                <span class="col-img-text">Solace Flood</span><br>
                <a href="https://www.flickr.com/photos/tejvan/8239302356" target="_blank"><img src="images/flood.png" alt="Solace Flood" width="350" height="200"></a><br>
                <span class="attribution">Pettinger, T. (2012). Oxford Flood [Photograph]. Flickr. <a href="https://www.flickr.com/photos/tejvan/8239302356" target="_blank">https://www.flickr.com/photos/tejvan/8239302356</a></span>
            </div>

            <div class="col-grid">
                <span class="col-img-text">Lend a Book</span><br>
                <a href="https://www.verywellmind.com/what-is-bibliotherapy-4687157" target="_blank"><img src="images/bibliotherapy.png" alt="Lend a Book" width="350" height="200"></a><br>
                <span class="attribution">Lindberg, S. (2021). What Is Bibliotherapy? [Photograph]. Verywell Mind. <a href="https://www.verywellmind.com/what-is-bibliotherapy-4687157" target="_blank">https://www.verywellmind.com/what-is-bibliotherapy-4687157</a></span>
            </div>

            <div id="col-grid">
                <span class="col-img-text">Make People Happy</span><br>
                <a href="https://unsplash.com/s/photos/reading-time" target="_blank"><img src="images/happy-reading.png" alt="Make People Happy" width="350" height="200"></a><br>
                <span class="attribution">Danilina, A. (2019). Reading Time [Photograph]. Unsplash. <a href="https://unsplash.com/s/photos/reading-time" target="_blank">https://unsplash.com/s/photos/reading-time</a></span> 
            </div>
        </section>
    </main>
    
<?php
    include_once 'footer.php';
?>