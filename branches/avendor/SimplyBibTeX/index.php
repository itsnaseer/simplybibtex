<?php 

require_once('include/bibtex.php');
require_once('include/view.php');

$bib = new BibTeX();

$file = $_GET['db'];

if (!$file) 
	$file = 'bibs/example.bib';
else 
	$file = 'bibs/' . stripslashes($file) . '.bib';

$bib->parse($file);

$templates[viewer] = new Template('templates/viewer.tpl');
$templates[content] = new Template('templates/simple.tpl');


$viewer = new View('BibTeX Viewer',$bib,$templates);


?>
