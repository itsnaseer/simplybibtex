<?php 
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: example for the interface
// Description		: implements a very simple viewer interface
// Author			: Hartmut Seichter
// License			: GPL
// CVS				: $Id$
// ---------------------------------------------------------------------------



require_once('include/bibtex.php');
require_once('include/view.php');



function get_file_menu($directory,$current)
{

	$menu .= '<form name="filelist" method="post" action="">';
	$menu .= '<select name="db" size="1" onchange="filelist.submit()">';

	if ($dir = opendir($directory)) { 
		while (false !== ($file = readdir($dir))) 
		{
			if ($file != "." && $file != ".." && $file != "CVS") {

				$sel_html = ($directory .'/'. $file == $current) ? 'selected="selected"' : '';
				$menu .= '<option value="' . $file . '" ' . $sel_html . '>' . $file.'</option>'; 
				
			};
		} // while
	} // if
	closedir($dir);

	$menu .= '</select>';
	$menu .= '</form>';

	return $menu;
}

function get_search_menu($directory,$current)
{
}

function get_help_menu()
{
	$menu .= '<div id="menu_help" style="display:none">';
	$menu .= '</div>';

};

function get_rss_menu($directory,$current)
{
	$menu = '<a href="?rss=2&amp;db='.$current.'" target="_blank">RSS</a>';
	return $menu;	
};


function get_menu($directory,$current)
{
	$menu .= get_file_menu($directory,$current);
	$menu .= get_rss_menu($directory,$current);
	return $menu;
}

$rss = $_GET['rss'];

if (!$rss)
{
	$file = $_POST['db'];

	if (!$file)
		$file = $_GET['db'];

	if (!$file) 
		$file = 'bibs/example.bib';
	else 
		$file = 'bibs/' . stripslashes($file);


	$bib = new BibTeX($file);
	$bib->parse();

	$templates[viewer] = new Template('templates/viewer.tpl');
	$templates[content] = new Template('templates/simple.tpl');

	$viewer = new View();


	$output = $viewer->get_html('BibTeX Viewer '.$file,$bib,$templates,get_menu('bibs',$file));

	

} else {

	$file = $_GET['db'];

	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";

	$bib = new BibTeX($file);
	$bib->parse();

	$templates[viewer] = new Template('templates/rss_viewer.tpl');
	$templates[content] = new Template('templates/rss_item.tpl');

	$viewer = new View();

	$output = $viewer->get_rss('BibTeX Viewer '.$file,$bib,$templates,"http://www.technotecture.com");
	
};

echo $output;

?>
