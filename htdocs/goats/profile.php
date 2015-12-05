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
    
    $stmt = $db->prepare('SELECT goattributes.name AS goattribute FROM goats
                          RIGHT JOIN goat_goattributes
                          ON goats.goat_id = goat_goattributes.goat
                          LEFT JOIN goattributes
                          ON goat_goattributes.goattribute = goattributes.goattribute_id
                          WHERE goats.goat_id = ?
                          ORDER BY goattributes.goattribute_id;');
    $stmt->bind_param('i', $goat['goat_id']);
    $stmt->execute();
    $res = $stmt->get_result();
    $gattr = array();
    while($x = $res->fetch_assoc()) {
        array_push($gattr, $x['goattribute']);
    }
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
			<div class="">
				<?php
					$profile_pic = '/var/www/maaatch.com/sitedata/goats/goat' . $goat['goat_id'] . '/profile.jpg';
					$bio = file_get_contents('/var/www/maaatch.com/sitedata/goats/goat' . $goat['goat_id'] . '/bio');
					echo '<img class="img-responsive pull-left" id="goatpic" src="';
					if(file_exists($profile_pic)) {
						echo img_to_b64($profile_pic);
					} else {
						echo '/images/generic_gprofile.jpg'; 
					}	    
					echo '" alt="profile_pic"/>';
					echo '<div class="pull-left" id="profbody">';
					echo '<h1 class="page-header">' . $goat['name'] . '</h1>';
                    echo '<i>' . ucfirst($goat['gender']) . '</i><br/>';
                    echo '<b>Age:</b> ' . $goat['age'] . '<br/>';
					echo '<b>Price:</b> $' . $goat['price'] . '<br/><br/>';
					echo '<a class="btn btn-lg btn-primary" href="/order/orderpage.php?g=' . $goat['goat_id'] . '" role="button">Click to Order</a><br/><br/>';
					echo '<a class="btn btn-lg btn-primary" href="/wishlist/addtowishlist.php?g=' . $goat['goat_id'] . '" role="button">Add to Wishlist</a><br/>';
					echo '<br/><br/>' . $bio;
                    echo '<div id="tags">';
                        foreach($gattr as $g) {
                            echo '<button class="btn">' . $g . '</button>';
                        }
                    echo '</div>';
                    echo '</div>';
				?>
			</div>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
