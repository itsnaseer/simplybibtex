<html>
	<head>
		<title><?=$title?></title>
		<script language="javaScript">
			function changeClass(element,newclass) {
				element.className = newclass;
			}
		</script>
		<style type="text/css">
			.hidden {
				display: none;
			}
			.visible {
				display: block;
				background-color: #eff;
				padding: 1em;
				margin:0.2em;
			}
			.item {
				font: normal 9pt Verdana, "Lucida Grande", Tahoma, Helvetica;
				padding: 1em;
				border-bottom: 1px #CCCCCC solid;
			}
			.odd {
				background-color: #eee;
			}
			.even {
				background-color: #ddd;
			}
			#menu {
				background-color: #e33;
				padding:0.5em;
			}
		</style>
	</head>
	<body>
		<div id="header">

		</div>
		<div id="menu">
			<?=$menu?>
		</div>
		<?=$content?>
	</body>
</html>
