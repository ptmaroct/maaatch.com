<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;User Settings</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("User Settings", 0); ?>
		<main class="container">
			<form action="settings.php" method="post">
				<h2 class="form-inline-heading">User Settings</h2>
				<div class="form-group row">
					<label for="age" class="col-sm-2 form-control-label">Age:</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="Age">
					</div>
				</div>
				<div class="form-group row">
					<label for="preferences" class="col-sm-2 form-control-label">Preferences:</label>
					<div class="col-sm-4">
						<input type="textarea" class="form-control" id="Preferences" placeholder="What are you looking for in a goat?">
					</div>
				</div>
				<div class="form-group row">
					<label for="bio" class="col-sm-2 form-control-label">Bio:</label>
					<div class="col-sm-4">
						<input type="textarea" class="form-control" id="Bio" placeholder="Give a brief description of yourself.">
					</div>
				</div>
				<button class="btn btn-lg btn-primary text-center" type="submit">Save Settings</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
