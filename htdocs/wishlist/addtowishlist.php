
<?php
	session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	require '/var/www/maaatch.com/htdocs/common/utility.php';

	if(isset($_GET['g'])) {
		$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
		$gstmt = $db->prepare('INSERT INTO wishlist VALUES (?,?);');
		$gstmt->bind_param('is', $_SESSION['user_id'], $_GET['g']);
		$gstmt->execute();
		header('Location: /wishlist/');
	}
?>
