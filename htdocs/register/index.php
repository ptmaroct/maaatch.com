<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Register</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Log In", 0, False); ?>
		<main class="container">
			<h1><a href="http://www.w3schools.com/bootstrap/bootstrap_forms.asp">
				Bootstrap forms reference
			</a></h1>
			<form class="form-signin" action="register.php" method="post">
				<h2 class="form-signin-heading">Register an account</h2>
				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="remember-me"> Remember me
					</label>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
