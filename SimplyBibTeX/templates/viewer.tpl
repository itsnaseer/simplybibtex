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
			body {
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				margin: 1em 0;
				padding: 0;
				text-align: center;	
			}
			a {
				color: black;
			}
				
			.hidden {
				display: none;
			}
			.visible {
				display: block;
				background-color: #eff;
				padding: 0.5em;
				margin:0.2em;
				border: 1px #999 solid;
			}
			.item {
				font: 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				padding:0.5em;#submenu a {
				font: bold 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: white;
			}
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
				margin: 0px auto;
				padding:1em;			
				text-align: left;
			}
			#header {
				font: bold 12pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: white;
				padding: 1em;
				background-color: #e33;
			}
			#footer {
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: #333;
				padding: 0.5em;
				background-color: #ffe;
			}			
			#submenu {
				background-color: #666;
				font: bold 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: white;
				padding:0.75em;
			}
			#submenu a {
				font: bold 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: white;
			}
			#submenu form {
				padding: 0;
				vertical-align: top;
				margin: 0;
			}
			#help {
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: #666;
				background-color: #ffe;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="header">
				SimplyBibTeX
			</div>
			<div id="submenu">
				<div style="float:left;clear:right">
					<?=$form_select?>
				</div>&nbsp;
				<span onclick="javascript:toggle('uploadform');">Upload</span> |
				<span onclick="javascript:toggle('metaform');">Meta</span> |
				<span onclick="javascript:toggle('help');">Help</span> |
				<a href="<?=$rss2?>">RSS</a> | <a href="<?=$atom?>">Atom</a>
				<div id="uploadform" class="hidden">
					Upload your own BibTeX files here.
					<?=$form_upload?>
				</div>
				<div id="metaform" class="hidden">
					<?=$form_meta?>
				</div>
				<div id="help" class="hidden">
						<?=$sbx_help?>
				</div>
			</div>
				<?=$content?>
			<div id="footer">
				SimplyBibTeX <?=$sbx_version?> &copy; Copyrights 2005, Hartmut Seichter | <a href="http://validator.w3.org/check?uri=referer">XHTML 1.0</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
			</div>
		</div>
	</body>
</html>
