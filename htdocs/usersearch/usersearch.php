<?php
	require('/var/www/maaatch.com/db_auth.php');
	require('/var/www/maaatch.com/htdocs/common/utility.php');
	
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $stmt = $db->prepare('SELECT username, CONCAT_WS(" ", name_first, name_last) AS name FROM users WHERE username LIKE ?;');
    $match = '%' . $_GET['q'] . '%';
    $stmt->bind_param('s', $match);
    $stmt->execute();
    $res = $stmt->get_result();
    
    while($user = $res->fetch_assoc()) {
        $profile_url = '/wishlist/?user=' . urlencode($user['username']);
        echo '<div class="media">';
            echo '<a href="' . $profile_url . '">';
                echo '<div class="media-body">';
                    echo '<h4 class="media-heading">' . $user['name'] . '</h4>';
                    echo '<div class="username">' . $user['username'] . '</div>';
                echo '</div>';
            echo '</a>';
        echo '</div>';
    }
?>
