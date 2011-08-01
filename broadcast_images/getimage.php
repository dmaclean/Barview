<?php
	$bar_id = $_GET['bar_id'];
	
	header("Content-type: image/jpeg");
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	echo file_get_contents($bar_id.".jpg");
?>