<?php

if (isset($_POST['data'])) {
	$data=$_POST['data'];
	$file="logfile.txt";
	$current = file_get_contents($file);
	$current=$current.$data."\n";
	file_put_contents($file, $current);
	fclose($file);
}
?>