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

		$templates[viewer]->set("content",$database->render_all($templates[content]));
		$templates[viewer]->set("title",$title);
		$templates[viewer]->set("menu",$menu);

		$templates[viewer]->run();
	}
}

?>
