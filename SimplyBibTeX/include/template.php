<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: template engine
// Description		: implements a very simple templating
// Author			: Hartmut Seichter
// Acknowledgement	: http://www.stargeek.com/scripts.php?script=10&cat=display
// License			: GPL
// CVS				: $Id$
// ---------------------------------------------------------------------------
    class Template
    {
        var $filename;
        var $content;
        var $output;
        
        function Template($file)
        {
			$this->filename = $file;
        }

        function set($name, $value)
        {
            $this->content[$name] = $value;
        }

        function make()
        {
            extract($this->content);
            ob_start();
            require($this->filename);
            $this->output = ob_get_contents();
            ob_end_clean();    
        }    
	
		function run()
		{
			$this->make();
			echo $this->output;
		}    
    }
?> 
