<?php
	require '/var/www/maaatch.com/db_auth.php';
	require '/var/www/maaatch.com/htdocs/common/utility.php';
	
	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('SELECT username FROM users WHERE username = ?;');
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$res = $stmt->get_result();
	echo $res->num_rows?0:1;
?>
