<?php
class temperature {
	function getLastTemperature() {
		$xml = simplexml_load_file("/srv/http/pl4ygr0und-vera/webinterface/temperature.xml");
		$result = $xml->xpath("/root/node[last()]/temperature[text()]");
		return $result[0];
	}

	function drawgraph() {
		include("pChart/class/pData.class.php");
		include("pChart/class/pDraw.class.php");
		include("pChart/class/pImage.class.php");

		$myData = new pData();

		$year = date('Y');
		$month = date('m');
		$day = date('d');
		$xml = simplexml_load_file("/srv/http/pl4ygr0und-vera/webinterface/temperature.xml");
		//$result = $xml->xpath("/root/node[date='$year-$month-$day' and (time='00:00' or time='01:00' or time='02:00' or time='03:00' or time='04:00' or time='05:00' or time='06:00' or time='07:00' or time='08:00' or time='09:00' or time='10:00' or time='11:00' or time='12:00' or time='13:00' or time='14:00' or time='15:00' or time='16:00' or time='17:00' or time='18:00' or time='19:00' or time='20:00' or time='21:00' or time='22:00' or time='23:00')]/temperature[text()]");
		$result = $xml->xpath("/root/node[time='00:00' or time='01:00' or time='02:00' or time='03:00' or time='04:00' or time='05:00' or time='06:00' or time='07:00' or time='08:00' or time='09:00' or time='10:00' or time='11:00' or time='12:00' or time='13:00' or time='14:00' or time='15:00' or time='16:00' or time='17:00' or time='18:00' or time='19:00' or time='20:00' or time='21:00' or time='22:00' or time='23:00']");
		
		for($index = $day-6; $index <= $day; $index++) {
			if($index > 0) {
				$date = date_format(new DateTime("$year-$month-$index"), 'Y-m-d');
				$result = $xml->xpath("/root/node[date='$date' and (time='00:00' or time='01:00' or time='02:00' or time='03:00' or time='04:00' or time='05:00' or time='06:00' or time='07:00' or time='08:00' or time='09:00' or time='10:00' or time='11:00' or time='12:00' or time='13:00' or time='14:00' or time='15:00' or time='16:00' or time='17:00' or time='18:00' or time='19:00' or time='20:00' or time='21:00' or time='22:00' or time='23:00')]");
				for($i = 0; $i < 24; $i++)
					$temperatureset[$i] = VOID;
				foreach($result as $item) {
					$xml_tmp = simplexml_load_string($item->asXml());
					$temperature = $xml_tmp->xpath("//temperature[text()]");
					$time = $xml_tmp->xpath("//time[text()]");
					$temperatureset[intval(substr($time[0],0,2))] = floatval($temperature[0]);
				}
				if(sizeof($result)) {
					$myData->addPoints($temperatureset, "$date");
					$myData->setSerieDescription("$date","$date");
					$myData->setSerieOnAxis("$date",0);
				}
			}
		}		

		$myData->addPoints(array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23"),"Absissa");
		$myData->setSerieDescription("Absissa", "Hour");
		$myData->setAxisUnit("Absissa","h");
		$myData->setAbscissa("Absissa");

		$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
		$myData->setAxisName(0,"Temperature");
		$myData->setAxisUnit(0,"°C");
		
		$width = 1220;
		$height = 400;
		$myPicture = new pImage($width,$height,$myData);
		$myPicture->drawFilledRectangle(0,0,$width,$height,array("R"=>0,"G"=>0,"B"=>0,"Dash"=>TRUE,"DashR"=>0,"DashG"=>51,"DashB"=>51,"BorderR"=>0,"BorderG"=>0,"BorderB"=>0)); 

		$Settings = array ("StartR" => 222, "StartG" => 222, "StartB" => 222, "EndR" => 1, "EndG" => 1, "EndB" => 1, "Alpha" => 50);
		$myPicture->drawGradientArea(0,0,$width,$height,DIRECTION_VERTICAL,$Settings);

		$myPicture->drawRectangle(0,0,$width-1,$height-1, array ("R" => 0, "G" => 0, "B" => 0));

		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));

		$myPicture->setFontProperties(array("FontName"=>"pChart/fonts/Forgotte.ttf","FontSize"=>18));
		$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE
		, "R"=>255, "G"=>255, "B"=>255);
		$myPicture->drawText(350,25,"Average Temperature",$TextSettings);


		$myPicture->Antialias = TRUE; 

		 /* Draw the scale and the 1st chart */ 
		$myPicture->setGraphArea(50,50,$width-85,$height-50);
		$myPicture->setFontProperties(array("R"=>255,"G"=>255,"B"=>255,"FontName"=>"pChart/fonts/pf_arma_five.ttf","FontSize"=>8));
		$myPicture->drawScale(array("DrawSubTicks"=>TRUE)); 
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 
		$myPicture->drawSplineChart(array("DisplayValues"=>FALSE,"DisplayColor"=>DISPLAY_AUTO)); 
		$myPicture->setShadow(FALSE); 
		$myPicture->drawPlotChart();

		$Config = array("FontR"=>255, "FontG"=>255, "FontB"=>255, "FontName"=>"pChart/fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_BOX
		, "Mode"=>LEGEND_VERTICAL
		);
		$myPicture->drawLegend($width-70,55,$Config);
		//$myPicture->stroke();
		$myPicture->render("/srv/http/pl4ygr0und-vera/webinterface/temperature-graph.png");
	}
}
?>
