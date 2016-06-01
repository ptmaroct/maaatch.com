<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/htdocs/common/utility.php';
	require '/var/www/maaatch.com/db_auth.php';
    login_redir('/login/', true);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;My Goats</title>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("My Goats", 0); ?>
		<main class="container">
            <h1><?php echo $_SESSION['name'] .'\'s Goats Posted'; ?></h1><br/>
            <table class="table table-hover">
                <tr>
					<th>Goat Name</th>
                    <th>Gender</th>
                    <th>Age</th>
					<th>Price</th>
					<th>Remove Goat</th>
				<tr>
                <?php
                    // get all goats that the user posted
                    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
                    $stmt = $db->prepare('SELECT goat_id, name, gender, age, price
                                          FROM goats
                                          WHERE seller = ?
                                          ORDER BY name;
                                          ');
                    $stmt->bind_param('i', $_SESSION['user_id']);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    
                    // display one row per goat
                    while($goat = $res->fetch_assoc()) {
                        echo '<tr data-goatid="' . $goat['goat_id'] .'">';
                            echo '<td>' . $goat['name'] . '</td>';
                            echo '<td>' . $goat['gender'] . '</td>';
                            echo '<td>' . $goat['age'] . '</td>';
                            echo '<td>' . $goat['price'] . '</td>';
							echo '<td>';
								echo '<button class="removebutton btn btn-danger btn-sm">';
								echo '<span class="glyphicon glyphicon-trash" aria-hidden="true">';
								echo '</span></button>';
							echo '</td>';
                        echo "</tr>\n";
                    }
                ?>
            </table>
            <div class="text-center">
                <button class="btn btn-lg btn-primary hidden" id="submit">Save</button>
            </div>
		</main>
		<?php bootstrap_js(); ?>
        <script src="postlist.js"></script>
	</body>
</html>
