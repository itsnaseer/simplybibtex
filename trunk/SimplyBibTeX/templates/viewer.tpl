<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?=$rss2?>"/>
		<link rel="alternate" type="application/atom+xml" title="Atom" href="<?=$atom?>"/>

		<title><?=$title?></title>
		<script type="text/javascript">
			function changeClass(id,newclass) {
				document.getElementById(id).className = newclass;
			}
			function toggle(id) {
				if (document.getElementById(id).className == 'visible') {
					document.getElementById(id).className = 'hidden';
				} else {
					document.getElementById(id).className = 'visible';
				}
					
			}
		</script>
		<style type="text/css">
			.hidden {
				display: none;
			}
			.visible {
				display: block;
				background-color: #eff;
				padding: 0.5em;
				margin:0.2em;
				border: 1px #eee solid;
			}
			.item {
				font: 8pt "Lucida Grande", Tahoma, Helvetica, sans-serif;
				padding:0.5em;
				border-bottom: 1px #ccc solid;
				border-top: 1px #fff solid;
			}
			.odd {
				background-color: #eee;
			}
			.even {
				background-color: #ddd;
			}
			.formitem {
				background-color: #666;
				color: white;
			}
			#menu {
				color: white;
				margin: 0;
				background-color: #666;
				border-top: 1px #600 solid;
			}

			#container {
				width: 600px;
				margin-left: auto;
				margin-right: auto;
			}
			#header {
				font: bold 12pt "Lucida Grande", Tahoma, Helvetica, sans-serif;
				color: white;
				padding: 1em;
				background-color: #e33;
			}
			#footer {
				font: normal 6pt "Lucida Grande", Tahoma, Helvetica, sans-serif;
				color: white;
				padding: 0.5em;
				background-color: #666;
			}
			#footer a {
				font: bold 6pt "Lucida Grande", Tahoma, Helvetica, sans-serif;
				color: white;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="header">
				SimplyBibTeX
			</div>
			<div id="menu">
				<?=$selector?>
			</div>
			<?=$content?>
			<div id="footer">
				<a href="<?=$rss2?>">RSS</a> | <a href="<?=$atom?>">Atom</a> | SimplyBibTeX &copy; Copyrights 2005, Hartmut Seichter | <?=$time?>
			</div>
		</div>
	</body>
</html>
