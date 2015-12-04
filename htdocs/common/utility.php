<?php
	function ensalt($salt_pre) {
		return $salt_pre . strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
	}

	function login_redir($location, $should_be) {
		if($_SESSION['login'] != $should_be) {
			header("Location: " . $location);
            die();
		}
	}
    
    function img_to_b64($imgpath) {
        $image = file_get_contents($imgpath);
        $type = pathinfo($imgpath, PATHINFO_EXTENSION);
        return 'data:image/' . $type . ';base64,' . base64_encode($image);
    }
?>
