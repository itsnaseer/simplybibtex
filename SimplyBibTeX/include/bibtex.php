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
			'type' => array(),
			'linebegin' => array(),
			'lineend' => array());
		
		$this->filename = $file;
	}
	

function parse() {
	
	$value = array();
	$var = array();

	$this->count=-1;
	$lineindex = 0;

	$fieldcount = -1;
	
	$lines = file($this->filename);

	if (!$lines) return;
	
	foreach($lines as $line) {
	
		$lineindex++;
		
		$this->items['lineend'][$this->count] = $lineindex; 
		
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
			$this->items['raw'][$this->count] = $line . "\r\n"; 

            $ps=strpos($seg,'@');	
            $pe=strpos($seg,'{');

            $this->types[$this->count]=trim(substr($seg, 1,$pe-1));

            $fieldcount=-1; 
            
            $this->items['linebegin'][$this->count] = $lineindex;
            
            
        } // #of item increase
        elseif ($ps!==false ) { // one field begins
        
				$this->items['raw'][$this->count] .= $line . "\r\n"; 

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
				$this->items['raw'][$this->count] .= $line . "\r\n"; 
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
				
				// test!
				$v=str_replace('`',' ',$v);
					
				$v=trim($v);
				
				$this->items["$var[$fieldcount]"][$this->count]="$v";
			}       	

        }
	} // parse


	function set(&$template,$name,$id,$default,$encode,$trans) {
	
		$template->set($name,(isset($this->items[$name][$id])? ($encode) ? strtr($this->items[$name][$id],$trans) : $this->items[$name][$id] : $default));

	}
	function render_id(&$template, $encode, $id, &$trans)
	{
		$output = NULL;

		if ($encode && !$trans)
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
		$this->set($template,'url',			$id,"",$encode,$trans);
		$this->set($template,'title',		$id,"",$encode,$trans);
		$this->set($template,'linebegin',	$id,"",$encode,$trans);
		$this->set($template,'lineend',		$id,"",$encode,$trans);

		$template->fetch(true);

		$output .= $template->output;

		return $output;
	}
	
	function render_search(&$template, $encode, $fallbacks, $search)
	{
		$output = NULL;
		$atoms = explode('=',$search);

		for ($i = 0; $i <= $this->count; $i++ ) {
			
			if (isset($this->items[$atoms[0]][$i]))
						

				if (strstr($this->items[$atoms[0]][$i],$atoms[1])) {
					
					$output .= $this->render_id($template,$encode,$i,$trans);
				
				}
		}	
		
		return $output;
		
	}


	function render_all(&$template, $encode, $fallbacks, &$trans)
	{	
		$output = NULL;
		
		for ($i = 0; $i <= $this->count; $i++)
		{
			
			$output .= $this->render_id($template,$encode,$i,$trans);
			
		}
		return $output;
	}
}

?>
