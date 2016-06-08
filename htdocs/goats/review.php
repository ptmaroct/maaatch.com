<?php
	session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	
    // protect content from XSS attacks
    $sanitized_content = htmlspecialchars(substr($_POST['content'], 0, 255));
    // insert review data into table
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('INSERT INTO reviews(goat, user, stars, content)
                          VALUES (?,?,?,?);');
    $stmt->bind_param('iiis', $_GET['p'], $_SESSION['user_id'], $_POST['stars'], $sanitized_content);
    $stmt->execute();
	header('Location: /goats/profile.php?p=' . $_GET['p']);
?>
