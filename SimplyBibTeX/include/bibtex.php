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
	var $fid;

	var $pagefrom, $pageto;

	function BibTeX($file) {
		$this->fid=fopen ($file,'r');
		if (!$this->fid) 
		{	
			return null;
		}		
	}
	

function parse()
{
	if (!$this->fid) return NULL;
	
	$this->count=-1;

	$lineindex = 0;

	while(1) 
	{
		$lineindex++;

		if (feof($this->fid)){break;}
		$line=trim(fgets($this->fid,10240));

		$raw_line = $line;

		$line=str_replace("'","`",$line);
		$seg=str_replace("\"","`",$line);
		$ps=strpos($seg,'=');
		$segtest=strtolower($seg);
		if (strpos($segtest,'@string')!==false) {continue;}
		
		// pybliographer comments
		if (strpos($segtest,'@comment')!==false) {continue;}

		if (strpos($seg,'%%')!==false) {continue;}
        
		if ($seg[0]=='@')
        {
                $this->count++;
				$this->items[raw][$this->count] .= $raw_line; 
                $ps=strpos($seg,'@');
                $pe=strpos($seg,'{');
                $this->types[$this->count]=trim(substr($seg, 1,$pe-1));
                $fieldcount=-1; // -------------------------reset field count
        } // #of item increase
        elseif ($ps!==false ) // one field begins
        {
				$this->items[raw][$this->count] .= $raw_line; 
                $ps=strpos($seg,'=');
                $fieldcount++;
				
                $var[$fieldcount]=strtolower(trim(substr($seg,0,$ps)));
                if ($var[$fieldcount]=='pages')
                {
                        $ps=strpos($seg,'=');
                        $pm=strpos($seg,'--');
                        $pe=strpos($seg,'},');

                        $pagefrom[$this->count] = substr($seg,$ps,$pm-$ps);
						$pageto[$this->count]=substr($seg,$pm,$pe-$pm);

						$bp=str_replace('=','',$pagefrom[$this->count]); $bp=str_replace('{','',$bp);$bp=str_replace('}','',$bp);$bp=trim(str_replace('-','',$bp));
        				$ep=str_replace('=','',$pageto[$this->count]); $bp=str_replace('{','',$bp);$bp=str_replace('}','',$bp);;$ep=trim(str_replace('-','',$ep));
                }
                $pe=strpos($seg,'},');
                if ($pe ===false)
                { $value[$fieldcount]=strstr($seg,'='); }
                else
				{ $value[$fieldcount]=substr($seg,$ps,$pe);}
			}
			else
			{
				$pe=strpos($seg,'},');

				if ($pe ===false)
					{ $value[$fieldcount].=' '.strstr($seg,' '); }
				else
					{ $value[$fieldcount].=' '.substr($seg,$ps,$pe);}
			}

			$v=$value[$fieldcount];
			$v=str_replace('=','',$v);
			$v=str_replace('{','',$v);
			$v=str_replace('}','',$v);
			$v=str_replace(',',' ',$v);
			$v=str_replace('\'',' ',$v);
			$v=str_replace('\"',' ',$v);
			$v=trim($v);
			
        	$this->items[$var[$fieldcount]][$this->count]=$v;
        }
	} // parse


	function render_all($template,$encoded,$fallbacks)
	{
		$trans = get_html_translation_table(HTML_ENTITIES);

		for ($i = 0; $i <= $this->count; $i++)
		{
			// fill the template engine with the respective values
			$template->set("type",$this->types[$i]);
			
			if ($i % 2) 
				$template->set("oddeven","odd");
			else
				$template->set("oddeven","even");

			$template->set("number",$i);

			$template->set("journal",$this->items[journal][$i].$this->items[booktitle][$i]);
			$template->set("author",$this->items[author][$i]);
			$template->set("title",strtr($this->items[title][$i],$trans));
			$template->set("volume",$this->items[volume][$i].$this->items[chapter][$i]);

			if ($this->items[url][$i])
			{
				$template->set("url",$this->items[url][$i]);
			} else
			{
				$template->set("url",$fallbacks[url]);
			}
			$template->set("note",$this->items[note][$i]);
			$template->set("abstract",$this->items[abstract][$i]);
			$template->set("year",$this->items[year][$i]);
			$template->set("group",$this->items[folder][$i]);
			$template->set("publisher",$this->items[publisher][$i]);
			$template->set("page-start",$this->items[page-start][$i]);
			$template->set("page-end",$this->items[page-end][$i]);		
			$template->set("pages",$this->items[pages][$i]);
			$template->set("address",strtr($this->items[address][$i],$trans));
			$template->set("raw",strtr($this->items[raw][$i],$trans));

			$template->make();

			$output .= $template->output;
		}
		return $output;
	}

	function render_id($template,$id)
	{
		// fill the template engine with the respective values
		$template->set("type",$this->types[$id]);
		
		if ($id % 2) 
			$template->set("oddeven","odd");
		else
			$template->set("oddeven","even");

		$template->set("number",$id);

		$template->set("journal",$this->items[journal][$id].$this->items[booktitle][$id]);
		$template->set("author",$this->items[author][$id]);
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
		$template->set("abstract",$this->items[abstract][$id]);
		$template->set("year",$this->items[year][$id]);
		$template->set("group",$this->items[folder][$id]);
		$template->set("publisher",$this->items[publisher][$id]);
		$template->set("page-start",$this->items[page-start][$id]);
		$template->set("page-end",$this->items[page-end][$id]);		
		$template->set("pages",$this->items[pages][$id]);
		$template->set("address",strtr($this->items[address][$id],$trans));
		$template->set("raw",strtr($this->items[raw][$id],$trans));

		$template->make();

		$output .= $template->output;
		return $output;
	}
}
?>
