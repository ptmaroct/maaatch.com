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
		<?php navbar("Sign Up", 0); ?>
		<main class="container">
			<form class="form-signin" action="register.php" method="post">

				<h2 class="form-signin-heading">Register an account</h2>
				
				<label for="inputUser" class="sr-only">Username</label>
				<input name="username" type="text" id="inputUser" class="form-control" placeholder="Username" required autofocus>
				
				<label for="inputFirstName" class="sr-only">First Name</label>
				<input name="firstname" type="text" id="inputFirstName" class="form-control" placeholder="First Name" required>
				
				<label for="inputLastName" class="sr-only">Last Name</label>
				<input name="lastname" type="text" id="inputLastName" class="form-control" placeholder="Last Name" required>

				<label for="inputSSN" class="sr-only">SSN</label>
				<input type="string" id="inputSSN" class="form-control" placeholder="SSN">
				
				<label for="inputMMN" class="sr-only">Mother's Maiden Name</label>
				<input type="string" id="inputMMN" class="form-control" placeholder="Mother's Maiden Name">
				
				<label for="inputBT" class="sr-only">Blood Type</label>
				<input type="string" id="inputBT" class="form-control" placeholder="Blood Type">
				
				<label for="inputPassword1" class="sr-only">Password</label>
				<input name="password" type="password" id="inputPassword1" class="form-control" placeholder="Password" required>
				
				<label for="inputPassword2" class="sr-only">Repeat Password</label>
				<input type="password" id="inputPassword2" class="form-control" placeholder="Repeat Password" required>
				
                <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
