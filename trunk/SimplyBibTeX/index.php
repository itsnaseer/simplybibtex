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



function get_file_form($directory,$current)
{

	$menu .= '<form name="filelist" method="post" action="">';
	$menu .= '<select class="formitem" name="db" size="1" onchange="filelist.submit()">';

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

function get_search_form($directory,$current)
{
}


function get_rss_link($directory,$current)
{
	return $_PHP['SELF'].'?feed=rss2&amp;db='.$current;
};

function get_atom_link($directory,$current)
{
	return $_PHP['SELF'].'?feed=atom&amp;db='.$current;
};





$feed = $_GET['feed'];

if (!$feed)
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

	$templates[viewer]->set('time',date("r", time())); 
	$templates[viewer]->set('dbtime',date("r", filemtime($file))); 
	$templates[content]->set('dbtime',date("r", filemtime($file))); 

	$templates[viewer]->set('rss2',get_rss_link('bibs',$file));
	$templates[viewer]->set('atom',get_atom_link('bibs',$file));

	$templates[viewer]->set('selector',get_file_form('bibs',$file));


	$viewer = new View();


	$output = $viewer->get_html('BibTeX Viewer '.$file,$bib,$templates);

	

} else {

	$file = $_GET['db'];

	$bib = new BibTeX($file);
	$bib->parse();

	
	$output .= "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";

	if ($feed=='rss2')
	{
		$templates[viewer] = new Template('templates/rss_viewer.tpl');
		$templates[content] = new Template('templates/rss_item.tpl');
		header('Content-Type: text/xml');
	} elseif ($feed='atom') {
		$templates[viewer] = new Template('templates/atom_viewer.tpl');
		$templates[content] = new Template('templates/atom_item.tpl');
		header('Content-Type: application/xml');
	};

	$templates[viewer]->set('time',date("r", time())); 
	$templates[viewer]->set('dbtime',date("r", filemtime($file))); 
	$templates[content]->set('dbtime',date("r", filemtime($file))); 


	$viewer = new View();

	$output .= $viewer->get_rss('BibTeX Viewer '.$file,$bib,$templates,$_PHP['SELF']);
	
	header('Content-Length: ' . strlen($output));
	
};

echo $output;

?>
