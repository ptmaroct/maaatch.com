<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	
    // put goat information in table
    $datadir = '/var/www/maaatch.com/sitedata/goats/';
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
	$stmt = $db->prepare('INSERT INTO goats(name, gender, age, price, seller)
                          VALUES (?,?,?,?,?);');
    $stmt->bind_param('ssiii', $_POST['name'], $_POST['gender'], $_POST['age'], $_POST['price'], $_SESSION['user_id']);
    $stmt->execute();
    
	$stmt = $db->prepare('SELECT MAX(goat_id) FROM goats;');
    echo $db->error;
    $stmt->execute();
    $goatid = $stmt->get_result()+1;

    // update user goattributes
	foreach($_POST['goattributes'] as $goattrib) {
		$stmt = $db->prepare('INSERT INTO goat_goattributes (goat, goattribute) VALUES (?,?)');
		$stmt->bind_param('ii', $goatid, $goattrib);
		$stmt->execute();
	}

    // create bio on disk
    if($_POST['bio']) {
        $goatdir = $datadir . '/goat' . $db->insert_id;
        if(file_exists($goatdir) || mkdir($goatdir, 0777)) {
            file_put_contents($goatdir . '/bio', htmlspecialchars(substr($_POST['bio'],0,1024)));
        }
    }
	header('Location: /goats/profile.php?p=' . $db->insert_id);
?>
