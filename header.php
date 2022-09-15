<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <title>Solace Library</title>
</head>
<body>
    <header>
        <div class="top-header">
            <span id="covid-info">COVID-19 Information - <a href="https://www.who.int/health-topics/coronavirus#tab=tab_1" target="_blank">Overview</a> | <a href="https://www.who.int/health-topics/coronavirus#tab=tab_2" target="_blank">Prevention</a> | <a href="https://www.who.int/health-topics/coronavirus#tab=tab_3" target="_blank">Symptoms</a></span>
            <span id="header-contact">Contact SOL <a href="mailto:info@sol.city" target="_blank">&#9993; info@sol.city</a> | <a href="tel:0790XX1X000">&#9742; 0790XX1X000</a></span>
        </div>
        <div class="main-header">
            <a href="index.php"><img src="images/logo.png" alt="library logo" width="50" height="44"/> <span id="logo-text">Solace Library</span></a>
            <div class="nav-menu" id="navigator_hdvnk">
                <ul>
                    <li><a id="home_link" href="index.php">Home</a></li>
                    <li><a id="search_link" href="catalogue-search.php">Catalogue Search</a></li>
            
                    <?php if(isset($_SESSION['id'])) { ?>
                        <li><a id="recent_link" href="recent-activities.php">Recent Activities</a></li>
                        <li><a  id="books_link" href="user-books.php">My Books</a></li>
                        <li><a  id="addbook_link" href="add-book.php">Add Book</a></li>
                    <?php }
                    elseif(isset($_SESSION['admin'])) { ?>
                    <li><a id="search_link" href="<?php echo glob_site_url; ?>/admin">Books</a></li>
	                <li><a  id="users_link" href="<?php echo glob_site_url; ?>/admin/users.php"> Users</a></li>
                    <li><a id="adminsearch_link" href="admin">Admin</a></li>
                    <li><a id="logout_link" href="logout.php?logout=">Logout</a></li>
                    <?php } else { ?>
                        <li><a id="signup_link" href="guest.php?sign-up=">Sign up</a></li>
                        <li><a id="login_link" href="guest.php?login=">Login</a></li>
                    <?php } ?>
                    <?php if(isset($_SESSION['id'])) { ?>
                        <li><a href="profile.php" class="profile"><i class="avatar" style="background-image:url(<?php echo glob_site_url; ?>/uploads/profiles/<?php echo ($_SESSION['p'] == 'avatar.jpg')?$_SESSION['p']: $_SESSION['u'].'_'.$_SESSION['p']; ?>); width:30px; height:30px; vertical-align:middle;"></i> <?php echo $_SESSION['u']; ?></a></li>
                        <li><a href="logout.php?logout=">Logout</a></li>
                    <?php } ?>   
                </ul>
            </div>
        </div>
    </header>