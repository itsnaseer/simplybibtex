<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="alternate" type="application/rss+xml" title="RSS for <?=$title?>" href="<?=$rss2?>"/>
		<link rel="alternate" type="application/atom+xml" title="Atom for <?=$title?>" href="<?=$atom?>"/>

		<title><?=$title?></title>
		<script type="text/javascript">
			function changeClass(id,newclass) {
				document.getElementById(id).className = newclass;
			}
			function toggle(id) {
				if (document.getElementById(id).className == 'hidden') {
					document.getElementById(id).className = 'visible';
				} else {
					document.getElementById(id).className = 'hidden';
				}
					
			}
		</script>
		<style type="text/css">
			* {
				margin: 0;
				padding: 0;
			}
			body {
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				margin: 1em 0;
				padding: 0;
				text-align: center;	
			}
			h2 {
				font: bold 9pt "Lucida Grande", Arial, Helvetica, sans-serif;
			}
			h3 {
				font: bold 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
			}
			a {
				color: black;
			}
				
			.hidden {
				display: none;
			}
			.visible {
				display: block;
			}
			.extended {
				background-color: #eff;
				padding: 0.5em;
				margin:0.2em;
				border: 1px #999 solid;
			}
			.item {				
				padding:0.5em;
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: black;
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
			#header {
				font: bold 12pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: white;
				padding: 1em;
				background-color: #e33;
			}
			#content {
				clear:both;
			}

			#container {
				width: 600px;
				margin: 0px auto;
				padding:1em;			
				text-align: left;
			}
			#footer {
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: white;
				padding: 0.5em;
				background-color: #999;
			}		
			#footer a {
				color: white;
			}
			#menu {
				background-color: #666;
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: white;
				padding:0.75em;
				clear:both;
				border-bottom: 
			}
			#menu a {
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: white;
			}
			#menu form {
				vertical-align: top;
				margin: 0;
			}
			#help {
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: #666;
				background-color: #ffe;
			}
			#metaform {
				background-color: #ffe;
				padding:1em;
			}
			#searchform {
				background-color: #ffe;
				padding:1em;
			}
			#uploadform {
				background-color: #fee;
				padding:1em;
			}
			#filelist {
				border:0;
				display:inline;
				float:right;
			}
			.item_menu {
				background-color: #999;
				font: normal 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
				color: white;
				padding: 0.5em;
			}
			.item_menu a {
				color: white;
				text-decoration : none;
				font: bold 8pt "Lucida Grande", Arial, Helvetica, sans-serif;
			}
			.item_extended {
				background-color: #efe;
				color: black;
				border: 1px solid #999;
				padding:0.5em;
			}
			.comment {
				background-color: #eee;
				
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="header">
				SimplyBibTeX
			</div>
			<div id="menu">
				<?=$form_select?>&nbsp;&nbsp;&nbsp;&nbsp;
				<span title="Click to search the database" onclick="javascript:toggle('searchform');">Search</span> |
				<span title="Upload your BibTeX file" onclick="javascript:toggle('uploadform');">Upload</span> |
				<span title="edit meta information" onclick="javascript:toggle('metaform');">Meta</span> |
				<span title="Learn more about SimplyBibTeX" onclick="javascript:toggle('help');">Help</span>
				
				<div id="searchform" class="hidden">
					<?=$form_search?>
				</div>
				<div id="uploadform" class="hidden">
					<?=$form_upload?>
				</div>
				<div id="metaform" class="hidden">
					<?=$form_meta?>
				</div>
				<div id="help" class="hidden">
					<?=$sbx_help?>
				</div>
				
			</div>
			<div id="content">
				<?=$content?>
			</div>
			<div id="footer">
				SimplyBibTeX <?=$sbx_version?> &copy; Copyrights 2005, Hartmut Seichter | <a title="valid XHTML 1.0" href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a title="valid Cascading Style Sheets" href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a title="RSS 2.0 Feed" href="<?=$rss2?>">RSS</a> | <a title="Atom Feed" href="<?=$atom?>">Atom</a>
			</div>
		</div>
	</body>
</html>
