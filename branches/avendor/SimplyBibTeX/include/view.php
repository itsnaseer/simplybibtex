<?php
// ---------------------------------------------------------------------------
// Author: 			Hartmut Seichter
// Purpose:			BibTeX parser
// 
// ---------------------------------------------------------------------------

require_once('bibtex.php');
require_once('template.php');

class View {

	function View($title,$database, $templates)
	{

		$templates[viewer]->set("content",$database->render_all($templates[content]));
		$templates[viewer]->set("title",$title);
		$templates[viewer]->run();
	}
}

?>