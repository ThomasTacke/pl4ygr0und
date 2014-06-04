<?php
	include("./temperature.class.php");
	$temperature = new temperature();
	//echo $temperature->getLastTemperature()."\n";
	$temperature->drawgraph();
?>
