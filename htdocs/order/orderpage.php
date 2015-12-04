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
	
	if(isset($_GET['g'])) {
		$gstmt = $db->prepare('SELECT name FROM goats WHERE goat_id = ?;');
		$gstmt->bind_param('s', $_GET['g']);
		$gstmt->execute();
		$gres = $gstmt->get_result();
		if(!$gres->num_rows) {
			header('Location: /goats/');
			die();
		}
		$goat = $gres->fetch_assoc();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Order Form</title>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("Order Form", 0); ?>
		<main class="container">
			<form action="order.php?n=<?php echo $_GET['g']; ?>" method="post">
				<h2 class="form-inline-heading">Goat Order Form</h2> <br/>
				<div class="form-group row">
					<label for="name" class="col-sm-2 form-control-label">Name:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="Name" value="<?php echo $user['name_first'] . ' ' . $user['name_last']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="goat" class="col-sm-2 form-control-label">Goat Name:</label>
					<div class="col-sm-10">
						<?php
                            echo '<input type="text" class="form-control" name="goatName"';
							if(isset($_GET['g'])) {
								echo 'value="' . $goat['name'] . '">';
							}else { 
							echo 'placeholder="First and Last Name">';
							}
						?>
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
						<input type="date" class="form-control" name="date">
					</div>
				</div>
				<div class="form-group row">
					<label for="shipping" class="col-sm-2 form-control-label">Shipping Method:</label>
					<div class="col-sm-10">
						<select class="form-control" name="shipping">
							<option value="standard">Standard</option>
							<option value="priority">Priority</option>
							<option value="overnight">Overnight</option>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="address" class="col-sm-2 form-control-label">Address:</label>
					<div class="col-sm-10">
						<input type="address" class="form-control" name="address" placeholder="Enter address here">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="city" class="col-sm-2 form-control-label">City:</label>
					<div class="col-sm-10">
						<input type="city" class="form-control" name="city" placeholder="Enter city here">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="state" class="col-sm-2 form-control-label">State:</label>
					<div class="col-sm-10">
						<input type="state" class="form-control" name="state" placeholder="Enter state here">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="zip" class="col-sm-2 form-control-label">Zip:</label>
					<div class="col-sm-10">
						<input type="zip" class="form-control" name="zip" placeholder="Enter zip code here">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="payment" class="col-sm-2 form-control-label">Payment Type:</label>
					<div class="col-sm-10">
						<select class="form-control" id="payment">
							<option value="visa">Visa</option>
							<option value="mastercard">Mastercard</option>
							<option value="american">American Express</option>
							<option value="debit">Debit Card </option>
						</select>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="cardnumber" class="col-sm-2 form-control-label">Card Number:</label>
					<div class="col-sm-10">
						<input type="cardnumber" class="form-control" id="cardnumber" placeholder="XXXX-XXXX-XXXX-XXXX">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="expirationdate" class="col-sm-2 form-control-label">Expiration Date:</label>
					<div class="col-sm-10">
						<input class="form-control" id="expiry" type="month">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="securitynumber" class="col-sm-2 form-control-label">Security Number:</label>
					<div class="col-sm-10">
						<input type="securitynumber" class="form-control" id="securitynumber" placeholder="XXX">
					</div>
				</div>
				
				<button class="btn btn-lg btn-primary btn-block" type="submit">Confirm Order</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
