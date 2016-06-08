<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	require '/var/www/maaatch.com/htdocs/common/utility.php';
    
    // fetch goat's info and place into array
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $stmt = $db->prepare('SELECT goat_id, price, name, goats.age, goats.gender, users.username as selleruname, CONCAT(users.name_first, " ", users.name_last) AS sellername FROM goats LEFT JOIN users ON goats.seller = users.user_id WHERE goat_id = ?;');
    $stmt->bind_param('s', $_GET['p']);
    $stmt->execute();
    $res = $stmt->get_result();
    if(!$res->num_rows) {
        // if goat doesn't exist, go to main goat page
        header('Location: /goats/');
        die();
    }
    $goat = $res->fetch_assoc();
    
    // select goat's goattributes and store in array
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
	
	//get information from reviews
	$stmt = $db->prepare('SELECT DISTINCT U.name_first, U.name_last, R.stars, R.content
						   FROM goats G, users U, reviews R
						   WHERE R.goat = ? AND R.user = U.user_id');
	$stmt->bind_param('s', $_GET['p']);
	$stmt->execute();
	$review = $stmt->get_result();
	
	//get star avg
	$stmt = $db->prepare('SELECT DISTINCT AVG(stars) AS avgstars
						   FROM goats G, users U, reviews R
						   WHERE R.goat = ? AND R.user = U.user_id');
	$stmt->bind_param('s', $_GET['p']);
	$stmt->execute();
	$starcounter = $stmt->get_result();
	$staravg = $starcounter->fetch_assoc();
	
	//get user ids of users that have already reviewed said goat
	$stmt = $db->prepare('SELECT DISTINCT user FROM reviews WHERE goat = ?;');
	$stmt->bind_param('i', $_GET['p']);
	$stmt->execute();
	$res = $stmt->get_result();
	$row_count = $res->num_rows; 
	$user_ids = array();
	while($y = $res->fetch_assoc()) {
		array_push($user_ids, $y['user']);
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
			<div class="row">
				<?php
                    // bring in goat's main data
					$profile_pic = '/var/www/maaatch.com/sitedata/goats/goat' . $goat['goat_id'] . '/profile.jpg';
					$bio = file_get_contents('/var/www/maaatch.com/sitedata/goats/goat' . $goat['goat_id'] . '/bio');
					echo '<img class="img-responsive col-sm-5" id="goatpic" src="';
					if(file_exists($profile_pic)) {
						echo img_to_b64($profile_pic);
					} else {
						echo '/images/generic_gprofile.jpg'; 
					}	    
					echo '" alt="profile_pic"/>';
					echo '<div class="col-sm-7" id="profbody">';
					echo '<h1 class="page-header">' . $goat['name'] . '</h1>';
                    echo '<i>' . ucfirst($goat['gender']) . '</i><br/>';
                    echo '<b>Age:</b> ' . $goat['age'] . '<br/>';
					echo '<b>Price:</b> $' . $goat['price'] . '<br/>';
					
					//print average stars
					if($review->num_rows > 0) {
					echo '<p><b>Average Star Rating:</b> '. $staravg['avgstars'] . '</p>';
					}
					
                    if($goat['sellername']) {
                        echo '<b>Seller:</b> <a href="/wishlist/?user=' . $goat['selleruname'] . '">' . $goat['sellername'] . '</a><br/>';
                    }
					echo '<br/><a class="btn btn-md btn-primary" href="/order/orderpage.php?g=' . $goat['goat_id'] . '" role="button">Click to Order</a>';
					echo ' ';//to create space between the inline order and wishlist buttons
					echo '<a class="btn btn-md btn-primary" href="/wishlist/addtowishlist.php?g=' . $goat['goat_id'] . '" role="button">Add to Wishlist</a><br/>';
					echo '<br/>' . $bio;
                    echo '<div id="tags">';
                        foreach($gattr as $g) {
                            echo '<button class="btn btn-sm">' . $g . '</button>';
                        }
                    echo '</div>';
					echo '<section>';
					
					//for each review
					if($review->num_rows > 0) {
						//output content
						echo '<h3>Reviews:</h3>';
						while($row = $review->fetch_assoc()) {
							echo '<div class="panel panel-primary">';
							echo '<div class="panel panel-heading">';
							echo $row['name_first'] . ' ' . $row['name_last'];
							echo '<span class="starwrapper">';
							$counter = 0;
							$remainder = 5 - $row['stars'];
							for($counter; $counter < $row['stars']; $counter++) {
								echo '<img src="/images/full_star.png" alt="star" style="width:20px;height:20px">';
							}
							$counter = 0;
							for($counter; $counter < $remainder; $counter++) {
								echo '<img src="/images/white_star.png" alt="star" style="width:20px;height:20px">';
							}
								echo '</span>';
							echo '</div>';
							//print review content
                            if(!empty($row['content'])) {
                                echo '<div class="panel panel-body" style="padding-top:1px;padding-bottom:1px">' . $row['content'] . '</div>';
                            }
                            echo '</div>';
						}
					}
					//review button if no reviews on this goat already
					if(isset($_SESSION['user_id'])) {
						$id = $_SESSION['user_id'];
						$c = 0;
                        foreach($user_ids as $u) {
							if($u == $id) { //if the user has already reviewed print thank you
								echo '<div class="panel text-center">Thank you for reviewing this goat!</div>';
							} else {
								$c++;
							}
                        }
                        if ($c == $row_count || $row_count == 0) { //if the user has not reviewed display review button or no reviews
                            echo '<form action="reviewgoat.php?p=' . $_GET['p'] . '" method="POST">';
                            echo '<button class="btn btn-lg btn-primary center-block" type="submit">Leave a review for this goat</button>';
                            echo '</form>';
                        }
					} else { //if user is not logged in, display button which will redirect to login upon click
						echo '<form action="reviewgoat.php?p=' . $_GET['p'] . '" method="POST">';
						echo '<button class="btn btn-lg btn-primary center-block" type="submit">Leave a review for this goat</button>';
						echo '</form>';
					}
                    echo '</section>';
                    echo '</div>';
				?>
			</div>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
