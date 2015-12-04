<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Goats</title>
		<?php head_tags(); ?>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="goatsearch.js"></script>
	</head>
	<body>
		<?php navbar("Search Goats", 2); ?>
		<main class="container">
            <!-- search bar with ajax call to database -->
            <input type=text class="form-control" id="searchbar" placeholder="Search" autofocus>
            <section id="results">
            </section>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
