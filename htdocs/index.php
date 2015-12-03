<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Welcome</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Welcome", 1); ?>
		<main class="container">
			<article class="welcome-text">
				<h1>Welcome to Maaatch.com!</h1>
				<p class="lead">Your first choice in mail-order goats.</p>
                <img class="img-rounded" id="goatpic" src="images/goat-small.jpg" alt="goat"/>
				<p class="lead">
                    We provide a dating-site feature set to match you with the goat
					of your dreams. Users will be able to create a profile, browse
					goats profiles, and view their goat matches, chosen by our
					proprietary maaatching al<i>goat</i>rithm. Once a user selects
					a goat, they will be able to place an order or add to their
					wish list. Allow 4 to 6 weeks for delivery.
				</p>
			</article>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
