<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module		: viewer class
// Description	: wrapps the rendering and templating
// Author		: Hartmut Seichter
// License		: GPL
// CVS			: $Id$
// ---------------------------------------------------------------------------

require_once('bibtex.php');
require_once('template.php');

class View {

	function View($title,$database, $templates, $menu)
	{

		$content = $database->render_all($templates[content],$encode);

		$templates[viewer]->set("content",$content);
		$templates[viewer]->set("title",$title);
		$templates[viewer]->set("menu",$menu);

		$templates[viewer]->run();
	}
}

?>
