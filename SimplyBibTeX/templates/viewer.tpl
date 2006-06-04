<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<link rel="alternate" type="application/rss+xml" title="RSS for <?php echo $title;?>" href="<?php echo $rss2;?>"/>
		<link rel="alternate" type="application/atom+xml" title="Atom for <?php echo $title;?>" href="<?php $atom;?>"/>

		<title><?php echo $title;?></title>
		<script language="javascript" type="text/javascript" src="templates/js/interaction.js"></script>
		
		<link rel="stylesheet" type="text/css" href="templates/css/default.css" />
	</head>
	<body>
		<div id="container">
			<div id="header">
				SimplyBibTeX
			</div>
			<table id="menu">
				<tr>
					<td>
						<span class="menu_item" title="Add an item to this database" onclick="javascript:toggle('additemform');">Add</span> |
						<span class="menu_item" title="Click to search the database" onclick="javascript:toggle('searchform');">Find</span> |
						<span class="menu_item" title="Upload your BibTeX file" onclick="javascript:toggle('uploadform');">Upload</span> |
						<span class="menu_item" title="Learn more about SimplyBibTeX" onclick="javascript:toggle('help');">Help</span> |
						<a href="<?php echo $baselink;?>?db=<?php echo $file;?>" class="menu_item" title="Show all items in the database">Show All</span>
					</td>
					<td>
						<span style="background:#eee"><?php echo $form_select;?></span>
					</td>
				</tr>
			</table>
			<div>
				<div id="additemform" class="hidden">
					<?php echo $form_additem;?>
				</div>
				<div id="searchform" class="hidden">
					<?php echo $form_search;?>
				</div>
				<div id="uploadform" class="hidden">
					<?php echo $form_upload;?>
				</div>
				<div id="metaform" class="hidden">
					
				</div>
				<div id="help" class="hidden">
					<?php echo $sbx_help;?>
				</div>
			</div>
			
			<ul id="content">
				<?php echo $content;?>
			</ul>

			<div id="footer">
				SimplyBibTeX <?php echo $sbx_version;?> &copy; Copyrights 2005, Hartmut Seichter | <a title="valid XHTML 1.0" href="http://validator.w3.org/check?uri=referer">XHTML</a> | <a title="valid Cascading Style Sheets" href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a title="RSS 2.0 Feed" href="<?php echo $rss2;?>">RSS</a> | <a title="Atom Feed" href="<?php echo $atom;?>">Atom</a>
			</div>
		</div>
	</body>
</html>
