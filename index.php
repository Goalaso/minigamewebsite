<html>
	<head>
		<title>Minesweeper</title>
		<script type="text/javascript" src="function.js"></script>
		<script type="text/javascript" src="class.js"></script>
	</head>
	
	<body onload="avoid_image_loading_delay()">
		<button id="start">Start</button>&nbsp;&nbsp;&nbsp;&nbsp;
		<span id="game_over" style="display: none">Game Over</span>
		<br/><br/>
		<script>
		<?php 
		  $rows = 15;
		  $cols = 15;
		  $prob = .1;
		  
		  if (isset($_GET["rows"])) $rows = $_GET["rows"];
		  if (isset($_GET["cols"])) $cols = $_GET["cols"];
		  if (isset($_GET["prob"])) $prob = $_GET["prob"];
		?>
			let game = new Minesweeper(<?php echo $rows; ?>, <?php echo $cols; ?>, <?php echo $prob; ?>);
			game.init_board();
			game.flood_fill();
		</script>
	</body>
</html>
