<?php
    session_start();
	require('/var/www/maaatch.com/db_auth.php');
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    $rem = array_map('intval', explode('|', $_POST['rem']));
    
    // for each set to remove, delete from database
    foreach($rem as $r) {
        $stmt = $db->prepare('DELETE FROM wishlist WHERE user = ? AND goat = ?;');
        $stmt->bind_param('ii', $_SESSION['user_id'], $r);
        $stmt->execute();
    }
?>
