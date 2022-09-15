<?php
	session_start();
	
	if (isset($_SESSION['id']))
		$uid = $_SESSION['id'];
	else
		$uid = 0;
	
	if (!isset($_GET['u']) && !isset($_SESSION['id']))
		die(header('Location: ./'));
	
	if(!isset($_GET['u'])){
		$username = 'me';
	}
	else{
		$username = $_GET['u'];	
	}
	
	require './config/config.php';
	require './config/functions.php';
	
	$pdo = new mypdo();
	
	if ($username == 'me')
		$user = $pdo->get_user('id', $uid);
	else
		$user = $pdo->get_user('username', $username);
	
	if ($user == null)
		die(header('Location: ./'));
	
	$this_uid =  $user['id'];
	
	$books_added = $pdo->get_one("SELECT COUNT(*) AS cnt FROM books WHERE uid = $this_uid");
	$books_cnt = $books_added['cnt'];
	
	$page_title = $user['fname']." profile";
    include_once 'header.php';

?>

<main>
	    <section class="profile" style="clear:both">
        <div class="container" style="padding-top:20px;">
        <?php if(($uid == $this_uid) && ($user['address'] == '' || $user['picture'] == 'avatar.jpg')){ ?>
        <div id="profile_need_update" class="profile_update"><span class="fa fa-info-circle"></span> Incomplete profile. <br><ul> <?php if($user['address'] == ''){ ?><li id="profile_need_update_a">Please complete your profile</li> <?php } if($user['picture'] == 'avatar.jpg'){ ?> <li id="profile_need_update_b">Upload profile image </li><?php } ?></ul></div>
        <?php }?>
        
            <div class="flex_wrapper">
            
            	<div  class="profile_cside">
                    <div class="profile_side">
                        <?php if ($uid == $this_uid) { ?>
                        
                            <button class="upload_btn"   id="upload_btn" onClick="document.getElementById('photo').click();"><span class="fa fa-camera"></span> Change</button><br />
                            <form id="form2" style="display:none"><input onChange="update_photo('update_photo')" id="photo" type="file" name="photo"><input type="hidden"></form>
    
                        <?php } ?>
                        
                        <img  id="photo_avatar" src="./uploads/profiles/<?php echo ($user['picture'] == 'avatar.jpg')? $user['picture'] : $user['username'] . '_' . $user['picture']; ?>">
                        
                        
                        <div class="username"><?php echo $user['username']; ?> </div>
                        
                        <h1><a href="user-books.php?u=<?php echo $user['username']; ?>"><?php echo $books_cnt; ?> <span>Book(s) added</span></a></h1>
                        
                        <?php if ($uid == $this_uid) { ?>
    						<div class="change_password"><a href="change-password.php"><span class="fa fa-lock"></span> Change Password</a></div>
                            <div class="delete_account"><a style="cursor:pointer" onClick="delete_account(<?php echo $user['id']; ?>, 0)"><span class="fa  fa-trash"></span> Delete Account</a></div>
                        <?php } ?>
                        
                    </div>
                    
                </div>
                <div class="profile_cmain">
                     	<h3 class="profile_name"><?php echo $user['fname']; ?> 
                         <?php if ($uid == $this_uid) { ?>
   								 <span class="pull-right"><a style="display:none" id="pedite_c" onClick="profile_mode(1)" class="fa fa-times"> Cancel</a> <a id="pedite_o" onClick="profile_mode(0)" class="fa fa-edit"> Edit </a></span> 
                        <?php } ?>
                        </h3>
                        <form onSubmit="update_settings('update_profile', event)" id="form">

                            <div class="form-group">
                                <label><span class="fa fa-user"></span>  Full Name</label>
                                <input readonly name="fname" id="fname" required maxlength="50" minlength="3" value="<?php echo $user['fname']; ?>">
                            </div>
                            <div class="form-group">
                                <label><span class="fa fa-envelope"></span> Email</label>
                                <input readonly name="email" id="email" type="email" required value="<?php echo $user['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label><span class="fa fa-phone"></span> Phone</label>
                                <input readonly name="phone" id="phone" type="tel" value="<?php echo $user['phone']; ?>">
                            </div>
                            <div class="form-group">
                                <label><span class="fa fa-address-card-o"></span> House Address</label>
                                <input readonly name="address" id="address"  required value="<?php echo $user['address']; ?>">
                            </div>
                            <div class="form-group">
                                <label><span class="fa fa-address-card"></span> City</label>
                                <input readonly name="city" id="city" required value="<?php echo $user['city']; ?>">
                            </div>
        
                            <div id="report" class="report"></div>
        
                            <div style="margin-top:30px; display:none" id="process_div">
                                <button class="btn-primary"><span class="fa fa-save"></span> Update Profile</button>
                            </div>
        
                        </form>
                  
                 </div>
            </div>
        </div>
    </section>


<div id="delete_modal" style="z-index:4000; position:fixed; top:0px; left:0px; width:100vw; height:100vh; background-color:rgba(2,2,2,0.7); display:none; justify-content: center; align-items:center"><div style="background:#FFF; padding:20px; min-width:300px; max-width:500px; min-height:200px;"><p style="margin-bottom:40px; border-bottom:1px solid #CCC; padding-bottom:20px;" id="delete_modal_msg"></p><div id="process_ediv"><button onClick="document.getElementById('delete_modal').style.display = 'none'" style="background-color:#CCC; color:#444; padding:7px 15px; border-radius:5px; cursor:pointer" id="delete_modal_cancel"><span class="fa fa-times"></span> Cancel</button><button style="float:right; background-color:#F00; color:#FFF; padding:7px 15px; border-radius:5px; cursor:pointer" id="delete_modal_delete"><span class="fa fa-trash-o"></span> Delete</button></div></div></div>

        
</main>

<?php
    include_once 'footer.php';
?>