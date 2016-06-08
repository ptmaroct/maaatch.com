<?php
	session_start();
	require('/var/www/maaatch.com/db_auth.php');
	require('/var/www/maaatch.com/htdocs/common/utility.php');
    
    // update existing user data
	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('UPDATE users SET name_first = ?, name_last = ?, gender = ?, age = ?, location = ? WHERE user_id= ? ;');
	$stmt->bind_param('sssssi', $_POST['FName'], $_POST['LName'], $_POST['gender'], $_POST['age'], $_POST['location'], $_SESSION['user_id']);
	$stmt->execute();
    
    // update user goattributes
    $tags = array_values(
                array_filter(
                    array_keys($_POST),
                    function($d) use ($_POST) {
                        return substr($d, 0, 2) == 'ga';
                    }
                )
            );

	$stmt = $db->prepare('DELETE FROM user_goattributes WHERE user= ? ;');
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();

	foreach($tags as $tag) {
        $tag = intval(substr($tag, 2));
		$stmt = $db->prepare('INSERT INTO user_goattributes (user, goattribute) VALUES (?,?)');
		$stmt->bind_param('ii', $_SESSION['user_id'], $tag);
		$stmt->execute();
	}

    // create user data on disk
	$mydir = "/var/www/maaatch.com/sitedata/users/" . $_SESSION['user_id']; 
    if(!file_exists($mydir)) {
        mkdir($mydir, 0777, true);
    }
	$txt = $_POST['bio'];
	file_put_contents($mydir . "/bio", $txt);
	header("Location: /settings/");
?>
