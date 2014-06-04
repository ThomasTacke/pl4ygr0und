<!DOCTYPE html> 
<?php
	include("./temperature.class.php");
	$foo = htmlspecialchars($_GET["category"]);
	$temperature = new temperature();
?>
<html> 
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>VERA -- Virtual Enlighted Room Assistent</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

	<link rel="stylesheet" href="./widescreen.css" />
</head> 
<body> 
	<div data-role="page" class="ui-responsive-panel">

		<div data-role="header" data-theme="a">
			<h1>VERA -- Virtual Enlighted Room Assistent</h1>
			<a href="#nav-panel" data-icon="bars" data-iconpos="notext">Menu</a>
		</div><!-- /header -->

		<div data-role="panel" data-position="left" data-position-fixed="false" data-display="reveal" id="nav-panel" data-theme="a">
			<ul data-role="listview" data-theme="c" data-dividertheme="d">
				<li data-icon="home"><a href="./">Home</a></li>
				<li><a href="./?category=heating">Heating</a></li>
				<li><a href="./?category=light">Light</a></li>
				<li><a href="./?category=volume">Volume</a></li>
				<li data-icon="delete" style="background-color:#111;"><a href="#" data-rel="close">Close menu</a></li>
			</ul>
		</div>

		<div data-role="content">
			
			<?php
			switch($foo) {
				case "heating": ?>
			<div class="content-primary" <?php echo "style=\"display:inline\""; ?>>
				<h2>VERA -- Heating</h2>
				<p>Temperature: <?php echo $temperature->getLastTemperature() ?></p>
				<img src="temperature-graph.png" alt="average temperature">	
			</div>
			<?php
				break;
				case "light": ?>
			<div class="content-primary" <?php echo "style=\"display:inline\""; ?>>
				<h2>VERA -- Light</h2>
				<p>Content will come soon :).</p>
			</div>
			<?php
				break;
				case "volume": ?>
			<div class="content-primary" <?php echo "style=\"display:inline\""; ?>>
				<h2>VERA -- Volume</h2>
				<p>Content will come soon :).</p>
			</div>
			<?php
				break;
				default: ?>
			<div class="content-primary" <?php echo "style=\"display:inline\""; ?>>
				<h2>Welcome to VERA</h2>
				<p>VERA or Virtual Enlighted Room Assistent is my personal home automatisation system. At this point it can only view the temperature of my room. The next step is to provide a diagramm over the temperature. After that i would like to write something for controlling my light.</p>
				<p><?php echo $foo;?></p>
			</div>
			<?php
			}
			?>

		</div><!-- /content -->

		<div data-role="footer" class="footer-docs" data-theme="c">
			<p>&copy; 2013 Root the Kid -- Version 0.0.1 Alpha -- <a href="https://code.google.com/p/pl4ygr0und-vera/" target="_blank">Project Site</a></p>
		</div>

	</div><!-- /page -->

</body>
</html>
