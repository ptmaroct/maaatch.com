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
    
	$goatid = $db->insert_id;

    // update goattributes
    $tags = array_values(
                array_filter(
                    array_keys($_POST),
                    function($d) use ($_POST) {
                        return substr($d, 0, 2) == 'ga';
                    }
                )
            );
	foreach($tags as $tag) {
        $tag = intval(substr($tag, 2));
		$stmt = $db->prepare('INSERT INTO goat_goattributes (goat, goattribute) VALUES (?,?)');
		$stmt->bind_param('ii', $goatid, $tag);
		$stmt->execute();
	}

    // create bio on disk
    if($_POST['bio']) {
        $goatdir = $datadir . '/goat' . $goatid;
        if(file_exists($goatdir) || mkdir($goatdir, 0777)) {
            file_put_contents($goatdir . '/bio', htmlspecialchars(substr($_POST['bio'],0,1024)));
        }
    }
	header('Location: /goats/profile.php?p=' . $goatid);
?>
