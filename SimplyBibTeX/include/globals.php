<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: global settings for the core system
// Description		: configuration settings
// Author			: Hartmut Seichter
// License			: GPL
// CVS				: $Id$
// 

/* credits and internal versioning */
$cfg['major'] 					= '0';
$cfg['minor'] 					= '1';
$cfg['build'] 					= '2';
$cfg['version'] 				= "$cfg[major].$cfg[minor].$cfg[build]";
$cfg['web_url'] 				= 'http://www.technotecture.com/software/SimplyBibTeX/';
$cfg['helpfile']				= 'docs/help.inc';

/* default settings */
$cfg['library']		= "bibs";
$cfg['uploads'] 	= "uploads";
$cfg['database'] 	= "$cfg[uploads]/Hoover.bib";


/* change that if you do not want to include uploaded libaries */
$cfg['libraries'] = "$cfg[library],$cfg[uploads]";

/* include with the local configuration */
// @require_once('..\config.inc');

?>
