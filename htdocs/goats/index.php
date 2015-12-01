<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/utility.php';
    login_redir("/login/", true);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Goats</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Browse Goats", 2); ?>
		<main class="container">
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
