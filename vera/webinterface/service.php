<?php
	include("./temperature.class.php");
	include("./leds.class.php");
	$temperature = new temperature();
	$leds = new leds();

	if (isset($_GET['opts']))
		$do = htmlspecialchars($_GET["opts"]);
	else
		$do = NULL;
	
	switch($do) {
		case "dg":
			//echo $temperature->getLastTemperature()."\n";
			$temperature->drawgraphHighRes();
			break;
		case "sleds":
			if (isset($_GET['color']) && isset($_GET['brightness'])) { 
				$color = htmlspecialchars($_GET["color"]);
				$brightness = htmlspecialchars($_GET["brightness"]);
			
				$leds->setPWM($color, $brightness);
			}
	}
?>
