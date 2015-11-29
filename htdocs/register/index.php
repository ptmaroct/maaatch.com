<?php
	session_start();
	require('/var/www/maaatch.com/htdocs/common/utility.php');
	login_redir("/", false);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Register</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="rvalidate.js"></script>
	</head>
	<body>
		<?php navbar("Log In", 0); ?>
		<main class="container">
			<form class="form-signin" action="register.php" method="post">

				<h2 class="form-signin-heading">Register an account</h2>
				
				<label for="inputUser" class="sr-only">Username</label>
				<input name="username" type="text" id="inputUser" class="form-control" placeholder="Username" required autofocus>
				
				<label for="inputFirstName" class="sr-only">First Name</label>
				<input name="firstname" type="text" id="inputFirstName" class="form-control" placeholder="First Name" required>
				
				<label for="inputLastName" class="sr-only">Last Name</label>
				<input name="lastname" type="text" id="inputLastName" class="form-control" placeholder="Last Name" required>
				
				<label for="inputPassword" class="sr-only">Password</label>
				<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
				
				<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
