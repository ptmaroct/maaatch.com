<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Logged out</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<main class="container">
			<article class="welcome-text">
				<h1>You have been successfully logged out.</h1>
				<p class="lead"><a href="/">Click here</a> to return
				to the main site.</p>
			</article>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
