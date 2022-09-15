<?php
session_start();

if(isset($_GET['sign-up']))
	$active_link = "signup";
elseif(isset($_GET['login']))
	$active_link = "login";
else{
	$_GET['sign-up'] = ' ';
	$active_link = "signup";
	}

if (isset($_SESSION['id'])) {
    header("Location: ./");
}


require './config/config.php';
require './config/functions.php';


$page_title = ((isset($_GET['sign-up']))?'Sign up' : 'Login '). ' | ' .glob_site_name; 

include_once 'header.php';

?>

<main>
    <div class="container-guest">
        <h2>
		    <?php if(isset($_GET['sign-up']))
                 echo 'Sign up';
                else
				 echo 'Login';
		    ?>
        </h2>
    </div>
    
    <?php if(isset($_GET['sign-up'])) { ?>

    <section class="settings">
        <h6 class="hidden-heading">Slider</h6>
        <div class="container-guest" >
            <div class="wrapper">
                <form onSubmit="sign_up(event)" id="form">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input name="fname" required maxlength="50" minlength="3">
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input name="email" type="email" required>
                    </div>
                    <br>
                    Login Details

                    <hr>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" pattern="[a-zA-Z0-9_]{3,20}" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" name="password" placeholder="Not less than six characters" required>
                    </div>
                    <div class="form-group">
                        <label>Retype Password</label>
                        <input type="password" id="password2" name="password2" required>
                    </div>
                    <div id="report" class="report">

                    </div>
                    <div class="form-group-btn" id="process_div">
                        <button class="btn-primary">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    <?php }else{ ?>
            <section class="settings">
                <h6 class="hidden-heading">Slider</h6>
                <div class="container-guest">
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
                            <div class="form-group-btn" id="process_div">
                                <button class="btn-primary">Login</button>
                            </div>
                        </form>
                        <div class="form-group-btn"><a href="admin/login.php"> Login as Admin</a></div>
                    </div>
                </div>
            </section>
    <?php } ?>        
</main>

<?php
    include_once 'footer.php';
?>