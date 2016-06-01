<?php
	session_start();
	require('/var/www/maaatch.com/db_auth.php');
	require('/var/www/maaatch.com/htdocs/common/utility.php');
	
    // fetch user data for current user
	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('SELECT user_id, username, name_first, name_last, pw_hash, pw_salt FROM users WHERE username = ?;');
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$user = $stmt->get_result()->fetch_assoc();
	
    // log user in if authenticated
	if($user && crypt($_POST['password'], $user['pw_salt']) == $user['pw_hash']) {
		$_SESSION['login'] = true;
		$_SESSION['user_id'] = $user['user_id'];
		$_SESSION['username'] = $user['username'];
		$_SESSION['name'] = $user['name_first'] . ' ' . $user['name_last'];
		header("Location: /");
	} else {
		header("Location: /login/?badlogin");
	}
?>
