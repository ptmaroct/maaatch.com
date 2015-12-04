<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Order Form</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Order Form", 0); ?>
		<main class="container">
			<form action="order.php" method="post">
				<h2 class="form-inline-heading">Goat Order Form</h2>
				<div class="form-group row">
					<label for="name" class="col-sm-2 form-control-label">Name:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="Name" placeholder="First and Last Name">
					</div>
				</div>
				<div class="form-group row">
					<label for="goat" class="col-sm-2 form-control-label">Goat Name:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="goatName" placeholder="First and Last Name">
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-2 form-control-label">Email:</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" placeholder="username@example.com">
					</div>
				</div>
				<div class="form-group row">
					<label for="date" class="col-sm-2 form-control-label">Date:</label>
					<div class="col-sm-10">
						<input type="datetime-local" class="form-control" id="date">
					</div>
				</div>
				<div class="form-group row">
					<label for="shipping" class="col-sm-2 form-control-label">Shipping Method:</label>
					<div class="col-sm-10">
						<select class="form-control" id="shipping">
							<option value="standard">Standard</option>
							<option value="priority">Priority</option>
							<option value="overnight">Overnight</option>
						</select>
					</div>
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Confirm Order</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
