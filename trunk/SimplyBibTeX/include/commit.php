<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: handles uploading and changing internal settings
// Description		: configuration settings
// Author			: Hartmut Seichter
// License			: GPL
// CVS				: $Id$
//

require_once('globals.php');

/* check if we have a command posted */
$command = $_POST['command'];
$location = '';

if ($command == 'upload')
{
	$name = $HTTP_POST_FILES['userfile']['name'];
	$size = $HTTP_POST_FILES['userfile']['size'];
	$tmp  = $HTTP_POST_FILES['userfile']['tmp_name'];
	$type = $HTTP_POST_FILES['userfile']['type'];
	$error= $HTTP_POST_FILES['userfile']['error'];

	global $cfg;

	if ($error == 0)
	{
		move_uploaded_file($tmp,'../' . $cfg['uploads'] . '/' . $name);
		/* maybe load it directly? */
		$location = '../';

	} else 
	{
		/* some kind of error */
	}
} elseif ($command == 'refresh_meta') {
	$fp = fopen('../'.$_POST['db'] . '.meta','w+');
	if ($fp) {
		fwrite($fp,$_POST['meta']);
		fclose($fp);
	};

	$location = '../';

}

header('Location: '.$location);
?>
