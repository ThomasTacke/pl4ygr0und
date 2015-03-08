<?php
class wgisdone {
	function getWhat() {
		$xml = simplexml_load_file("/srv/http/pl4ygr0und/vera/webinterface/wgisdone.xml");
		$result = $xml->xpath("/root/node/what[text()]");
		return $result;
	}
	function getWhen() {
		$xml = simplexml_load_file("/srv/http/pl4ygr0und/vera/webinterface/wgisdone.xml");
		$result1 = $xml->xpath("/root/node/date[text()]");
		$result2 = $xml->xpath("/root/node/time[text()]");
		for($i = 0; $i < count($result1);$i++) 
			$result[$i] = $result1[$i]." ".$result2[$i];
		return $result;
	}
}
?>
