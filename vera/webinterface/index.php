<!DOCTYPE html> 
<?php
	include("./temperature.class.php");
	include("./wgisdone.class.php");
	$temperature = new temperature();
	$wgisdone = new wgisdone();
	$wgisdonewhat = $wgisdone->getWhat();
	$wgisdonewhen = $wgisdone->getWhen();
	if (isset($_GET['category']))
        $foo = htmlspecialchars($_GET["category"]);
    else
        $foo = NULL;

?>
<html> 
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>VERA - Virtual Enlighted Room Assistent</title> 
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>

	<script src="./widescreen.js"></script>
	<script src="./upload.js"></script>
	<link rel="stylesheet" type="text/css" href="./widescreen.css">
</head> 
<body> 
	<div data-role="page" class="ui-responsive-panel" id="my-page">

		<div data-role="header" data-theme="b">
			<h1>VERA</h1>
			<a href="#nav-panel" class="jqm-header" data-icon="bars" data-iconpos="notext">Menu</a>
		</div>

		<div data-role="panel" data-display="overlay" class="jqm-navmenu-panel" id="nav-panel" data-theme="b">
			<ul data-role="listview" data-theme="c" data-dividertheme="d">
				<li data-icon="home"><a href="./" <?php if($foo == NULL) { echo "class=\"ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-active\""; } ?>>Home</a></li>
				<li><a href="./?category=heating" <?php if($foo == "heating") { echo "class=\"ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-active\""; } ?>>Heating</a></li>
				<li><a href="./?category=light" <?php if($foo == "light") { echo "class=\"ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-active\""; } ?>>Light</a></li>
				<li><a href="./?category=isdone" <?php if($foo == "isdone") { echo "class=\"ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-active\""; } ?>>WG Isdone</a></li>
				<li><a href="./?category=upload" <?php if($foo == "upload") { echo "class=\"ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-active\""; } ?>>Upload</a></li>
				<li><a href="./?category=download" <?php if($foo == "download") { echo "class=\"ui-btn ui-btn-icon-right ui-icon-carat-r ui-btn-active\""; } ?>>Download</a></li>
				<li class="jqm-close-menu" data-icon="delete"><a href="#" data-rel="close">Close menu</a></li>
			</ul>
		</div>

		<div data-role="content" class="jqm-content">
			
			<?php
			switch($foo) {
				case "heating": ?>
			<div class="content-primary">
				<h2>Heating</h2>
				<p>Temperature: <?php echo $temperature->getLastTemperature() ?></p>
				<picture>
					<source media="(min-width: 45em)" srcset="temperature-graph-high-res.png">
					<source media="(min-width: 18em)" srcset="temperature-graph-med-res.png">
					<img src="temperature-graph-low-res.png" alt="The president giving an award.">
				</picture>
			</div>
			<?php
				break;
				case "light": ?>
			<div class="content-primary">
				<h2>Light</h2>
				<p>Content will come soon :).</p>
			</div>
			<?php
				break;
				case "isdone": ?>
			<div class="content-primary">
				<h2>WG Isdone</h2>
				<ul data-role="listview" data-inset="true" class="ui-nodisc-icon ui-alt-icon" data-split-icon="plus">
					<?php for($i = 0; $i < count($wgisdonewhat); $i++) { ?>
					<li>
						<a href="#"><?php echo $wgisdonewhat[$i] ?><span class="ui-li-count">1</span></a>
						<a href="#" data-rel="popup" data-position-to="window" data-transition="pop"></a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<?php
				break;
				case "upload": ?>
			<div class="content-primary">
				<h2>Upload</h2>
				<form action="" method="post" enctype="multipart/form-data">
                    <input name="file" type="file" id="fileA" onchange="fileChange();"/>
                    <div data-role="controlgroup" data-type="horizontal" width="100%">
                        <a href="#" class="ui-shadow ui-btn ui-btn-inline ui-btn-icon-left ui-icon-arrow-u" onclick="uploadFile();">Upload</a>
                        <a href="#" class="ui-shadow ui-btn ui-btn-inline ui-btn-icon-left ui-icon-delete" onclick="uploadAbort();">Abort</a>
                    </div>
                </form>
                <div>
                    <div id="fileName"></div>
                    <div id="fileSize"></div>
                    <div id="fileType"></div>
                    <progress id="progress" style="margin-top:10px"></progress> <span id="prozent"></span>
                </div>
			</div>
			<?php
				break;
				case "download": ?>
			<div class="content-primary">
				<h2>Download</h2>
				<p> <?php
                if ($handle = opendir('./upload')) {
                    while (false !== ($file = readdir($handle))) {
                        if ($file != "." && $file != "..") {
                            echo "<a href=\"./upload/$file\" target=\"_blank\">$file</a><br />";
                        }
                    }
                    closedir($handle);
                } ?> </p>
			</div>
			<?php
				break;
				default: ?>
			<div class="content-primary">
				<h2>Welcome to VERA</h2>
				<p>VERA or Virtual Enlighted Room Assistent is my personal home automatisation system. At this point it can only view the temperature of my room. The next step is to provide a diagramm over the temperature. After that i would like to write something for controlling my light.</p>
				<p><?php echo $foo;?></p>
			</div>
			<?php
			}
			?>

		</div>

		<div data-role="footer" data-theme="b" class="jqm-footer">
			<p>&copy; 2013 Root the Kid -- Version 0.0.1 Alpha -- <a href="https://github.com/ThomasTacke/pl4ygr0und/tree/master/vera" target="_blank">Project Site</a></p>
		</div>

	</div>

</body>
</html>
