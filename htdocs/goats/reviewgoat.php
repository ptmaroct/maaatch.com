<?php
	//NOTE PAGE IS NOT FINISHED (COPY OF orderpage.php to become reviewgoat.php)
	session_start();
    require '/var/www/maaatch.com/htdocs/common/common.php';
    require '/var/www/maaatch.com/db_auth.php';
	require '/var/www/maaatch.com/htdocs/common/utility.php';
    login_redir('/login/', true);

    $db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $stmt = $db->prepare('SELECT name FROM goats WHERE goat_id = ?;');
    $stmt->bind_param('s', $_GET['p']);
    $stmt->execute();
    $res = $stmt->get_result();
    $goat = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;Review Form</title>
		<?php head_tags(); ?>
		<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="gvalidate.js"></script>
	</head>
	<body>
		<?php navbar("Review Goat", 0); ?>
		<main class="container">
            <article class="col-md-4 col-md-offset-4">
                <?php
                    echo '<form action="review.php?p=' . $_GET['p'] . '" method="post">';
                    echo '<h2 class="form-inline-heading"><b>Review</b> <i>' . $goat['name'] . '</i></h2><br/>';
				?>
                    <div class="form-group row">
                        <label for="stars" class="col-sm-2 form-control-label">Stars:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="stars">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 form-control-label">Review:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name ="content" placeholder="Please feel free to type any comments you may have about this goat!"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary center-block" type="submit">Submit Review</button>
                </form>
            </article>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
