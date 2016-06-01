<?php
	session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	
    // insert review data into table
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('INSERT INTO reviews(goat, user, stars, content)
                          VALUES (?,?,?,?);');
    $stmt->bind_param('iiis', $_GET['p'], $_SESSION['user_id'], $_POST['stars'], $_POST['content']);
    $stmt->execute();
	header('Location: /goats/profile.php?p=' . $_GET['p']);
?>
