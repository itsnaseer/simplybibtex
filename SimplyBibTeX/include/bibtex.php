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


// $support_tags = array ('raw')

class BibTeX 
{

	var $count;
	var $items;
	var $types;
	var $filename;

	var $pagefrom, $pageto;

	function BibTeX($file) {
		$this->items = array('note' => array(),
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
			'folder' => array());
		
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
	
		// echo $line . '</br>';
	
		$lineindex++;
		
		$line = trim($line);

		$raw_line = $line;
		
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
		
		// echo '['.$seg[0].']['.$seg.']';
        // if (isset($seg[0])) {
 			if ("@" == $seg[0]) {
 			
				
                $this->count++;
				$this->items['raw'][$this->count] = $line; 

                $ps=strpos($seg,'@');	
                $pe=strpos($seg,'{');

                $this->types[$this->count]=trim(substr($seg, 1,$pe-1));

                $fieldcount=-1; 
				// -------------------------reset field count
	        } // #of item increase
		// } 
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

				if ($pe===false) {
						$value[$fieldcount].=' '.strstr($seg,' '); 
				} else { 
					$value[$fieldcount] .=' '.substr($seg,$ps,$pe);
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


	function set(&$template,$name,$id,$default) {
		$template->set($name,(isset($this->items[$name][$id])? $this->items[$name][$id] : $default));
	}

	function render_all($template,$encoded,$fallbacks)
	{
		$trans = get_html_translation_table(HTML_ENTITIES);
		$output = NULL;
				
		// print_r($this->items);
		
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

			$this->set($template,'journal',		$i,"");
			$this->set($template,'booktitle',	$i,"");
			$this->set($template,'author',		$i,"");
			$this->set($template,'volume',		$i,"");
			$this->set($template,'chapter',		$i,"");
			$this->set($template,'url',			$i,$fallbacks['url']);
			$this->set($template,'note',		$i,"");
			$this->set($template,'abstract',	$i,"");
			$this->set($template,'year',		$i,"");
			$this->set($template,'folder',		$i,"");
			$this->set($template,'publisher',	$i,"");
			$this->set($template,'page-start',	$i,"");
			$this->set($template,'page-end',	$i,"");
			$this->set($template,'pages',		$i,"");
			$this->set($template,'address',		$i,"");
			$this->set($template,'raw',	$i,		"");
		
			
			$template->set("title",strtr($this->items['title'][$i],$trans));

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

		$template->set("journal",$this->items[journal][$id].$this->items[booktitle][$id]);
		$template->set("author",$this->items['author'][$id]);
		$template->set("title",strtr($this->items[title][$id],$trans));
		$template->set("volume",$this->items[volume][$id].$this->items[chapter][$id]);

		if ($this->items[url][$id])
		{
			$template->set("url",$this->items[url][$id]);
		} else
		{
			$template->set("url",$fallbacks[url]);
		}
		$template->set("note",$this->items[note][$id]);
		$template->set("abstract",$this->items['abstract'][$id]);
		$template->set("year",$this->items[year][$id]);
		$template->set("group",$this->items[folder][$id]);
		$template->set("publisher",$this->items[publisher][$id]);
		$template->set("page-start",$this->items[page-start][$id]);
		$template->set("page-end",$this->items[page-end][$id]);		
		$template->set("pages",$this->items[pages][$id]);
		$template->set("address",strtr($this->items[address][$id],$trans));
		$template->set("raw",strtr($this->items['raw'][$id],$trans));

		$template->make();

		$output .= $template->output;

		return $output;
	}
}

?>

