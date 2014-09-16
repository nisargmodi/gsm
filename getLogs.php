<?php
	date_default_timezone_set("Asia/Kolkata");
	$today=getdate();
	$file="logfile.txt";
	$current = file_get_contents($file);	
	echo $current. " ".$today['hours'].":".$today['minutes'].":".$today['seconds'];
	?>
