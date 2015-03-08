<?php
class leds {
	function setPWM($color, $brightness) {

		if ($brightness < 500 || $brightness > 2000)
			$brightness = 0;

		switch($color) {
			case "red":
				$out = shell_exec("echo 5=$brightness > /dev/servoblaster");
				break;
			case "green":
				$out = shell_exec("echo 2=$brightness > /dev/servoblaster");
				break;
			case "blue":
				$out = shell_exec("echo 6=$brightness > /dev/servoblaster");
				break;
			case "all":
				$out = shell_exec("echo 2=$brightness >| /dev/servoblaster; echo 5=$brightness >| /dev/servoblaster; echo 6=$brightness >| /dev/servoblaster");
				break;
			default:
				$out = shell_exec("echo 2=0 >| /dev/servoblaster; echo 5=0 >| /dev/servoblaster; echo 6=0 >| /dev/servoblaster");
		}
	return $out;
	}
}
?>
