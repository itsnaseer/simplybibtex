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
			}
			.item {
				font: normal 9pt Helvetica, Arial;
				padding: 1em;
				border-bottom: 1px #CCCCCC solid;
			}
			.odd {
				background-color: #eee;
			}
			.even {
				background-color: #ddd;
			}
		</style>
	</head>
	<body>
		<?=$content?>
	</body>
</html>
