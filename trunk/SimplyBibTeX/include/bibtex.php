<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: bibtex parser class
// Description		: generates a 2d array of all bibtex items 
// Author			: Hartmut Seichter
// Acknowledgement	: Zhe Wu at Univ. of Rochester, http://qcite.com
// License			: GPL
// CVS				: $Id$
// ---------------------------------------------------------------------------

require_once('template.php');


class BibTeX 
{

	var $count;
	var $items;
	var $types;
	var $filename;

	var $pagefrom, $pageto;

	function BibTeX($file) {
		$this->items = array(
			'note' => array(),
			'abstract' => array(),
			'year' => array(),
			'group' => array(),
			'publisher' => array(),
			'page-start' => array(),
			'page-end' => array(),
			'pages' => array(),
			'address' => array(),
			'url' => array(),
			'volume' => array(),
			'chapter' => array(),
			'journal' => array(),
			'author' => array(),
			'raw' => array(),
			'title' => array(),
			'booktitle' => array(),
			'folder' => array(),
			'type' => array());
		
		$this->filename = $file;
	}
	

function parse() {
	
	$value = array();
	$var = array();

	$this->count=-1;
	$lineindex = 0;

	$fieldcount = -1;
	
	$lines = file($this->filename);
	
	foreach($lines as $line) {
	
		$lineindex++;
		
		$line = trim($line);

		$raw_line = $line + '\n';
		
		$line=str_replace("'","`",$line);
		$seg=str_replace("\"","`",$line);
		
		$ps=strpos($seg,'=');

		$segtest=strtolower($seg);
		
		// some funny comment string		
		if (strpos($segtest,'@string')!==false) {continue;}

		// pybliographer comments
		if (strpos($segtest,'@comment')!==false) {continue;}

		// normal TeX style comment
		if (strpos($seg,'%%')!==false) {continue;}
		
		/* ok when there is nothing to see, skip it! */
		if (!strlen($seg)) continue;
		
		if ("@" == $seg[0]) {
            $this->count++;
			$this->items['raw'][$this->count] = $line; 

            $ps=strpos($seg,'@');	
            $pe=strpos($seg,'{');

            $this->types[$this->count]=trim(substr($seg, 1,$pe-1));

            $fieldcount=-1; 
        } // #of item increase
        elseif ($ps!==false ) { // one field begins
				$this->items['raw'][$this->count] .= $line; 

                $ps=strpos($seg,'=');

                $fieldcount++;				

                $var[$fieldcount]=strtolower(trim(substr($seg,0,$ps)));

                if ($var[$fieldcount]=='pages') {
						$ps=strpos($seg,'=');
						$pm=strpos($seg,'--');
                        $pe=strpos($seg,'},');
                        
                        $pagefrom[$this->count] = substr($seg,$ps,$pm-$ps);
						$pageto[$this->count]=substr($seg,$pm,$pe-$pm);

						$bp=str_replace('=','',$pagefrom[$this->count]); $bp=str_replace('{','',$bp);$bp=str_replace('}','',$bp);$bp=trim(str_replace('-','',$bp));

        				$ep=str_replace('=','',$pageto[$this->count]); $bp=str_replace('{','',$bp);$bp=str_replace('}','',$bp);;$ep=trim(str_replace('-','',$ep));
                }

                $pe=strpos($seg,'},');

                if ($pe===false) { 
					$value[$fieldcount]=strstr($seg,'='); 
				} else {
					$value[$fieldcount]=substr($seg,$ps,$pe);
				}

			} else {

				$pe=strpos($seg,'},');
				
				if ($fieldcount > -1) {
					if ($pe===false) {
						$value[$fieldcount].=' '.strstr($seg,' '); 
					} else { 
						$value[$fieldcount] .=' '.substr($seg,$ps,$pe);
					}
				}
			}


			if ($fieldcount > -1) {
				$v = $value[$fieldcount];
	
				$v=str_replace('=','',$v);	
				$v=str_replace('{','',$v);	
				$v=str_replace('}','',$v);	
				$v=str_replace(',',' ',$v);	
				$v=str_replace('\'',' ',$v);	
				$v=str_replace('\"',' ',$v);	
				$v=trim($v);
				
				$this->items["$var[$fieldcount]"][$this->count]="$v";
			}       	

        }
	} // parse


	function set(&$template,$name,$id,$default,$encode,$trans) {
	
		$template->set($name,(isset($this->items[$name][$id])? ($encode) ? strtr($this->items[$name][$id],$trans) : $this->items[$name][$id] : $default));

	}

	function render_all($template,$encode,$fallbacks)
	{
		$trans = get_html_translation_table(HTML_ENTITIES);
		$output = NULL;
		
		for ($i = 0; $i <= $this->count; $i++)
		{
			if (!isset($this->items['raw'][$i])) continue;
			
			// fill the template engine with the respective values
			$template->set("type",$this->types[$i]);
			
			if ($i % 2) 
				$template->set("oddeven","odd");
			else
				$template->set("oddeven","even");

			$template->set("number",$i);

			$this->set($template,'journal',		$i,"",$encode,$trans);
			$this->set($template,'booktitle',	$i,"",$encode,$trans);
			$this->set($template,'author',		$i,"",$encode,$trans);
			$this->set($template,'volume',		$i,"",$encode,$trans);
			$this->set($template,'chapter',		$i,"",$encode,$trans);
			$this->set($template,'url',			$i,$fallbacks['url'],$encode,$trans);
			$this->set($template,'note',		$i,"",$encode,$trans);
			$this->set($template,'abstract',	$i,"",$encode,$trans);
			$this->set($template,'year',		$i,"",$encode,$trans);
			$this->set($template,'folder',		$i,"",$encode,$trans);
			$this->set($template,'publisher',	$i,"",$encode,$trans);
			$this->set($template,'page-start',	$i,"",$encode,$trans);
			$this->set($template,'page-end',	$i,"",$encode,$trans);
			$this->set($template,'pages',		$i,"",$encode,$trans);
			$this->set($template,'address',		$i,"",$encode,$trans);
			$this->set($template,'raw',			$i,"",$encode,$trans);
			$this->set($template,'title',		$i,"",$encode,$trans);

			$template->make();

			$output .= $template->output;
		}
		return $output;
	}

	function render_id($template,$encode,$id)
	{
		$output = NULL;

		$trans = get_html_translation_table(HTML_ENTITIES);

		// fill the template engine with the respective values
		$template->set("type",$this->types[$id]);
		
		if ($id % 2) 
			$template->set("oddeven","odd");
		else
			$template->set("oddeven","even");

		$template->set("number",$id);

		$this->set($template,'journal',		$id,"",$encode,$trans);
		$this->set($template,'booktitle',	$id,"",$encode,$trans);
		$this->set($template,'author',		$id,"",$encode,$trans);
		$this->set($template,'volume',		$id,"",$encode,$trans);
		$this->set($template,'chapter',		$id,"",$encode,$trans);
		$this->set($template,'url',			$id,"",$encode,$trans);
		$this->set($template,'note',		$id,"",$encode,$trans);
		$this->set($template,'abstract',	$id,"",$encode,$trans);
		$this->set($template,'year',		$id,"",$encode,$trans);
		$this->set($template,'folder',		$id,"",$encode,$trans);
		$this->set($template,'publisher',	$id,"",$encode,$trans);
		$this->set($template,'page-start',	$id,"",$encode,$trans);
		$this->set($template,'page-end',	$id,"",$encode,$trans);
		$this->set($template,'pages',		$id,"",$encode,$trans);
		$this->set($template,'address',		$id,"",$encode,$trans);
		$this->set($template,'raw',			$id,"",$encode,$trans);

		$template->make();

		$output .= $template->output;

		return $output;
	}
}

?>
