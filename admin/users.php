<?php
session_start();

require '../config/config.php';
require '../config/functions.php';

$active_link = "users";

if(!isset($_SESSION['admin'])) {
    header("Location: ./login.php");
}


$page_title = "Users - ". glob_site_name;


include_once 'admin_header.php';

?>

<main>

 <div class="container" style="clear:both">
        <form onSubmit="search_users(event)">
            <div class="search_area">
                <select id="search_ch" autocomplete="off" onChange="update_search_selection(event, 'users')"><option selected value="search">Search</option> <option value="all" selected="selected">Show all Users</option></select>
                <select style="display:none" id="subject" style="display:none"></select>
                <input style="display:none" id="search" placeholder="Search user by name or username">
                <button style="display:none" type="submit" id="search_btn">Search</button>
            </div>
        </form>
    </div>
    
    <section class="">
        <div class="container main_book_body" id="main_search_body" style="min-height:300px;">

            <p style="text-align:center; background-color:#E4E4E4; width:100%; padding:30px; margin-top:20px;"> Search Users</p>
        </div>
    </section>



    <div id="delete_modal" style="z-index:4000; position:fixed; top:0px; left:0px; width:100vw; height:100vh; background-color:rgba(2,2,2,0.7); display:none; justify-content: center; align-items:center"><div style="background:#FFF; padding:20px; min-width:300px; min-height:200px;"><p style="margin-bottom:40px; border-bottom:1px solid #CCC; padding-bottom:20px;" id="delete_modal_msg"></p><div id="process_ediv"><button onClick="document.getElementById('delete_modal').style.display = 'none'" style="background-color:#CCC; color:#444; padding:7px 15px; border-radius:5px; cursor:pointer" id="delete_modal_cancel"><span class="fa fa-times"></span> Cancel</button><button style="float:right; background-color:#F00; color:#FFF; padding:7px 15px; border-radius:5px; cursor:pointer" id="delete_modal_delete"><span class="fa fa-trash-o"></span> Delete</button></div></div></div>
            
</main>
<script> var loadstarted = 'all_users';</script>
<?php
    include_once 'admin_footer.php';
?>