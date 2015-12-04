
<?php
	session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	require '/var/www/maaatch.com/htdocs/common/utility.php';

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('SELECT goat_id FROM goats WHERE name = ?;');
	$stmt->bind_param('s', $_GET['n']);
	$stmt->execute();
	$goat_id = $stmt->get_result()->fetch_assoc()['goat_id'];
	$address = $_POST['address'] . ' ' . $_POST['city'] . ' ' . $_POST['state'] . ' ' . $_POST['zip'];
    $stmt = $db->prepare('INSERT INTO orders(user, date, shipping, address, goat) VALUES (?,?,?,?);');
    $stmt->bind_param('isssi', $_SESSION['user_id'], $_POST['date'], $_POST['shipping'], $address, $goat_id);
    $stmt->execute();
	error_log($stmt->error);
	header('Location: /order/orderpage.php');
	die();
?>
