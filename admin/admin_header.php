<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/phpglobal.css">
    <title><?php echo $page_title; ?></title>
</head>
<body>
    <header>
        <div class="top-header">
            <span id="covid-info">COVID-19 Information - <a href="https://www.who.int/health-topics/coronavirus#tab=tab_1" target="_blank">Overview</a> | <a href="https://www.who.int/health-topics/coronavirus#tab=tab_2" target="_blank">Prevention</a> | <a href="https://www.who.int/health-topics/coronavirus#tab=tab_3" target="_blank">Symptoms</a></span>
            <span id="header-contact">Contact SOL <a href="mailto:info@sol.fake" target="_blank">&#9993; info@sol.fake</a> | <a href="tel:0790XX1X000">&#9742; 0790XX1X000</a></span>
        </div>
        <div class="main-header">
            <a href="../index.php"><img src="../images/logo.png" alt="library logo" width="50" height="44"/> <span id="logo-text"> Solace Library</span></a>
        </div>
        <div class="nav-menu" id="navigator_hdvnk" data-active="<?php echo @$active_link; ?>">
            <ul>
               
                <li><a id="home_link" href="../index.php">Home</a></li>
                <li><a id="search_link" href="https://2014715.linux.studentwebserver.co.uk/admin/"> Books </a></li>
	           <li><a  id="users_link" href="https://2014715.linux.studentwebserver.co.uk/admin/users.php"> Users</a></li>
            
            </ul>
        </div>
    </header>