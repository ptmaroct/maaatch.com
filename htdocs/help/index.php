<?php
	session_start();
	/*include*/
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Help Page</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Help", 5); ?>
		<main class="container">
		</br></br></br><h1>How to use Maaatch.com</h1>
		<div class="container col-xs-12">
			<h5>
			To get you started, we at Maaatch.com wanted to give you an overview 
			of how you may use our website, along with the different services and
			features our website provides. Note that the majority of the pages found
			on the left of the navigation bar are available to both guests and users,
			while most of the functions made available only to users who have created 
			an account will be found in the dropdown menu on the right of the navigation
			bar after logging into your account. These features can be categorized as 
			such:			
			</h5>
		</div>
		<div class="container col-md-6">
			<h3>As a Guest</h3>
			<ul>
				<li>View goat profiles</li>
				<li>View user profiles</li>
				<li>Create an Account</li>
			</ul>
		</div>
		<div class="container col-md-6">
			<h3>With an Account</h3>
			<ul>
				<li>Do everything a guest can</li>
				<li>Log in and log out</li>
				<li>See what goats you <i>maaatch</i> with</li>
				<li>Order goats</li>
				<li>Add goats to your wishlist</li>
				<li>Post and remove goats</li>
				<li>View your orders/wishlist/goats posted</li>
			</ul>
		</div>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
