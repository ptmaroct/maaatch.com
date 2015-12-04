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
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Orders</title>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Orders", 0); ?>
		<main class="container">
            <h1><?php echo $_SESSION['name'] .'\'s Orders'; ?></h1>
            <table class="table">
                <tr>
					<th>Order ID</th>
                    <th>Date</th>
                    <th>Goat Name</th>
					<th>Shipping Speed</th>
                    <th>Shipping Address</th>
                <tr>
                <?php 
                    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
                    $stmt = $db->prepare('SELECT orders.order_id AS id, DATE(orders.date) AS date,
					                      orders.speed AS speed, orders.address AS address,
										  goats.name AS goat
                                          FROM orders LEFT JOIN goats
                                          ON orders.goat = goats.goat_id
                                          WHERE orders.user = ?
                                          ORDER BY date DESC;
                                          ');
                    echo $db->error;
                    $stmt->bind_param('i', $_SESSION['user_id']);
                    $stmt->execute();
                    $res = $stmt->get_result();

                    while($order = $res->fetch_assoc()) {
                        echo '<tr>';
                            echo '<td>' . $order['id'] . '</td>';
                            echo '<td>' . $order['date'] . '</td>';
                            echo '<td>' . $order['goat'] . '</td>';
                            echo '<td>' . ucfirst($order['speed']) . '</td>';
                            echo '<td>' . $order['address'] . '</td>';
                        echo '</tr>';
                    }
                ?>
            </table>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
