<?php 

require_once('include/bibtex.php');
require_once('include/view.php');


function get_menu($directory)
{
	$count = 0;
	if ($dir = opendir($directory)) { 
		while (false !== ($file = readdir($dir))) 
		{
			if ($file != "." && $file != "..") {
           		$filelist[$count] = $file;
				$count++;
			};
		} // while
	} // if
	closedir($dir);
	$menu .= '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '">';

	$menu .= '<select="filename">';
	for ($i = 0; $i < $count; $i++) {
		$menu .= '<option value="' . $filelist[$i] . '">'.$filelist[$i].'</option>'; 
	}
	$menu .= '</select>';
	$menu .= '<input type="submit" name="Select">';
	$menu .= '</form>';

	return $menu;
}


$file = $_POST['filename'];

if (!$file) 
	$file = 'bibs/example.bib';
else 
	$file = 'bibs/' . stripslashes($file);


$bib = new BibTeX($file);
$bib->parse();

$templates[viewer] = new Template('templates/viewer.tpl');
$templates[content] = new Template('templates/simple.tpl');

$viewer = new View('BibTeX Viewer',$bib,$templates,get_menu('bibs'));


?>
