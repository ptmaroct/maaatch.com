<?php
	session_start();
	require('/var/www/maaatch.com/db_auth.php');
	require('/var/www/maaatch.com/htdocs/common/utility.php');

	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('UPDATE users SET name_first = ?, name_last = ?, gender = ?, age = ?, location = ? WHERE username= ? ;');
	$stmt->bind_param('ssssss', $_POST['FName'], $_POST['LName'], $_POST['gender'], $_POST['age'], $_POST['location'], $_SESSION['username']);
	$stmt->execute();

	$mydir = "sitedata/users/" . $_SESSION['user_id']; 
	mkdir($mydir, 0755, true);
//	$myfile = fopen("bio", "a") or die("Unable to open file"); 
	$txt = $_POST['bio'];
	file_put_contents($mydir . "bio", $txt);
//	fwrite($myfile2, $txt);
//	fclose($myfile2);
	header("Location: /settings/");
?>
