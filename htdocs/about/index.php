<?php
	session_start();
	/*include*/
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Maaatch&nbsp;&nbsp;|&nbsp;&nbsp;About Maaatch</title>
		<?php require '/var/www/maaatch.com/htdocs/common/common.php'; ?>
		<?php head_tags(); ?>
	</head>
	<body>
		<?php navbar("About Maaatch", 4); ?>
		<main class="container">
		<h1><i><b>Our goal is your happiness</b></i></h1>
		<section id="description">
			<p class="lead">
                Here at Maaatch.com, our mission is to provide our
                customers with the opportunity to find true companionship through
                Maaatching them with the goat of their dreams. Our one of
                a kind al<i>goat</i>rithm takes into consideration user
                preferences and attributes, and utilizes that information
                to provide customers with compatible Maaatches.
            </p>
			<section id="couples" class="row">
                <div class="col-sm-6">
                    <img class="img-rounded center-block img-responsive" id="couple1" src="images/JM.jpg" alt="couple1"/>
                    <label for="couple1">Jeff and Maaary</label>
                </div>
				<p class="col-sm-6 lead text-left" id="coupledescription">
				    As America's number 1 goat matching site, Maaatch.com
                    has successfully Maaatched over 1 million customers
                    with loving goats from around the globe. Couples like
                    Jeff and Maaary are what motivate us here at Maaatch.com
                    to continue our mission. Jeff and Maaary were matched
                    through Maaatch.com over 30 years ago, and their
                    relationship continues to grow today.
				</p>
			</section>
		</section>
		</main>
		<?php bootstrap_js(); ?>
	</body>
</html>
