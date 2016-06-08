<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/htdocs/common/utility.php';
	require '/var/www/maaatch.com/db_auth.php';
	login_redir('/login/', true);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Maaatches</title>
		<?php head_tags(); ?>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="matchlist.js"></script>
	</head>
	<body>
		<?php navbar("Maaatches", 0); ?>
		<main class="container">
            <h1><?php echo $_SESSION['name'] .'\'s Maaatches'; ?></h1><br/>
            <input type=text class="form-control" id="searchbar" placeholder="Search" autofocus>
            <section id="results">
            </section>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
