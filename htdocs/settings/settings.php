<?php
	session_start();
	require('/var/www/maaatch.com/db_auth.php');
	require('/var/www/maaatch.com/htdocs/common/utility.php');

	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('UPDATE users SET name_first = ?, name_last = ?, gender = ?, age = ?, location = ? WHERE username= ? ;');
	$stmt->bind_param('ssssss', $_POST['FName'], $_POST['LName'], $_POST['gender'], $_POST['age'], $_POST['location'], $_SESSION['username']);
	$stmt->execute();

//	$mydir = "sitedata/users/" . $_SESSION['user_id']; 
//	mkdir($mydir, 0755, true);
	$goatfile = file_get_contents("../../sitedata/goats/goat7/bio") or die("php sucks");
//	$myfile = fopen("bio", "w") or die("Unable to open file"); 
//	$txt = $_POST['bio'];
//	fwrite($myfile, $txt);
//	fclose($myfile);
	header("Location: /settings/");
?>
