<?php
	session_start();
	require('/var/www/maaatch.com/htdocs/common/utility.php');
	require '/var/www/maaatch.com/db_auth.php';
	login_redir("/login/", true);
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $tags = $db->query('SELECT * FROM goattributes;');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Post a Goat</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script src="rvalidate.js"></script>
	</head>
	<body>
		<?php navbar("Post a Goat", 0); ?>
		<main class="container">
			<form action="submit.php" method="post" class="col-md-4 col-md-offset-4">

				<h2 class="form-inline-heading">Post a Goat</h2></br>
				<div class="form-group">	
                    <label for="name">Goat Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Enter name here" required autofocus>
                </div>
				
				<div class="form-group">	
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
				
				<div class="form-group">	
                    <label for="age">Age</label>
                    <input name="age" type="number" class="form-control" value="8" required>
                </div>

				<div class="form-group">	
                    <label for="price">Price</label>
                    <input name="price" type="number" class="form-control" value="50" required>
                </div>

				<div class="form-group">	
                    <label for"bio">Bio</label>
                    <textarea name="bio" class="form-control" placeholder="Feel free to say something about your goat here..."></textarea>
                </div>
				
				<!-- Goattributes -->
				<div class="form-group row">
					<label for="goattributes" class="form-control-label">Goattributes:</label>
                    <br/>
                    <?php
                        while($tag = $tags->fetch_assoc()) {
                            echo '<label class="checkbox-inline">
                                <input class="checkbox" name="ga' . $tag['goattribute_id'] .
                                '" type="checkbox" value="true"/>' . $tag['name'] . '</label>' . "\n";
                        }
                    ?>
                </div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
			</form>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
