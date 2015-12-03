<?php
    session_start();
    require '/var/www/maaatch.com/htdocs/common/utility.php';
	require '/var/www/maaatch.com/db_auth.php';
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    // if user not specified, must be logged in
    if($active_user = $_GET['user']) {
        $stmt = $db->prepare('SELECT CONCAT_WS(" ", name_first, name_last) AS name FROM users WHERE username = ?;');
        $stmt->bind_param('s', $active_user);
        $stmt->execute();
        $active_name = $stmt->get_result()->fetch_assoc()['name'];
    }
    else {
        login_redir('/login/', true);
        $active_user = $_SESSION['username'];
        $active_name = $_SESSION['name'];
    }
    $self = (!$_GET['user'] || $_GET['user'] == $_SESSION['username']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Wishlist</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Browse Goats", 2); ?>
		<main class="container">
            <h1><?php echo $active_name; ?>'s Wishlist</h1>
                <table class="table table-hover">
                    <tr>
                        <th>Goat</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Price</th>
                        <?php if($self) { echo '<th></th>'; } ?>
                    <tr>
                    <?php // create wishlist for logged in user unless get variable 'uname' is set to username
                        $stmt = $db->prepare('SELECT goats.name AS name, goats.price AS price,
                                              goats.gender AS gender, goats.age AS age
                                              FROM users
                                              INNER JOIN wishlist
                                              ON users.user_id = wishlist.user
                                              RIGHT JOIN goats
                                              ON wishlist.goat = goats.goat_id
                                              WHERE username = ?
                                              ORDER BY goats.name;
                                              ');
                        $stmt->bind_param('s', $active_user);
                        $stmt->execute();
                        $res = $stmt->get_result();

                        while($goat = $res->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $goat['name'] . '</td>';
                            echo '<td>' . $goat['gender'] . '</td>';
                            echo '<td>' . $goat['age'] . '</td>';
                            echo '<td>$' . $goat['price'] . '</td>';
                            if($self) {
                            echo '<td><button class="btn btn-danger btn-xs">
                                Remove</button></td>';
                            }
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
            <div class="text-center">
                <?php // if on own wish list, put 'save' button to update database
                        // button creates hidden form like http://bit.ly/1TlLVXm  
                    if($self) {
                        echo '<button class="btn btn-lg btn-primary">Save</button>';
                    }
                ?>
            </div>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
