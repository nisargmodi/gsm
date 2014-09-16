<?php require_once("functions.php");
 	  require_once("globals.php");
 	  $imsi=IMSI+1;

 ?>

<HTML>
<HEAD>
<TITLE>Cursor Mover</TITLE>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<script src="jquery-1.10.2.min.js"></script>
<style>
.hex {
    float: left;
    margin-left: 3px;
    margin-bottom: -26px;
}
.hex .top {
    width: 0;
    border-bottom: 30px solid #6C6;
    border-left: 52px solid transparent;
    border-right: 52px solid transparent;
}
.hex .middle {
    width: 104px;
    height: 60px;
    background: #6C6;
}
.hex .bottom {
    width: 0;
    border-top: 30px solid #6C6;
    border-left: 52px solid transparent;
    border-right: 52px solid transparent;
}
.hex-row {
    clear: left;
}
.hex-row .even {
    margin-left: 53px;
}

#hexagons {
width:1000px;
}

</style>	
<script type="text/javascript">
		 var imsi=Math.floor(Math.random()*100);

		 $(document).ready(function(){
		 	$.ajax({
		 		url: 'registerMS.php',
		 		type: 'POST',
		 		data: {'imsi':imsi},
		 	});
		 });
		 
		 function wrtieLog(msg){
		 	$.ajax({
		 		url: 'logger.php',
		 		type: 'POST',
		 		data: {'data':"MSID:"+imsi+" "+msg},
		 		success: function(){
		 			console.log("Logged");
		 		}

		 	});
		 }
		function getCenter(elem){
			var height=elem.height();
			var width=elem.width();
			var position=elem.position();

			var xCenter=position.left+width/2;
			var yCenter=position.top+height/2;

			var center={'x':xCenter,'y':yCenter};

			return center;

		}

		function getEuclideanDistance(cellCenter,msCenter){
			var x=cellCenter.x - msCenter.x;
			var y=cellCenter.x - msCenter.x;
			var EuclideanDist=Math.sqrt(x*x+y*y);
			return EuclideanDist;
		}

		function updateVLR(imsi_id,cell){

		$.ajax({
		url : 'updateVLR.php',
		type : 'POST',
		data : {'imsi':imsi,'cell':cell},
		success : function(data){
		console.log("Logged handover "  + data);
		}
		});
		}
		
      document.addEventListener("DOMContentLoaded", init, false);

      function init()
      {
        var canvas = document.getElementById("mycanvas");
        canvas.addEventListener("mousedown", getPosition, false);
      }

      function getPosition(event)
      {
        var x = new Number();
        var y = new Number();
        var canvas = document.getElementById("mycanvas");

        if (event.x != undefined && event.y != undefined)
        {
          x = event.x;
          y = event.y;
        }
        else // Firefox method to get the position
        {
          x = event.clientX + document.body.scrollLeft +
              document.documentElement.scrollLeft;
          y = event.clientY + document.body.scrollTop +
              document.documentElement.scrollTop;
        }

        x -= canvas.offsetLeft;
        y -= canvas.offsetTop;

        alert("x: " + x + "  y: " + y);
      }

    </script>
	
	<SCRIPT>
	
	
var ie = (document.all && !window.opera)?1:0;
if(!ie)
{
	var e=document.captureEvents(Event.KEYUP)
}
window.onload=function()
{	
	$("#imsi_id").text("id:"+imsi).css({'color':'white'});
	if(!ie)
	{
		document.onkeyup=function(e)
		{
			move(e);
		}
	}
	else
	{
		document.onkeyup=function()
		{
			move();
		}
	}	
}
function move(e)
{
		if(ie)
		{
			ek = window.event.keyCode;
		}
		else
		{
			var event=e;
			var ek = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;	
		}
		var oldLeft = document.getElementById('DIV1').style.left;
		var oldTop = document.getElementById('DIV1').style.top;
		if (ek==37) document.getElementById('DIV1').style.left=(document.getElementById('DIV1').style.left.replace('px','')*1)-30;
		if (ek==39) document.getElementById('DIV1').style.left=(document.getElementById('DIV1').style.left.replace('px','')*1)+30;
		if (ek==38) document.getElementById('DIV1').style.top=(document.getElementById('DIV1').style.top.replace('px','')*1)-30;
		if (ek==40) document.getElementById('DIV1').style.top=(document.getElementById('DIV1').style.top.replace('px','')*1)+30;
		checkHandover(document.getElementById('DIV1').style.left, document.getElementById('DIV1').style.top, oldLeft, oldTop);
}

function checkHandover(left, top, oldLeft, oldTop){
	//alert(document.getElementById('DIV1').style.backgroundColor);

	left = left.replace('px','')*1;
	top = top.replace('px','')*1;
	oldLeft = oldLeft.replace('px','')*1;
	oldTop = oldTop.replace('px','')*1;
	
	//add ajax here
	
	if(getDivByXY(left-1,top-1) != getDivByXY(oldLeft,oldTop))
	{
	if (getDivByXY(left-1,top-1).style.color != "white"){
		var currentCell=getDivByXY(left-1,top-1);
	document.getElementById('printhere').innerHTML = "Frequency handed over!";
	var string = "Frequency handed over!";
	wrtieLog(string);
	updateVLR('3123',currentCell.getAttribute('id'));
	}
						else {
							document.getElementById('printhere').innerHTML = "No frequency zone! Calls will be dropped.";
							wrtieLog("No frequency zone! Calls will be dropped.");
						}
	}
	else {
	document.getElementById('printhere').innerHTML = "";
	}
	}
	
	function getDivByXY(x,y) {
   var alldivs = document.getElementsByClassName('hex');

   var d;

   for(d = 0; d < alldivs.length; d++) {
	   
	   var idstop = alldivs[d].offsetTop;
      if((idstop <= y) && ((idstop+94)>=y)) {
		console.log("1");
	   	if((alldivs[d].offsetLeft <= x) && ((alldivs[d].offsetLeft+104)>=x)) {
	   		
		 return alldivs[d];
		}
	  }
   }

   return false;

}

$(document).ready(function(){
	//$("#hexagons #id12").hide();
	});
	
	function colorme ( rowno,  i) {
		
		var color;
		if (rowno%2 == 1){
						if (i%3== 1)
						color = "red";
						if (i%3 == 2)
						color = "blue";
						if (i%3 == 0)
						color = "green";
						}
		else {
						if (i%3 == 1)
						color = "green";
						if (i%3 == 2)
						color = "red";
						if (i%3 == 0)
						color = "blue";
			}
			var id = "id"+rowno+i;
			 document.getElementById(id).style.color = color;
			 var chil = document.getElementById(id).childNodes;
			 chil[3].style.backgroundColor = color;
			 //for (var i =0 ;i<chil.length; i++) {
			 //console.log(chil[i].nodeName);
			 //}
			alert("Assigned frequency: "+color);
						
	}
</SCRIPT>

</HEAD>
<BODY>
<DIV ID="DIV1" style="position:absolute;top:140;left:140;height:20;width:20;background-color:#000000; z-index:1;" data="javascript: imsi=Math.floor(Math.random()*100);">
<img src="dot.jpg" /><span id="imsi_id"></span></DIV>

<div id="hexagons" style="position:absolute; top: 0; left:0; z-index:0;">

<div class="hex-row">
<?php
addCells(9,1);
?>  
</div><!--class hex-row over-->

<!--2nd row begins-->

<div class="hex-row">  
        <div class="even" >
              <?php addCells(8,2);?>           
     	</div><!--class even over-->
</div><!--class hex-row over-->


<!--2nd row ends-->
<div class="hex-row">
<?php
addCells(9,3);
?>  
</div><!--class hex-row over-->
<div class="hex-row">  
        <div class="even" id="one">
              <?php addCells(8,4);?>           
     	</div><!--class even over-->
</div><!--class hex-row over-->
<div class="hex-row">
<?php
addCells(9,5);
?>  
</div> <!--id hexagons over-->



<!--<canvas id="mycanvas" height="75" width="105" style="position:absolute; top:220px; left:905px; background-color:white; z-index:0;"></canvas>-->
<div id="messages" style="position:absolute; left:1000px; top:0px">
<font size="+5">Messages:<br/></font></div>
<div id="printhere" style="position:absolute; left:1000px; top:100px; width:200;">
<font size="+5"><br/></font></div>
</BODY>
</HTML>