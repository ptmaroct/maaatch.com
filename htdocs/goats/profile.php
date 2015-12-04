<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $stmt = $db->prepare('SELECT goat_id, name, age, gender FROM goats WHERE goat_id = ?;');
    $stmt->bind_param('s', $_GET['p']);
    $stmt->execute();
    $res = $stmt->get_result();
    if(!$res->num_rows) {
        header('Location: /goats/');
        die();
    }
    $goat = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $goat['name'] ?></title>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar($goat['name'], 2); ?>
		<main class="container">
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
