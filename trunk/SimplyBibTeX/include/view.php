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

	function View() {}


	function get_html($title, $database, $templates, $menu)
	{

		$encode = TRUE;

		$content = $database->render_all($templates[content],$encode,$NULL);

		$templates[viewer]->set("content",$content);
		$templates[viewer]->set("title",$title);
		$templates[viewer]->set("menu",$menu);

		$templates[viewer]->make();

		return $templates[viewer]->output;
	}

	function get_rss($title, $database, $templates, $link)
	{
		
		$fallbacks = array('url'=>'http://www.technotecture.com'
		);

		$encode = TRUE;

		$content = $database->render_all($templates[content],$encode,$fallbacks);

		$templates[viewer]->set("content",$content);
		$templates[viewer]->set("title",$title);
		$templates[viewer]->set("link",$link);

		$templates[viewer]->make();

		return $templates[viewer]->output;
	}
}

?>
