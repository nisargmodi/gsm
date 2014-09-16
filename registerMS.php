<?php
require 'connection.php';
if (isset($_POST['imsi'])) {
	$imsi=$_POST['imsi'];
	$query2="INSERT INTO `hlr` (`imsi`) VALUES (".$imsi.");";
	if(mysql_query($query2)) {
		echo " HLR Updated ";
	}
}
?>