<?php
// head tags
function head_tags() {
echo '
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="index.css">
<link rel="shortcut icon" href="/favicon.png">
';
}
    
function navelem($name, $url, $active) {
echo '<li';
echo (($active)?' class="active"':'').'>';
echo '<a href="'.$url.'">'.$name.'</a></li>
';
}

function navbar($title, $active) {
// nav header
echo '
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">'.$title.'</a>
        </div>';

// nav links
echo '  <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
';
                navelem("Home",   "/",      $active == 1);
                navelem("Goats",  "/goats/", $active == 2);
                navelem("Users",  "/usersearch/", $active == 3);
                navelem("About Us",  "/about/", $active == 4);
                navelem("Help",  "/help/", $active == 5);
echo '</ul>';

// right side
echo '
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        ' . ((isset($_SESSION['login']) && $_SESSION['login'])?$_SESSION['name']:'Account') . '<span class="caret"></span></a>
            <ul class="dropdown-menu">
';
                if(isset($_SESSION['login']) && $_SESSION['login']) {
                    navelem("My Profile", "/settings/",    False);
                    navelem("My Orders",   "/order/", False);
                    navelem("My Wishlist", "/wishlist/",   False);
                    navelem("My Maaatches", "/matches/",   False);
					navelem("My Goats Posted", "/post/postlist.php", False);
                    navelem("Post a Goat", "/post/",   False);
                    echo '<li role="separator" class="divider"></li>';
                    navelem("Log out",  "/login/logout.php",           False);
                }
                else {
                    navelem("Sign up", "/register/", False);
                    echo '<li role="separator" class="divider"></li>';
                    navelem("Log in",  "/login/",    False);
                }
echo '              </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
';
}

// JS needed by bootstrap
function bootstrap_js() {
echo '
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" crossorigin="anonymous"></script>
';
}
?>
