<?php
/*
    An extremely simple template system that uses either
    <?php echo $var; ?>
    or
    <?=$var?>
    value placeholders.

	http://www.stargeek.com/scripts.php?script=10&cat=display
*/
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
