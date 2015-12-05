<?php
	session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);

    $stmt = $db->prepare('SELECT goat_id FROM goats WHERE name = ?;');
	$stmt->bind_param('s', $_POST['goatName']);
	$stmt->execute();
	$goat_id = $stmt->get_result()->fetch_assoc()['goat_id'];

	$address = $_POST['address'] . "\n" . $_POST['city'] . ', ' . $_POST['state'] . ' ' . $_POST['zip'];
    $stmt = $db->prepare('INSERT INTO orders(user, date, speed, address, goat)
                          VALUES (?,NOW(),?,?,?);');
    $stmt->bind_param('issi', $_SESSION['user_id'], $_POST['shipping'], $address, $goat_id);
    $stmt->execute();
	header('Location: /order/index.php');
?>
