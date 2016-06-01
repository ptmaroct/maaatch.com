<?php
    // log user out
	session_start();
	session_unset();
	$_SESSION['login'] = false;
	header('Location: /lo_msg.php');
?>
