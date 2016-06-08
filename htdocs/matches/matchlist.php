<?php 
	require('/var/www/maaatch.com/db_auth.php');
	require('/var/www/maaatch.com/htdocs/common/utility.php');

    // query goats from database
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $stmt = $db->prepare('SELECT goat_id, name, age, gender FROM goats ORDER BY RAND();');
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $res = $stmt->get_result();
    
    // for each goat, make an entry
    while($goat = $res->fetch_assoc()) { 
        $profile_url = '/goats/profile.php?p=' . $goat['goat_id'];
        echo '<div class="media">';
            echo '<a href="' . $profile_url . '">';
                echo '<div class="media-left">';
                    $profile_pic = '/var/www/maaatch.com/sitedata/goats/goat' . $goat['goat_id'] . '/profile.jpg';
                    echo '<img src="';
                    if(file_exists($profile_pic)) {
                        echo img_to_b64($profile_pic);
                    } else {
                        echo '/images/generic_gprofile.jpg'; 
                    }    
                    echo '" alt="profile_pic" class="media-object"/>';
                echo '</div>';
            
                echo '<div class="media-body">';
                    echo '<h4 class="media-heading">' . $goat['name'] . '</h4>';
                    echo ucfirst($goat['gender']) .'<br/>';
                    echo $goat['age'];
                echo '</div>';
            echo '</a>';
        echo '</div>'; 
    }
?>
