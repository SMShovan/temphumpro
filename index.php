<html>

<head>
<title>Temperatures</title>
<style type="text/css">
			#chart-container {
				
				height: auto;
			}
		</style>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
</head>

<body position="relative">
	<div id="clouds">
	<div class="cloud x1"></div>
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div> 
        </div>
	<div id="show"></div>
	<script type="text/javascript">
                $(document).ready(function(){
                        setInterval(function(){
				$('#show').load('data.php')
			},1000);
                });
        </script>

	<div id="chart-container" margin="auto" width="75%">
			<canvas id="mycanvas" bottom="0px" height ="100px" margin="auto"></canvas>
		</div>
</body>

<footer>
	<script>
                if( new Date().getHours() >20)
 			document.getElementById('clouds').setAttribute("style","background: -webkit-linear-gradient(top, #062433 0%, #fff 100%)");

 		else if( new Date().getHours() >16)
 			document.getElementById('clouds').setAttribute("style","background: -webkit-linear-gradient(top, #8bb73b 0%, #fff 100%)");

 		else if( new Date().getHours() >12)
 			document.getElementById('clouds').setAttribute("style","background: -webkit-linear-gradient(top, #c9dbe9 0%, #fff 100%)");
 		else if( new Date().getHours() >10)
 			document.getElementById('clouds').setAttribute("style","background: -webkit-linear-gradient(top, #fffd8f 0%, #fff 100%)");
 		else if( new Date().getHours() >6)
 			document.getElementById('clouds').setAttribute("style","background: -webkit-linear-gradient(top, #ccc928 0%, #fff 100%)");
 		else
 			document.getElementById('clouds').setAttribute("style","background: -webkit-linear-gradient(top, #062433 0%, #fff 100%)");
	</script>
</footer>
</html>
