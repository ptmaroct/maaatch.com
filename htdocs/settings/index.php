<?php
	session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	require '/var/www/maaatch.com/htdocs/common/utility.php';

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $stmt = $db->prepare('SELECT * FROM users WHERE user_id = ?;');
    $stmt->bind_param('s', $_SESSION['user_id']);
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;User Settings</title>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("User Settings", 0); ?>
		<main class="container">
			<form action="settings.php" method="post">
				<h2 class="form-inline-heading">User Settings</h2>
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
					<label for="location" class="col-xs-2 form-control-label">Address:</label>
					<div class="col-xs-10">
						<input type="textarea" class="form-control" id="location" name="location" value="<?php echo $user['location']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="preferences" class="col-xs-2 form-control-label">Preferences:</label>
					<div class="col-xs-10">
						<input type="textarea" class="form-control" id="Preferences" placeholder="What are you looking for in a goat?">
					</div>
				</div>
				<div class="form-group row">
					<label for="bio" class="col-xs-2 form-control-label">Bio:</label>
					<div class="col-xs-10">
						<input type="textarea" class="form-control" id="bio" name="bio" placeholder="Give a brief description of yourself.">
					</div>
				</div>
				<button class="btn btn-lg btn-primary text-center" type="submit">Save Settings</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
