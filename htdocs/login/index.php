<?php
	session_start();
	require('/var/www/maaatch.com/htdocs/common/utility.php');
	login_redir("/", false);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Log In</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Log In", 0); ?>
		<main class="container">
			<form class="form-signin" action="login.php" method="post">
				<h2 class="form-signin-heading">Please log in</h2>
				
				<label for="inputUser" class="sr-only">Username</label>
				<input name="username" type="text" id="inputUser" class="form-control" placeholder="Username" required autofocus>
				
				<label for="inputPassword" class="sr-only">Password</label>
				<input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
				
				<?php if(isset($_GET['badlogin'])) { echo '<div id="notifier">Username or password incorrect.</div>'; } ?>

				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
