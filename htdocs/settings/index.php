<?php
	session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	require '/var/www/maaatch.com/htdocs/common/utility.php';
    
    // get user data for current user
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $stmt = $db->prepare('SELECT * FROM users WHERE user_id = ?;');
    $stmt->bind_param('s', $_SESSION['user_id']);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();
    
    // get all tags 
    $tags = $db->query('SELECT * FROM goattributes;');

    // get user tags
	$stmt = $db->prepare('SELECT goattribute FROM user_goattributes WHERE user = ?;');
    $stmt->bind_param('s', $_SESSION['user_id']);
    $stmt->execute();
    $res = $stmt->get_result();
	$i = 0;
	while ($row = $res->fetch_assoc()) {
		$cb[$i] = $row['goattribute'];
		$i += 1;
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;My Profile</title>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("My Profile", 0); ?>
		<main class="container">
			<form action="settings.php" method="post">
				<h2 class="form-inline-heading">My Profile</h2><br/>
				<div class="form-group row">
					<label for="name_first" class="col-xs-2 form-control-label">First Name:</label>
					<div class="col-xs-10">
						<input type="textarea" class="form-control" id="FName" name="FName" value="<?php echo $user['name_first']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="name_last" class="col-xs-2 form-control-label">Last Name:</label>
					<div class="col-xs-10">
						<input type="textarea" class="form-control" id="LName" name="LName" value="<?php echo $user['name_last']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="gender" class="col-xs-2 form-control-label">Gender:</label>
					<div class="col-xs-10">
						<select id="gender" name="gender" >
							<option <?php if($user['gender'] == "NULL") echo "selected"; ?> value="NULL">Select...</option>
							<option <?php if($user['gender'] == "male") echo "selected"; ?> value="male">Male</option>
							<option <?php if($user['gender'] == "female") echo "selected"; ?> value="female">Female</option>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="age" class="col-xs-2 form-control-label">Age:</label>
					<div class="col-xs-10">
						<input type="number" class="form-control" id="age" name="age" min="0" step="1" value="<?php echo $user['age']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="location" class="col-xs-2 form-control-label">Location:</label>
					<div class="col-xs-10">
						<input type="textarea" class="form-control" id="location" name="location" value="<?php echo $user['location']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="bio" class="col-xs-2 form-control-label">Bio:</label>
					<div class="col-xs-10">
						<input type="textarea" class="form-control" id="bio" name="bio" 
						placeholder="Give a brief description of yourself." 
						value="<?php echo file_get_contents("/var/www/maaatch.com/sitedata/users/" . $user['user_id'] . "/bio"); ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="goattributes" class="col-xs-2 form-control-label">Goattributes:</label>
					<div class="col-xs-10">
                        <?php
                            while($tag = $tags->fetch_assoc()) {
                                echo '<label class="checkbox-inline">
                                    <input class="checkbox" name="ga' . $tag['goattribute_id'] .
                                    '" type="checkbox" ' . (in_array($tag['goattribute_id'], $cb)?'checked':'') .
                                    ' value="true"/>' . $tag['name'] . '</label>' . "\n";
                            }
                        ?>
					</div>
				</div>

				<br/>
				<button class="btn btn-lg btn-primary text-center" type="submit">Save Profile Edits</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
