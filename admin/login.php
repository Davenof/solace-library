<?php
session_start();

require '../config/config.php';
require '../config/functions.php';

$active_link = "login";

if (isset($_SESSION['admin'])) {
    header("Location: ./");
}

$page_title = "Admin login - ". glob_site_name;


include_once 'admin_header.php';

?>

<main>

 <div class="container" style="text-align:center; padding-bottom:0px; clear:both">

        <h2 style="text-align:center">Admin Login</h2>

    </div>
           
    <section class="settings">
        <div class="container" style="text-align:center; padding-top:0px;">
            <div class="wrapper">
                <form onSubmit="sign_in(event)" id="form">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" pattern="[a-zA-Z0-9_]{3,20}" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div id="report" class="report"></div>

                    <div style="margin-top:30px; text-align:" id="process_div">
                        <button class="btn-primary">Login</button>
                    </div>

                </form>

            </div>
        </div>
    </section>
            
</main>

<?php
    include_once 'admin_footer.php';
?>