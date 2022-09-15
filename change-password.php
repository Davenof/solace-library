<?php
session_start();

require './config/config.php';
require './config/functions.php';

if(!isset($_SESSION['id'])) die(header('Location: ./'));

$active_link = "profile";
$page_title = "Change password | ".glob_site_name;

include_once 'header.php';

?>

<main>
    <section class="settings" style=" clear:both">
        <div class="container" style="text-align:center; padding-top:0px;">
            <p style="text-align:left;"><a href="profile.php">Back to Profile</a></p>
            <div class="wrapper">
				<h3><span class="fa fa-lock"></span> Change Password</h3>
                <form onSubmit="update_settings('update_password', event)" id="form">

                    <div class="form-group">
                        <input type="password" style="display:none">
                        <label>Old Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password1" required minlength="6">
                    </div>
                    <div class="form-group">
                        <label>Retype New Password</label>
                        <input type="password" name="password2" required>
                    </div>

                    <div id="report" class="report"></div>

                    <div style="margin-top:30px;" id="process_div">
                        <button class="btn-primary">Update </button>
                    </div>
                </form>
            </div>
        </div>
    </section>  
</main>

<?php
    include_once 'footer.php';
?>