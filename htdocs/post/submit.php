<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	
    $datadir = '/var/www/maaatch.com/sitedata/goats/';
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('INSERT INTO goats(name, gender, age, price, seller)
                          VALUES (?,?,?,?,?);');
    $stmt->bind_param('ssiii', $_POST['name'], $_POST['gender'], $_POST['age'], $_POST['price'], $_SESSION['user_id']);
    $stmt->execute();
    
    if($_POST['bio']) {
        $goatdir = $datadir . '/goat' . $db->insert_id;
        if(file_exists($goatdir) || mkdir($goatdir, 0777)) {
            file_put_contents($goatdir . '/bio', htmlspecialchars(substr($_POST['bio'],0,1024)));
        }
    }
	header('Location: /goats/profile.php?p=' . $db->insert_id);
?>
