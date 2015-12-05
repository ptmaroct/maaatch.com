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
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Your Profile</title>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Your Profile", 0); ?>
		<main class="container">
			<form action="settings.php" method="post">
				<h2 class="form-inline-heading">Your Profile</h2><br/>
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
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="1">Foodie</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="2">Night Owl</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="3">Early Bird</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="4">Athletic</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="5">Coach Potato</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="6">Intellectual</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="7">Traveler</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="8">Workaholic</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="9">Shopaholic</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="10">Introvert</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="11">Extrovert</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="12">Intuitive</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="13">Sensitive</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="14">Thoughtful</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="15">Perceptive</label>
						<label class="checkbox-inline"><input type="checkbox"  
							id="goattributes" name="goattributes[]" value="16">Listener</label>
					</div>
				</div>

				<br/>
				<button class="btn btn-lg btn-primary text-center" type="submit">Save Profile Edits</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
