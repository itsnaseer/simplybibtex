<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module		: keeps all important functions
// Description	: just usual stubs functions
// Author		: Hartmut Seichter
// License		: GPL
// CVS			: $Id$
// ---------------------------------------------------------------------------

function get_post($name,$default)
{
	if (isset($_POST[$name]))
		return $_POST[$name];
	return $default;
};

function get_get($name,$default)
{
	if (isset($_GET[$name]))
		return $_GET[$name];
	
	return $default;		
};


?>
