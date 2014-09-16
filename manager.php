<HTML>
<HEAD>
<TITLE>Manager</TITLE>
<script src="jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	setInterval(refreshDiv,1000);

	function refreshDiv(){
		$.ajax({
			url: 'getLogs.php',
			type: 'POST',
			data: '',
			success: function(data){
				$("#logs").text(data+"<br>");
			}
		})
	}
});
</script>
</HEAD>
<body>
<div id="logs"></div>
</body>
</HTML>