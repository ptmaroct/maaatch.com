<?php
	require '/var/www/maaatch.com/db_auth.php';
	require '/var/www/maaatch.com/htdocs/common/utility.php';
	
    // check if goat exists by name, return 0 or 1
	$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('SELECT goat_id FROM goats WHERE name = ?;');
	$stmt->bind_param('s', $_POST['goat']);
	$stmt->execute();
	$res = $stmt->get_result();
	echo $res->num_rows?1:0;
?>
