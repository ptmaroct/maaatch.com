<?php
	session_start();
	require('/var/www/maaatch.com/db_auth.php');
	require('/var/www/maaatch.com/htdocs/common/utility.php');

	$salt = ensalt($crypt_pre);
	$hash = crypt($_POST['password'], $salt);

	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('INSERT INTO users (username, name_first, name_last, pw_hash, pw_salt) VALUES (?,?,?,?,?);');
	$stmt->bind_param('sssss', $_POST['username'], $_POST['firstname'], $_POST['lastname'], $hash, $salt);
	$stmt->execute();
	
	$stmt = $db->prepare('SELECT user_id, username, name_first, name_last FROM users WHERE username = ?;');
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$user = $stmt->get_result()->fetch_assoc();
	
	$_SESSION['login'] = true;
	$_SESSION['user_id'] = $user['user_id'];
	$_SESSION['username'] = $user['username'];
	$_SESSION['name'] = $user['name_first'] . ' ' . $user['name_last'];
	
	header('Location: /');
?>
