<?php
 include 'connection.php';
$imsi=$_POST['imsi'];
$cell=$_POST['cell'];

$initialquery = "create table if not exists ".$cell."(msid int(11), cell varchar(20))";
if (mysql_query($initialquery)) {

$query="INSERT INTO ".$cell."(`msid`, `cell`) VALUES (".$imsi.",'".$cell."')";

	if(mysql_query($query)){
		/*$query1 = "insert into hlr ";
		$no_no = mysql_query($query1);
		if($no_no != FALSE) {
		$no = mysql_fetch_row($no_no);
			if($no[0]%5==0 || $no[0]==1) {
				*/
				$query2="UPDATE `hlr` SET `status` = '$cell' WHERE imsi=$imsi";
					if(mysql_query($query2)) {
						echo " HLR Updated ";
					}
		
		echo $cell;
	}

}