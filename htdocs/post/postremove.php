<?php
    session_start();
	require('/var/www/maaatch.com/db_auth.php');
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    $rem = array_map('intval', explode('|', $_POST['rem']));
    
    // for each set to remove, delete from table
    foreach($rem as $r) {
        $stmt = $db->prepare('DELETE FROM goats WHERE goat_id = ?;');
        $stmt->bind_param('i', $r);
        $stmt->execute();

        // delete goat's data on disk
        $goatdir = '/var/www/maaatch.com/sitedata/goats/goat' . $r;
        array_map(
                function($f) use ($goatdir) {
                    unlink($goatdir . '/' . $f);
                },
                array_filter(
                        scandir($goatdir),
                        function($f) use ($goatdir) {
                            return is_file($goatdir . '/' . $f);
                        }
                )
        );
        rmdir($goatdir);
    }
?>
