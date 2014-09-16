<?php
function addCells($no,$rowno) {
for ($i=1; $i<=$no; $i++) {
//red blue green ||  blue green red
if ($rowno%2 == 1)
{ if ($i%3== 1)
$color = "red";
if ($i%3 == 2)
$color = "blue";
if ($i%3 == 0)
$color = "green";
}
else {
	if ($i%3 == 1)
$color = "green";
if ($i%3 == 2)
$color = "red";
if ($i%3 == 0)
$color = "blue";
}
if($rowno == 2)
if($i == 4)
$color = "white";

if($rowno == 3)
if($i == 6)
$color = "white";

if($rowno == 3)
if($i == 8)
$color = "white";

if($rowno == 4)
if($i == 2)
$color = "white";
echo'
<div class="hex" id="id'.$rowno.''.$i.'" onclick="colorme('.$rowno.','.$i.')" style="color:'.$color.';">
            <div class="top" style="border-bottom: 30px solid ;">
            </div>
                <div class="middle" style="background-color:'.$color.';" >
                    <center>'.$rowno.$i.'</center>
                </div>
            <div class="bottom" style="border-top: 30px solid ;">
            </div>
	</div><!--class hex over-->
';
}
}

?>