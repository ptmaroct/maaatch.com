<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	require '/var/www/maaatch.com/htdocs/common/utility.php';

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $stmt = $db->prepare('SELECT goat_id, price, name, age, gender FROM goats WHERE goat_id = ?;');
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
			<div class="row">
				<?php
					$profile_pic = '/var/www/maaatch.com/sitedata/goats/goat' . $goat['goat_id'] . '/profile.jpg';
					$bio = file_get_contents('/var/www/maaatch.com/sitedata/goats/goat' . $goat['goat_id'] . '/bio');
					echo '<img class="col-xs-4 img-responsive" id="goatpic" src="';
					if(file_exists($profile_pic)) {
						echo img_to_b64($profile_pic);
					} else {
						echo '/images/generic_gprofile.jpg'; 
					}	    
					echo '" alt="profile_pic"/>';
					echo '<h1 class="page-header" class="col-xs-8">' . $goat['name'] . '</h1>';
					echo '<p class="col-xs-8">';
                    echo '<i>' . ucfirst($goat['gender']) . '</i><br/>';
                    echo '<b>Age:</b> ' . $goat['age'] . '<br/>';
					echo '<b>Price:</b> $' . $goat['price'] . '<br/><br/>';
					echo '<a class="btn btn-lg btn-primary" href="/order/orderpage.php?g=' . $goat['goat_id'] . '" role="button">Click to Order</a><br/><br/>';
					echo '<a class="btn btn-lg btn-primary" href="/wishlist/addtowishlist.php?g=' . $goat['goat_id'] . '" role="button">Add to Wishlist</a><br/>';
					echo '<br/><br/>' . $bio . '</p>';
				?>
			</div>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
